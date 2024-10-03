<?php

namespace CNR\MODULE\LIB;

use Language;

/**
 * NOTE: NEVER change the Order of the fields, otherwise WHMCS won't be able to map the
 * data to fields for existing entries.
 */

/**
 * AdditionalFields class
 *
 */
class AdditionalFields
{
    /**
     * translation key prefix
     */
    private $transpfx = "Cnr.";
    /**
     * WHMCS input params
     */
    private $params;
    /**
     * container to keep client related data like .DK Hostmaster ID or VAT ID
     */
    private $clientData = [];

    /**
     * Flag to toggle output of translation keys
     */
    private $showTranslationKeys = false;
    /**
     * Method to initiate the class, entry point for `cnic_AdditionalDomainFields`
     *
     * Initiates the additional domain fields configuration
     */
    public function __construct($params)
    {
        $this->params = $params;
        // $this->loadClientDefaults();
        $this->showTranslationKeys = (int)($_GET["showTranslationKeys"] ?? "0");
    }

    // /**
    //  * Load client's default data for pre-filling fields
    //  */
    // public function loadClientDefaults()
    // {
    //     $this->clientData = [];
    //     $this->clientData["DK-ID"] = "";
    //     if (function_exists("getCustomFields")) {
    //         $cfs = \getCustomFields("client", "", $_SESSION["uid"], "on", "");
    //         foreach ($cfs as $cf) {
    //             if ("dkhostmasteruserid" === $cf["textid"] && !empty($cf["value"])) {
    //                 $this->clientData["DK-ID"] = $cf["value"];
    //             }
    //         }
    //     }

    //     $this->clientData["VAT-ID"] = "";
    //     $r = localAPI("GetClientsDetails", [
    //         "clientid" => $_SESSION["uid"]
    //     ]);
    //     if ($r["result"] === "success") {
    //         $this->clientData["VAT-ID"] = $r["client"]["tax_id"];
    //         $langs = L::getLocales();
    //         $current = L::getName();
    //         foreach ($langs as $locale) {
    //             if ($locale["language"] === $current) {
    //                 $this->clientData["LANG"] = strtoupper($locale["languageCode"]);
    //                 break;
    //             }
    //         }
    //         $this->clientData["COUNTRY"] = [
    //             "CODE" => $r["client"]["countrycode"],
    //             "NAME" => $r["client"]["countryname"]
    //         ];
    //         $this->clientData["ISINDIVIDUAL"] = empty($r["client"]["companyname"]);
    //     }
    // }

    // /**
    //  * Remove WHMCS' default additional fields
    //  * @param array $fields additional domain fields
    //  * @return array
    //  */
    // private function cleanup($fields)
    // {
    //     $names = [];
    //     foreach ($fields as $field) {
    //         $names[] = $field["Name"];
    //     }
    //     foreach ($this->params["fields"] as $field) {
    //         if (!in_array($field["Name"], $names)) {
    //             $field["Remove"] = true;
    //             array_unshift($fields, $field);
    //         }
    //     }
    //     return $fields;
    // }

    // /**
    //  * Prefill additional fields with data
    //  * @param array $fields additional domain fields
    //  * @return array
    //  */
    // private function prefill($fields)
    // {
    //     global $CONFIG;
    //     foreach ($fields as $idx => $field) {
    //         // X-IT-PIN, X-NICSE-VATID, X-COMPANY-VAT-ID, X-VAT-ID, X-VATID, X-<TLD>-VAT-NUMBER, ...
    //         // X-PT-OWNER/TECH-IDENTIFICATION
    //         if (
    //             (bool)preg_match("/(VAT-?(ID|NUMBER)|^X-IT-PIN|^X-PT-OWNER-IDENTIFICATION)$/", $field["Name"])
    //             || ($CONFIG["RegistrarAdminUseClientDetails"] === "on" // otherwise reseller is tech-c
    //                 && $field["Name"] === "X-PT-TECH-IDENTIFICATION"
    //             )
    //         ) {
    //             $fields[$idx]["Default"] = $this->clientData["VAT-ID"];
    //             continue;
    //         }

    //         // Pre-select Individual: X-DK-USER-TYPE, X-IE-CONTACT-TYPE, X-FI-CONTACT-TYPE
    //         if (
    //             $this->clientData["ISINDIVIDUAL"]
    //             && (bool)preg_match("/^X-DK-USER-TYPE|X-IE-CONTACT-TYPE|X-FI-CONTACT-TYPE$/", $field["Name"])
    //         ) {
    //             $opts = explode(",", $field["Options"]);
    //             foreach ($opts as $opt) {
    //                 $val = preg_replace("/\|.+$/", "", $opt);
    //                 if ((bool)preg_match("/^(PERSON|INDIV|0|OTH|OTHER)$/", $val)) {
    //                     $fields[$idx]["Default"] = $val;
    //                     continue 2; // continue loop over fields
    //                 }
    //             }
    //         }
    //         // Pre-select language: X-IE-LANGUAGE, X-EU-REGISTRANT-LANG
    //         if ((bool)preg_match("/^X-IE-LANGUAGE|X-EU-REGISTRANT-LANG$/", $field["Name"])) {
    //             $opts = preg_replace("/\|.+$/", "", explode(",", $field["Options"]));
    //             $pos = array_search($this->clientData["LANG"], array_map("strtoupper", $opts));
    //             if ($pos !== false) {
    //                 $fields[$idx]["Default"] = $opts[$pos];
    //                 continue;
    //             }
    //         }
    //         // Pre-select country / citizenship: X-EU-REGISTRANT-CITIZENSHIP
    //         if ((bool)preg_match("/^X-EU-REGISTRANT-CITIZENSHIP$/", $field["Name"])) {
    //             $opts = preg_replace("/\|.+$/", "", explode(",", $field["Options"]));
    //             $optsupper = array_map("strtoupper", $opts);
    //             $pos = array_search($this->clientData["COUNTRY"]["CODE"], $optsupper);
    //             if ($pos !== false) {
    //                 $fields[$idx]["Default"] = $opts[$pos];
    //                 continue;
    //             }
    //             $pos = array_search(strtoupper($this->clientData["COUNTRY"]["NAME"]), $optsupper);
    //             if ($pos !== false) {
    //                 $fields[$idx]["Default"] = $opts[$pos];
    //                 continue;
    //             }
    //         }
    //     }
    //     return $fields;
    // }

    /**
     * Get Translation for given Option Value. Fallback to default otherwise.
     * Returns the translation key if requested via GET Parameter
     * @param string $parameter the CNR API parameter name e.g. X-IT-ENTITY-TYPE
     * @param string $value the option value e.g. 1 (Italian and foreign natural persons)
     * @param string $default the fallback for the translation (API Default)
     * @param bool $isrequired to add *optional if useful. true by default to not add it (dropdown options)
     * @param bool $replaceComma to get comma replaced by "⸴" (option labels as comma means start with new option)
     * @return string
     */
    private function getTranslation($parameter, $value, $default, $isrequired = true, $replaceComma = false)
    {
        $key = $this->getTranslationKey($parameter, $value);
        // required
        if ($isrequired) {
            if ($this->showTranslationKeys) {
                return $key;
            }
            $translation = Language::_($key, true);
            $msg = $default;
            if (!empty($translation) && $translation !== $key) { // translation exists
                $msg = $translation;
            }
            return ($replaceComma ? str_replace(",", "⸴", $msg) : $msg);
        }
        $translation = Language::_($key, true);
        $msg = $default;
        if (!empty($translation)) {
            $msg = $translation;
        }
        $msg .= " ";
        return ($replaceComma ? str_replace(",", "⸴", $msg) : $msg);
    }

    /**
     * Get Translation for given Option Value. Fallback to default otherwise.
     * Returns the translation key if requested via GET Parameter
     * @param string $parameter the CNR API parameter name e.g. X-IT-ENTITY-TYPE
     * @param string $value the option value e.g. 1 (Italian and foreign natural persons)
     * @param string $default the fallback for the translation (API Default)
     * @param bool $isrequired to add *optional if useful. true by default to not add it (dropdown options)
     * @param bool $replaceComma to get comma replaced by "⸴" (option labels as comma means start with new option)
     * @return string
     */
    public function getCountryTranslation($parameter, $value, $default, $isrequired = true, $replaceComma = false) {}

    /**
     * Get the Translation Key for given Parameter
     * @param string $parameter the CNR API parameter name e.g. X-IT-ENTITY-TYPE
     * @param string|null $value the option value e.g. 1 (Italian and foreign natural persons)
     * @return string
     */
    private function getTranslationKey($parameter, $value = null)
    {
        // e.g. " Cnr.xitpin"
        $basekey = $this->transpfx . strtolower(str_replace("-", "", $parameter));
        if (is_null($value)) {
            return $basekey;
        }
        return $basekey . strtolower(str_replace(" ", "", $value));
    }

    private function getDropdownOptions($name, $values, $labels, $required)
    {
        $options = [];
        foreach ($values as $idx => $val) {
            if (!(bool)preg_match("/^<[A-Z]+>$/", $val)) {
                if ($name === "X-EU-REGISTRANT-LANG") {
                    $options[$val] = Language::_($val, $labels[$idx], true); // todo, fallback logic to translation file
                } elseif ($name === "X-EU-REGISTRANT-CITIZENSHIP") {
                    $options[$val] = Language::_($val, $labels[$idx], true); // todo, fallback logic to translation file
                } else {
                    $options[$val] = $this->getTranslation($name, $val, $labels[$idx], true, true);
                }
            }
        }
        // TODO: falsy values for fields
        // switch option order for agreement fields for better defaults
        if (
            !(bool)preg_match("/^X-.+-CONSENTFORPUBLISHING$/i", $name)
            && implode(",", $options) === "0|" . Language::_(" Cnr.0", true) . ",1|" . Language::_(" Cnr.1", true)
        ) {
            $options = array_reverse($options);
        }

        // add optional to dropdown options
        if ($required === false) {
            $translation = Language::_(" Cnr.optional", true);
            if ($translation === " Cnr.optional") {
                $translation = "optional";
            }
            array_unshift($options, " - " . $translation . " -");
        } elseif (is_array($required)) {
            array_unshift($options, " " . $this->getTranslation("conditionalrequirement", null, "- Dynamic Required (see Description) -"));
        }
        return $options;
    }

    /**
     * Identify if a field is required or optional or dynamic required (WHMCS' Conditional Requirements).
     * @param string $dependencyVal value of the DEPENDENCY property returned by the API
     * @param string $requiredVal value of the REQUIRED property returned by the API
     * @param array $valuesCache mapping of fields and their supported values
     * @return mixed boolean true/false or array for conditional requirements
     */
    private function getRequirement($dependencyVal, $requiredVal, $valuesCache)
    {
        // ----------------------------------------------------------------
        // Firstly, check if requiredVal is 0 or empty string which
        // is giving a hint regarding if the field might be required
        // in case dependencyVal (if there's such one) is fulfilled.
        // So, if requiredVal is not 1, we can safely return false already.
        // ----------------------------------------------------------------
        if (empty($requiredVal)) {
            return false;
        }
        // Secondly, if dependencyVal is integer or empty, we ensure to return
        // the boolean value of requiredVal. We wouldn't be able to json_decode
        // dependencyVal safely otherwise.
        if ((bool)preg_match("/^(0|1)?$/", $dependencyVal)) {
            return (bool)(int)$requiredVal;
        }

        // Return optional fields in case of activated trustee as required!
        $basicregex = preg_quote('[["-eq",["$X-') . ".*" . preg_quote('-ACCEPT-TRUSTEE-TAC",0]]]');
        if (
            (bool)preg_match("/^" . $basicregex . "$/i", $dependencyVal) ||
            (bool)preg_match("/^" . preg_quote('["-and",') . $basicregex . preg_quote(']') . "$/i", $dependencyVal)
        ) {
            return true;
        }

        // Parse Conditional Requirements
        $json = json_decode($dependencyVal, true);
        if (is_null($json)) {
            return false;
        }

        $start = 0;
        $required = [];

        while (!empty($tmp = array_slice($json, $start, 2))) {
            list($operation, $fields) = $tmp;
            // ensure we rely -or as -and can't be mapped to WHMCS possibilities e.g.
            // required if A == "val1" and B == "val2" mapped to or:
            // required if !(A != "val1" or B != "val2")
            if ($operation !== "-or") {
                return [];
            }

            $start += 2;
            foreach ($fields as $condition) {
                list($fieldoperation, $field) = $condition;
                // ensure we rely on -ne or -eq
                if (!(bool)preg_match("/^-(ne|eq)$/", $fieldoperation)) {
                    return [];
                }
                list($parameter, $value) = $field;
                $parameter = substr($parameter, 1); // remove leading $ char

                // local presense service is not supported by / available to WHMCS
                // /TRUSTEE-TAC$/i
                // contact data validation can't be covered via additional fields
                // /^\$(owner|admin|tech|billing)contact\./i
                if (!isset($valuesCache[$parameter])) {
                    continue;
                }

                if (!isset($required[$parameter])) {
                    $required[$parameter] = [];
                }
                // -eq case
                if ($fieldoperation === "-eq") {
                    if (!in_array($value, $required[$parameter])) {
                        $required[$parameter][] = $value;
                    }
                    continue;
                }
                // -ne case
                foreach ($valuesCache[$parameter] as $supportedVal) {
                    if (
                        ($supportedVal !== $value)
                        && !in_array($supportedVal, $required[$parameter])
                    ) {
                        $required[$parameter][] = $supportedVal;
                    }
                }
            }
        }

        return (empty($required) ? false : $required);
    }

    /**
     * Method to return list of additional fields for the given parameter data
     *
     * Keeps generated configuration as TransientData. This will improve performance when fields can be requested from API.
     * @return array
     */
    public function getConfiguration($doPrefill = false)
    {
        $domainManager = new DomainManager();
        // fetch configuration from API
        $cfg = $domainManager->getAdditionalFields($this->params);

        // TODO: column "VALIDATION" maybe used on shopping cart validation hook
        $data = $cfg["PROPERTY"];
        $fields = preg_grep("/^Zone specific|Special parameters$/i", $data["PARAMGROUP"]);

        // build up values cache (used for -ne comparision)
        $valuesCache = [];
        foreach ($fields as $idx => $val) {
            $data["PARAMETER"][$idx] = strtoupper($data["PARAMETER"][$idx]);
            $values = explode("|", $data["RANGE"][$idx]);
            $valuesCache[$data["PARAMETER"][$idx]] = $values;
        }

        // generate fields
        $rows = [];
        foreach ($fields as $idx => $val) {
            $name = $data["PARAMETER"][$idx];
            if (!(bool)preg_match("/^X-/", $name)) {
                continue;
            }
            // filter out values like <TEXT>, <NULL>, <COUNTRY>, ...
            $labels = explode("|", $data["DESCRIPTION"][$idx]);
            $values = $valuesCache[$name];
            $isDropdown = !empty(preg_grep("/^<[A-Z]+>$/", $values, PREG_GREP_INVERT));

            $required = $this->getRequirement(
                $data["DEPENDENCY"][$idx],
                $data["REQUIRED"][$idx],
                $valuesCache
            );
            $langVar = $this->getTranslationKey($name);
            $labelRequired = $required;
            $labelRequired = (
                (is_bool($required) && $required === true) // returned as required
                || (is_array($required) && empty($required)) // empty array
            );

            #echo $name . " => " . \var_export($labelRequired, true) . "<br/>";
            #var_dump($required);
            // optional
            if ($this->showTranslationKeys) {
                return $langVar . " *Cnr.optional";
            }

            $opt = "*optional";
            $translation = Language::_("Cnr.optional", true);
            if (!empty($translation) && $translation !== $langVar) { // translation exists
                $opt = "*$translation";
            }
            $displayName = $langVar;
            if (!$this->showTranslationKeys) {
                $displayName = $data["TITLE"][$idx];
                $translation = Language::_($langVar, true);
                if (!empty($translation) && $translation !== $langVar) {
                    $displayName = $translation;
                }
            }
            $row = [
                "name" => $name,
                "label" => $displayName . ($labelRequired ? "" : " " . $opt),
                "type" => $isDropdown ? "select" : "text",
                "description" => $this->getTranslation($name, "descr", array_pop($labels), $labelRequired),
                "attributes" => $required ? ["required" => "true"] : []
            ];

            if ($isDropdown) {
                $row["options"] = $this->getDropdownOptions($name, $values, $labels, $labelRequired);
                $row["selected_value"] = reset($row["options"]);
            }

            $rows[$name] = $row;
        }

        // // Prefill fields with Customer Data
        // if ($doPrefill) {
        //     $rows = $this->prefill($rows);
        // }

        // ----------------------------------------------------
        // Custom Extensions / Workarounds / Rewrites of fields
        // ----------------------------------------------------
        foreach ($rows as &$row) {
            if ($this->params["tld"] === "de") {
                // WORKAROUND for RSRMID-1134
                // could be reviewed by command parameter newformat=1
                // that provides bulk parameters as X-DE-NSENTRY# with additional parameter max=#
                // ADDED BY: kschwarz 10.07.2023
                if ((bool)preg_match("/^X-DE-NSENTRY([0-9]+)$/i", $row["name"], $m)) {
                    $row["label"] = preg_replace('/(' . preg_quote($opt, '/') . ')/', " #" . ((int)$m[1] + 1) . ' $1', $row["label"]);                }
                // WORKAROUND -- END
            }
        }

        // just for debugging
        // $tmp = [];
        // foreach ($fields as $idx => $val) {
        //      $row = [];
        //      foreach (array_keys($data) as $key) {
        //          if (isset($data[$key][$idx])) {
        //              $row[$key] = $data[$key][$idx];
        //          }
        //      }
        //      $tmp[] = $row;
        // }
        // var_dump($tmp);
        // var_dump($rows);
        
        return $rows;
    }

    public static function addToCommand(&$params, &$command, $type = "register")
    {
        // .IT: entity type natural person -> cleanup company name
        if (
            $params["tld"] === "it"
            && $params["X-IT-ENTITY-TYPE"] === "1"
        ) {
            $params["companyname"] = "";
        }

        // RegisterDomain
        if ($type === "register") {
            // ensure that we only add non-empty parameters
            foreach ($params["additionalfields"] as $param => $val) {
                if ($val !== "") {
                    $command[$param] = $val;
                }
            }
            return;
        }
        // TransferDomain
        if (in_array($type, ["transfer", "trade", "modify"])) {
            // get the fields provided by WHMCS
            $registerFields = $params["additionalfields"];

            // fetch transfer fields
            $fields = new self(array_merge($params, [
                "type" => $type,
                "fields" => [] // no whmcs fields
            ]));

            // loop over transfer fields and grep values from whmcs fields
            $transferfields = $fields->getConfiguration(false); // skip prefill
            foreach ($transferfields as $field) {
                $name = $field["Name"];
                if (isset($registerFields[$name])) {
                    // add as api command parameter
                    $command[$name] = $registerFields[$name]; // can be empty for fields cleanup
                }
            }
            return;
        }
    }

    // /**
    //  * Pre-fill WHMCS additional field values by our API data
    //  * @param array $apiData API response data (PROPERTY)
    //  * @return AdditionalFields
    //  */
    // public function setFieldValuesFromAPI($apiData)
    // {
    //     $data = [];
    //     foreach ($this->getFields() as $fieldKey => $values) {
    //         $name = $this->getConfigValue($fieldKey, "Name"); // e.g. X-IT-PIN
    //         if (isset($apiData[$name][0])) {
    //             $data[$name] = $apiData[$name][0];
    //         }
    //     }
    //     $this->setFieldValues($data);
    //     return $this;
    // }

    // public function setFieldValuesFromPOST()
    // {
    //     $this->setFieldValues($_POST["domainfield"]);
    //     return $this;
    // }

    // /**
    //  * Save additional domain fields data changes to DB
    //  * But ensure to skip the ones that shall not reach the DB e.g. .be Auth Field
    //  * @param int $domainID ID of the Domain
    //  * @param bool $creating flag
    //  */
    // public function saveToDatabase($domainID, $creating = true)
    // {
    //     $changes = [];
    //     $userId = 0;
    //     foreach ($this->getFields() as $fieldKey => $values) {
    //         $name = $this->getConfigValue($fieldKey, "Name");
    //         $value = $this->getFieldValue($fieldKey);
    //         if (is_null($value)) {
    //             $value = "";
    //         }

    //         $af = \WHMCS\Domain\AdditionalField::firstOrNew([
    //             "domainid" => $domainID,
    //             "name" => $name
    //         ]);
    //         if (is_null($af->value)) {
    //             $af->value = "";
    //         }
    //         if ($af->exists && $af->value === $value) {
    //             continue;
    //         }

    //         $changes[] = (string) $name . " changed from '" . $af->value . "' to '" . $value . "'";
    //         $af->value = $value;
    //         $af->save();

    //         if (!$userId) {
    //             $userId = $af->domain->clientId;
    //         }
    //     }

    //     if (count($changes) && !$creating) {
    //         logActivity("Modified Domain Additional Fields - " . implode(", ", $changes) . " - User ID: " . $userId . " - Domain ID: " . $domainID, $userId);
    //     }
    // }
}
