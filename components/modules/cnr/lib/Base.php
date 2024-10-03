<?php

namespace CNR\MODULE\LIB;

use CNR\MODULE\LIB\API\BlestaLogger;

class Base
{
    private static $moduleInstance;
    private static $module;

    public static function moduleInstance($instance = null)
    {
        if (self::$moduleInstance && !$instance) {
            return self::$moduleInstance;
        }
        return self::$moduleInstance = $instance;
    }

    public static function setModule(\stdClass $module)
    {
        self::$module = $module;
    }

    public static function getModule()
    {
        return self::$module;
    }

    public function call(array $command, string $successCase = "/^200$/")
    {
        if (self::$module === null || self::$moduleInstance === null) {
            throw new \Exception("Row is not set. Please set row before making the call.");
        }

        $cl = \CNIC\ClientFactory::getClient([
            "registrar" => "CNR",
        ]);
        if (self::$module->meta->sandbox == "true") {
            $cl->useOTESystem();
        }

        $cl->setCredentials(self::$module->meta->user, self::$module->meta->key)
            ->setReferer($_SERVER["HTTP_HOST"])
            ->setUserAgent("Blesta", \BLESTA_VERSION, [
                "cnic/" . self::$moduleInstance->getVersion(),
            ])
            ->enableDebugMode() // activate logging
            ->setCustomLogger(new BlestaLogger(
                self::$module->module_id,
                $cl->getURL()
            ));
        if (!empty(self::$module->ProxyServer)) {
            $cl->setProxy(self::$module->ProxyServer);
        }
        $r = $cl->request($command)->getHash();
        if (!preg_match($successCase, $r["CODE"])) {
            return [
                "success" => false,
                "CODE" => $r["CODE"],
                "error" => $r["CODE"] . " " . $r["DESCRIPTION"]
            ];
        }
        return $r;
    }
}
