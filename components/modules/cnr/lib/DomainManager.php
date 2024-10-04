<?php

namespace CNR\MODULE\LIB;

class DomainManager extends Base
{
    /**
     * get domain status
     * @param array $params common module parameters
     * @param string $dnszone puny code dnszone name
     * @return array
     */
    public function getDNSList($row, $dnszone)
    {
        // if (!preg_match("/\.$/", $dnszone)) {
        //     $dnszone .= "    ;
        // }
        // DANGER! statusdnszone resolves for "hidden" dnszones
        // which are not visible to CP (QueryDNSZoneList command)
        $r = $this->call([
            "COMMAND" => "QueryDNSZoneList",
            "DNSZONE" => $dnszone
        ], $row);
        if ($r["CODE"] !== "200") {
            return [
                "success" => false,
                "error" => "Loading dnszone status failed. (" . $r["CODE"] . " " . $r["DESCRIPTION"] . ")",
                "CODE" => $r["CODE"]
            ];
        }
        if ($r["PROPERTY"]["COUNT"][0] === "0") {
            return [
                "success" => false,
                "error" => "Object not found or hidden.",
                "CODE" => "545"
            ];
        }
        return [
            "success" => true,
            "data" => $r["PROPERTY"]
        ];
    }

    public function createDNSZone($domain)
    {
        // Prepare the domain for DNS Zone Creation
        $this->call([
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain
        ]);

        return $this->call([
            "COMMAND" => "AddDNSZone",
            "DNSZONE" => "{$domain}"
        ]);
    }

    public function getDNSZoneRRList($domain)
    {
        return $this->call([
            "COMMAND" => "QueryDNSZoneRRList",
            "DNSZONE" => "{$domain}",
            "WIDE" => 1,
            "ORDERBY" => "type"
        ]);
    }

    public function getDomainStatus($domain)
    {
        return $this->call([
            "COMMAND" => "StatusDomain",
            "DOMAIN" => $domain,
            "X-FEE-COMMAND" => "renew"
        ]);
    }

    public function getDomainStatusCached($domain)
    {
        return $this->call([
            "COMMAND" => "QueryDomainList",
            "DOMAIN" => $domain,
            "WIDE" => "1"
        ]);
    }

    /**
     * Retrieve zone information for TLDs.
     *
     * @param string|array<string,string> $domains Single domain or array of domains.
     * @param array<string,string> $tldsWithClass list of tlds with their tld classes
     * @return object|array<object> Zone information per TLD.
     */
    public function getZoneInfo($domains)
    {
        $isSingleDomain = false;

        // If a single domain is passed, convert it to an array
        if (!is_array($domains)) {
            $domains = [$domains];
            $isSingleDomain = true;
        }

        // Initialize arrays for return and TLDs to query
        $return = [];
        $tldsToQuery = [];

        // Check and load cache for each domain's TLD
        foreach ($domains as $idx => $domain) {
            list($sld, $tld) = explode(".", $domain, 2);
            // Only load cache if TLD result hasn't been retrieved yet
            if (!isset($return[$tld])) {
                // Check if cache exists for the TLD
                $cache = Helper::hasCache("{$tld}_options");

                if ($cache) {
                    // Cache found, add to return directly
                    $return[$tld] = $cache;
                } else {
                    // Cache not found, mark TLD for query
                    $tldsToQuery[$idx] = $domain;
                }
            }
        }

        // Prepare the bulk request payload
        $payload = ["COMMAND" => "GetZoneInfo"];
        foreach ($tldsToQuery as $idx => $domain) {
            $payload["DOMAIN"] = $domain;
        }

        // Send the bulk request if there are TLDs to query
        if (count($tldsToQuery) > 0) {
            $response = $this->call($payload);

            // Process the bulk response
            foreach ($tldsToQuery as $_ => $domain) {
                $tldData = [];
                list($sld, $tld) = explode(".", $domain, 2);
                if ($response["CODE"] === "200") {
                    $responseProperty = $response["PROPERTY"];

                    // Check if the TLD supports renewal
                    $supportsRenewal = ((int)$responseProperty["RRPSUPPORTSRENEWAL"][0] === 1);

                    // Process response properties for transfer periods
                    $transferPeriods = Helper::parsePeriods($responseProperty["TRANSFERPERIODS"][0]);

                    // Process response properties for renewal periods
                    // If the TLD supports renewal, parse the renewal periods from the response
                    // Otherwise, set the renewal periods to [1]
                    $renewalPeriods = $supportsRenewal ? Helper::parsePeriods($responseProperty["RENEWALPERIODS"][0]) : [1];

                    // Process response properties for registration periods
                    $registrationPeriods = Helper::parsePeriods($responseProperty["REGISTRATIONPERIODS"][0]);

                    $contactsForTransfer = [];
                    foreach (explode(",", $responseProperty["TRANSFERSUPPORTEDCONTACTS"][0]) as $transferContact) {
                        $contactsForTransfer[] = "${transferContact}CONTACT";
                    }

                    // Build the tld data structure
                    $tldData = [
                        "tld" => [
                            "label" => "." . $tld,
                            "class" => $responseProperty["ZONE"][0],
                            "isAFNIC" => (bool)preg_match("/\.(fr|pm|re|tf|wf|yt)$/i", $domain),
                            "isNTLD" => ((int)$responseProperty["ISNTLD"][0] === 1),
                            "repository" => null,
                            "dnssec_dsdata" => ((int)$responseProperty['SUPPORTSDNSSECDSDATA'][0] === 1),
                            "categories" => explode(",", $responseProperty["NTLDCATEGORIES"][0]),
                            "periods" => Helper::parsePeriods($responseProperty["PERIODS"][0]),
                            "redemptionDays" => ((int)$responseProperty["REDEMPTIONPERIODDAYS"][0] ?: 0),
                            "graceDays" => ((int)$responseProperty['AUTORENEWGRACEPERIODDAYS'][0] ?: 0),
                            "unlockWithAuthCode" => (bool)preg_match("/\.fi$/i", $domain),
                            "updated_at" => date("Y-m-d H:i:s")
                        ],
                        "registration" => [
                            "periods" => $registrationPeriods,
                            "defaultPeriod" => $registrationPeriods[0] ?? -1
                        ],
                        "renewal" => [
                            "periods" => $renewalPeriods,
                            "defaultPeriod" => $renewalPeriods[0] ?? -1,
                            "renewalMode" => $responseProperty["RENEWALMODE"][0] ?? "DEFAULT",
                            "supportsRenewal" => $supportsRenewal,
                            "paymentPeriod" => (int)$responseProperty["AUTORENEWGRACEPERIODDAYS"][0],
                        ],
                        "transfer" => [
                            "periods" => $transferPeriods,
                            "supportsTransferLock" => ((int)$responseProperty['SUPPORTSTRANSFERLOCKS'][0] === 1),
                            "resetsRegistrationPeriod" => ((int)$responseProperty["TRANSFERRESETSREGISTRATIONPERIOD"] === 1),
                            "defaultPeriod" => $transferPeriods[0] ?? -1,
                            "isFree" => !($responseProperty['RENEWALATTRANSFER'][0] || $responseProperty['RENEWALAFTERTRANSFER'][0]),
                            "includeContacts" => !empty($contactsForTransfer),
                            "contacts" => $contactsForTransfer,
                            "requiresAuthCode" => ($responseProperty['RENEWALATTRANSFER'][0] || $responseProperty['RENEWALAFTERTRANSFER'][0]),
                        ],
                        "trade" => [
                            "required" => $responseProperty['OWNERCHANGEPROCESS'][0] == "TRADE",
                            "isStandard" => true,
                            "isIRTP" => ((int)$responseProperty["IRTP"] === 1),
                            "triggerFields" => ["Registrant" => ["First Name", "Last Name", "Organization Name", "Email"]]
                        ],
                        "addons" => [
                            "IDProtection" => $responseProperty['RRPSUPPORTSWHOISPRIVACY'][0] || $responseProperty['SUPPORTSTRUSTEE'][0]
                        ]
                    ];

                    // Cache the result for this TLD
                    $tldData = Helper::setCache("{$tld}_options", $tldData);

                    // Update return array with the processed data
                    $return[$tld] = $tldData;
                }
            }
        }

        // Return data based on single or multiple domain input
        if ($isSingleDomain && !empty($domains[0])) {
            list(, $tld) = explode(".", $domains[0], 2);
            return $return[$tld];
        }

        return $return ?? $response;
    }

    public function addDNS($domain, $postData)
    {
        $record = Helper::getResourceRecord($postData, $domain);
        return $this->call([
            "COMMAND" => "ModifyDNSZone",
            "DNSZONE" => "{$domain}",
            "ADDRR0" => "{$record}"
        ]);
    }

    public function deleteDNS($dns, $postData)
    {
        return $this->call([
            "COMMAND" => "ModifyDNSZone",
            "DNSZONE" => "{$dns}",
            "DELRR0" => "{$postData['raw_record']}"
        ]);
    }

    public function getEmailForwardingRR($domain)
    {
        $response = $this->call([
            "COMMAND" => "QueryMailFwdList",
            "DNSZONE" => "{$domain}"
        ]);

        if ($response["CODE"] !== "200") {
            return $response;
        }

        $addresses = [];
        for ($i = 0; $i < $response["PROPERTY"]['TOTAL'][0]; $i++) {
            $from = explode("@", $response["PROPERTY"]['FROM'][$i]);
            $addresses[$i] = [
                'source' => $from[0],
                'destination' => $response["PROPERTY"]['TO'][$i]
            ];
        }

        return array_merge($response, ["resources" => $addresses]);
    }

    public function saveEmailForwardingRR($domain, $postData, $action = "ADD_RECORD")
    {
        // If add new resource request
        $actionType = "AddMailFwd";

        $command = [
            "COMMAND" => $actionType
        ];

        if ($action === "DELETE_RECORD") {
            $delData = explode(" ", $postData['delete']);
            $postData["source"] = $delData[0];
            $postData["destination"] = $delData[1];
            // If delete resource request
            $command["COMMAND"] = "DeleteMailFwd";
        }

        $source = $postData["source"];
        $destination = $postData["destination"];
        if (!strlen($source) || !strlen($destination)) {
            return [
                "CODE" => "404",
                "error" => "Email Source or the destination is missing!"
            ];
        }

        // Get the part of the source before the '@' symbol
        $prefix = strstr($source, '@', true);

        // If the source is "*", set it to an empty string
        $source = $source === "*" ? "" : ($prefix ?: $source);

        $command["from"] = "{$source}@{$domain}";
        $command["to"] = $destination;

        return $this->call($command);
    }

    public function registerNameserver($domain, $postData)
    {
        return $this->call([
            "COMMAND" => "AddNameserver",
            "NAMESERVER" => "{$postData['new_nameserver']}.{$domain}",
            "IPADDRESS0" => $postData["new_nameserver_ip"]
        ]);
    }

    public function deleteNameserver($nameserver)
    {
        return $this->call([
            "COMMAND" => "DeleteNameserver",
            "NAMESERVER" => "{$nameserver}"
        ]);
    }

    public function addDnssecRecord($domain, $postData, $type = "DS")
    {
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain
        ];
        if ($type === "DS") {
            $command["DNSSECDSDATA0"] = $postData['key_tag'] . " " . $postData['algorithm'] . " " . $postData['digest_type'] . " " . $postData['digest'];
        } else {
            $command["DNSSEC0"] = $postData['flags'] . " " . $postData['protocol'] . " " . $postData['algorithm'] . " " . $postData['public_key'];
        }
        return $this->call($command);
    }

    public function deleteDnssecRecord($domain, $postData, $type = "DS")
    {
        $command = [
            "COMMAND" => "ModifyDomain",
            "DOMAIN" => $domain
        ];
        $command["DNSSECDELALL"] = 1;
        return $this->call($command);
    }

    public function getUserData()
    {
        return $this->call([
            "COMMAND" => "StatusAccount"
        ]);
    }


    public function getZoneList()
    {
        return $this->call([
            "COMMAND" => "QueryZoneList"
        ]);
    }

    public function setDomainRenewalMode($domain, $mode)
    {
        $modes = ["RENEWONCE", "AUTODELETE", "AUTOEXPIRE"];
        $mode = !in_array($mode, $modes) ? "DEFAULT" : $mode;
        return $this->call([
            "COMMAND" => "SetDomainRenewalMode",
            "DOMAIN" => $domain,
            "RENEWALMODE" => $mode
        ]);
    }

    public function nameserverList($domain)
    {
        return $this->call([
            "COMMAND" => "QueryNameserverList",
            "PARENTDOMAIN" => $domain,
            "WIDE" => 1
        ]);
    }

    public function addWebFwd(string $hostName, string $address, bool $isUrl)
    {
        $command["COMMAND"] = "AddWebFwd";
        $command["source"] = $hostName;
        $command["target"] = $address;
        $command["type"] = $isUrl ? "RD" : "MRD";
        $this->call($command);
    }

    public function delWebFwd(string $hostName)
    {
        $command["COMMAND"] = "DeleteWebFwd";
        $command["source"] = $hostName;
        $this->call($command);
    }

    public function getAdditionalFields($params)
    {
        $command["COMMAND"] = "QueryCommandSyntax";
        //$command["CLASS"] = $params["tld"];
        $command["CLASS"] = "de";
        switch ($params["type"]) {
            case "modify":
            case "trade":
            case "transfer":
                $command["COMMANDNAME"] = ucfirst($params["type"]) . "Domain";
                break;
            default:
                $command["COMMANDNAME"] = "AddDomain";
                break;
        }
        return $this->call($command);
    }
}
