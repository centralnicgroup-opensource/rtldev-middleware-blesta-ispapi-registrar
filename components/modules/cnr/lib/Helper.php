<?php

namespace CNR\MODULE\LIB;

use CNR\MODULE\LIB\Base;
use CNIC\IDNA\Factory\ConverterFactory;

define("CNIC_TLD_CACHE", "1 day");

class Helper
{
    public static function getResourceRecord($record, $domain = "")
    {
        // hostname ttl IN record_type priority address
        // $record = $data['hostname'] . " " . $data['ttl'] . " IN " . $data['record_type'];
        // if (isset($data['priority']) && !empty($data['priority']) && ($data['record_type'] == 'MX' || $data['record_type'] == 'MXE' || $data['record_type'] == 'SRV')) {
        //     $record .= " " . $data['priority'];
        // }
        // $record .= " " . $data['address'];

        // Determine record to add
        $zone = [];
        $ttl = $record["ttl"] ?? "3600";
        if (!is_numeric($ttl)) {
            $ttl = "3600";
        }
        if (!$record['hostname'] || (isset($domain) && $record['hostname'] === $domain)) {
            $record['hostname'] = "@";
        }

        switch ($record['record_type']) {
            case "MXE":
                $address = $record["address"];
                $mxpref = is_numeric($record["priority"]) ? $record["priority"] : "100";
                if (preg_match("/^([0-9]+) (.*)$/", $record["address"], $m)) {
                    $mxpref = $m[1];
                    $address = $m[2];
                }
                if (preg_match("/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/", $address, $m)) {
                    $mxe_host = "mxe-host-for-ip-$m[1]-$m[2]-$m[3]-$m[4]";
                    $ip = $m[1] . "." . $m[2] . "." . $m[3] . "." . $m[4];
                    $zone[] = sprintf("%s %s IN MX %s %s", $record['hostname'], $ttl, $mxpref, $mxe_host);
                    $zone[] = sprintf("%s IN A %s", $mxe_host, $ip);
                } else {
                    $zone[] = sprintf("%s %s IN MX %s %s", $record['hostname'], $ttl, $mxpref, $address);
                }
                break;
            case "MX":
            case "SRV":
                $zone[] = sprintf("%s %s IN %s %s %s", $record['hostname'], $ttl, $record['record_type'], $record['priority'], $record['address']);
                break;
            case "NS":
                $zone[] = sprintf("%s %s %s %s", $record['hostname'], $ttl, $record['record_type'], $record['address']);
                break;
            default:
                $zone[] = sprintf("%s %s IN %s %s", $record['hostname'], $ttl, $record['record_type'], $record['address']);
        }
        if (count($zone) <= 1) {
            return $zone[0];
        }
        return $zone;
    }

    public static function errorHandler($response)
    {
        // Check if response indicates an error
        if (isset($response['CODE']) && $response['CODE'] !== "200") {
            // Handle non-successful responses
            if (isset($response['error'])) {
                Base::moduleInstance()->Input->setErrors([
                    "errors" => [$response['error']],
                ]);
            } else {
                Base::moduleInstance()->Input->setErrors([
                    "errors" => ["Oops something went wrong!"],
                ]);
            }
            return false;
        }

        // No explicit error, assume successful response
        return true;
    }

    /**
     * get formatted resource records
     *
     * @param array $resourceRecords
     * @param string $domain
     * @return array
     */
    public static function getResourceRecords($resourceRecords, $domain = "")
    {
        if (empty($resourceRecords)) {
            return [];
        }
        $hostrecords = [];
        for ($i = 0; $i < $resourceRecords['COUNT'][0]; $i++) {
            $name = $resourceRecords['NAME'][$i];
            $rrtype = $resourceRecords['TYPE'][$i];
            $content = $resourceRecords['CONTENT'][$i];
            $priority = $resourceRecords['PRIO'][$i];
            $ttl = $resourceRecords['TTL'][$i];

            if ($rrtype == 'MX') {
                if ($content == $priority) {
                    continue;
                }
                if (substr($content, 0, strlen($priority)) === $priority) {
                    $content = substr($content, strlen($priority) + 1);
                }
            }

            if (!(bool)preg_match("/^(" . implode("|", self::getSupportedRRTypes()) . ")$/", $rrtype)) {
                continue;
            }

            if ((bool)preg_match("/^(A|AAAA|CNAME)$/", $rrtype)) {
                if (
                    $rrtype !== "A" ||
                    !preg_match("/^mxe-host-for-ip-(\d+)-(\d+)-(\d+)-(\d+)$/i", $domain, $m)
                ) {
                    $hostrecords[$i] = [
                        "hostname" => $name,
                        "ttl" => $ttl,
                        "record_type" => $rrtype,
                        "address" => $content
                    ];
                    $hostrecords[$i]["raw_record"] = Helper::getResourceRecord($hostrecords[$i]);
                    continue;
                }
            }

            if ($rrtype === "SRV" || $rrtype === "MX") {
                $hostrecords[$i] = [
                    "hostname" => $name,
                    "ttl" => $ttl,
                    "record_type" => $rrtype,
                    "address" => $content,
                    "priority" => $priority
                ];
                $hostrecords[$i]["raw_record"] = Helper::getResourceRecord($hostrecords[$i]);
                continue;
            }

            if ($rrtype === "X-HTTP") {
                if ($rrtype === "REDIRECT") {
                    $url_type = "URL";
                }

                $hostrecords[$i] = [
                    "hostname" => $name,
                    "ttl" => $ttl,
                    "record_type" => $url_type,
                    "address" => $content
                ];
                $hostrecords[$i]["raw_record"] = Helper::getResourceRecord($hostrecords[$i]);
                continue;
            }

            // TXT or other records
            $hostrecords[$i] = [
                "hostname" => $name,
                "ttl" => $ttl,
                "record_type" => $rrtype,
                "address" => $content
            ];
            $hostrecords[$i]["raw_record"] = Helper::getResourceRecord($hostrecords[$i]);
        }
        return $hostrecords;
    }

    public static function getSupportedRRTypes()
    {
        return [
            "A",
            "AAAA",
            "ALIAS",
            "CAA",
            "CNAME",
            "MX",
            "MXE",
            "NAPTR",
            "NS",
            "PTR",
            "SPF",
            "SSHFP",
            "SRV",
            "TXT",
            "TLSA",
            "X-HTTP"
        ];
    }

    /**
     * Builds and returns the rules required to add/edit a module row
     *
     * @param array $vars An array of key/value data pairs
     * @return array An array of Input rules suitable for Input::setRules()
     */
    public static function getRowRules(&$vars, $module_row_id = null)
    {
        $instance = Base::moduleInstance();
        return [
            "user" => [
                "valid" => [
                    "rule" => "isEmpty",
                    "negate" => true,
                    "message" => \Language::_("Cnr.!error.user.valid", true),
                ],
            ],
            "key" => [
                "valid" => [
                    "last" => true,
                    "rule" => "isEmpty",
                    "negate" => true,
                    "message" => \Language::_("Cnr.!error.key.valid", true),
                ],
                "valid_connection" => [
                    "rule" => [
                        [$instance, "validateConnection"],
                        $vars["user"],
                        isset($vars["sandbox"]) ? $vars["sandbox"] : "false",
                        isset($vars["dnssec"]) ? $vars["dnssec"] : "false",
                        $module_row_id
                    ],
                    "message" => \Language::_("Cnr.!error.key.valid_connection", true),
                ],
            ],
        ];
    }

    /**
     * retrieve data from cache if available.
     *
     * @param string $keyName The key name for the cache.
     * @return mixed|false The cached data or false if caching is disabled or an error occurs.
     */
    public static function hasCache(string $keyName)
    {
        // If cache is disabled or key name is empty, return false
        if (!\Configure::get("Caching.on") || empty($keyName)) {
            return false;
        }

        // Fetch the data from cache if available
        $cache = \Cache::fetchCache(
            $keyName,
            \Configure::get("Blesta.company_id") . \DS . "modules" . \DS . "cnr" . \DS
        );

        // If cache exists, return the cached data
        if ($cache) {
            return json_decode($cache);
        }

        return false;
    }

    /**
     * Set cache data in the system.
     *
     * @param string $keyName The key name for the cache.
     * @param object|array $cacheData The data to store in cache.
     * @return bool True if the data was successfully cached, false otherwise.
     */
    public static function setCache(string $keyName, object|array $cacheData)
    {
        // If caching is disabled, key name is empty, or cache data is empty, return false
        if (!\Configure::get("Caching.on") || empty($keyName) || empty($cacheData)) {
            return false;
        }

        try {
            // Write data to cache
            \Cache::writeCache(
                $keyName,
                json_encode($cacheData),
                strtotime(CNIC_TLD_CACHE) - time(),
                \Configure::get("Blesta.company_id") . \DS . "modules" . \DS . "cnr" . \DS
            );
        } catch (\Exception $e) {
            // Write to cache failed, so disable caching
            \Configure::set("Caching.on", false);
            return false;
        }

        return self::hasCache($keyName);
    }

    /**
     * Helper function to parse period data.
     *
     * @param array|string $periods Periods data from API response.
     * @return array Parsed periods.
     */
    public static function parsePeriods($periods)
    {
        return array_values(array_unique( // unique values, re-indexed
            array_map( // convert strings to ints
                "intval",
                preg_grep( // filter out 1M period, not supported by blesta at all;  and empty string which is probably a no longer supported zone
                    "/^(1M)?$/",
                    preg_replace(
                        "/^R/", // replace "R" of reset periods
                        "",
                        explode(",", $periods)
                    ),
                    PREG_GREP_INVERT
                )
            )
        ));
    }

    /**
     * Convert domain names to idn + punycode if necessary
     * @param array $domains list of domain names (or tlds)
     * @return array
     */
    public static function IDNConvert($data)
    {
        return ConverterFactory::convert($data);
    }

    /**
     * Gets proper expiration date property from API as unix timestamp
     * @param string|null $renewalDate
     * @param string|null $paidUntilDate
     * @param string|null $expirationDate
     * @param string $renewalMode
     * @param array $periods
     * @return int
     */
    public static function getExpiryDate(?string $renewalDate, ?string $paidUntilDate, ?string $expirationDate)
    {
        $expirationTS = self::castDate($paidUntilDate ?? $expirationDate);
        if (!is_null($renewalDate)) {
            $renewalTS = self::castDate($renewalDate);
            if ($renewalTS["ts"] < $expirationTS["ts"]) {
                $expirationTS = $renewalTS;
            }
        }

        return (int) $expirationTS["ts"];
    }

    /**
     * Cast our UTC API timestamps to local timestamp string and unix timestamp
     * @param string $date API timestamp (YYYY-MM-DD HH:ii:ss)
     * @return array<string, mixed>
     */
    public static function castDate(string $date)
    {
        $utcDate = str_replace(" ", "T", $date) . "Z"; //RFC 3339 / ISO 8601
        $ts = strtotime($utcDate);
        return [
            "ts" => $ts,
            "short" => date("Y-m-d", $ts === false ? 0 : $ts),
            "long" => date("Y-m-d H:i:s", $ts === false ? 0 : $ts)
        ];
    }

    /**
     * Extracts the SLD (Second Level Domain) and TLD (Top Level Domain) from a given domain.
     *
     * @param string $domain The domain name to extract SLD and TLD from.
     * @return array|string An associative array containing 'sld' and 'tld'.
     */
    public static function getSldTld(string $domain, bool $tldOnly = false)
    {
        list($sld, $tld) = explode(".", $domain, 2);

        if ($tldOnly) {
            return $tld ?? "";
        }

        return [
            "sld" => $sld,
            "tld" => $tld
        ];
    }
}
