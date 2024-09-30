<?php

namespace CNR\MODULE\LIB\API;

use Blesta\Core\Util\Common\Traits\Container;

class BlestaLogger implements \CNIC\LoggerInterface
{
    use Container;

    private $apiURL;
    private $module_row_id;
    private $log_group;

    public function __construct($module_row_id, $apiURL)
    {
        $this->module_row_id = $module_row_id;
        $this->apiURL = $apiURL;
    }

    /**
     * output/log given data
     * @param string $post post request data in string format
     * @param \CNIC\CNR\Response $r Response to log
     * @param string|null $error error message
     */
    public function log(string $post, $r, string $error = null): void
    {
        $this->logHandle(
            $this->apiURL,
            "Function: " . $this->backtraceFn() . "\n" . $r->getCommandPlain() . "\n" . $post,
            'input',
            true
        );

        $this->logHandle(
            $this->apiURL,
            ($error ? $error . "\n\n" : "") . $r->getPlain(),
            'output',
            $error ? false : $r->isSuccess()
        );
    }

    /**
     * Attempts to log the given info to the module log.
     *
     * @param string $url The URL contacted for this request
     * @param string $data A string of module data sent along with the request (optional)
     * @param string $direction The direction of the log entry (input or output, default input)
     * @param bool $success True if the request was successful, false otherwise
     * @return string Returns the 8-character group identifier, used to link log entries together
     * @throws Exception Thrown if $data was invalid and could not be added to the log
     */
    protected function logHandle($url, $data = null, $direction = 'input', $success = false)
    {
        if (!$this->module_row_id) { // id is not provided when adding username and password first time
            return ;
        }

        if (!isset($this->Logs)) {
            \Loader::loadModels($this, ['Logs']);
        }

        // Create a random 8-character group identifier
        if ($this->log_group == null) {
            $this->log_group = substr(md5(mt_rand()), mt_rand(0, 23), 8);
        }

        $requestor = $this->getFromContainer('requestor');

        $log = [
            'staff_id' => $requestor->staff_id,
            'module_id' => $this->module_row_id,
            'direction' => $direction,
            'url' => $url,
            'data' => $data,
            'status' => ($success ? 'success' : 'error'),
            'group' => $this->log_group
        ];
        $this->Logs->addModule($log);

        if (($error = $this->Logs->errors())) {
            throw new Exception(serialize($error));
        }

        return $this->log_group;
    }

    protected function backtraceFn()
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS | DEBUG_BACKTRACE_PROVIDE_OBJECT);
        $result = array();
        foreach ($trace as $t) {
            if (isset($t["function"]) && isset($t["class"]) && $t["class"] === "Cnr" && $t["function"] !== "_call") {
                $result["fnName"] = strtolower($t["function"]);
                break;
            }
        }
        if (empty($result)) {
            $result["fnName"] = strtolower($trace[0]["function"]);
        }
        return $result["fnName"];
    }
}
