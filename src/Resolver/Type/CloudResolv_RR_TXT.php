<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 15:09
     */

    namespace CloudResolv\Resolver\Type;


    class CloudResolv_RR_TXT extends CloudResolv_RR {

        public $text;


        private $keyVal = false;

        private function buildKey () {
            if ($this->keyVal !== false)
                return;
            $this->keyVal = [];
            $exp = explode(" ", strtolower(trim($this->text)));
            foreach ($exp as $cur) {
                if (trim ($cur) === "")
                    continue;

                if (substr($cur, 0, 1) === "#")
                    continue; // inactive record

                if (strpos(":", $cur) !== false) {
                    // Key Value:
                    list ($key, $val) = explode(":", $cur, 1);

                    $val = str_replace(",", ";", $val);

                    if (strpos(";", $val) !== false) {
                        // Multi-Value
                        $tmpVals = explode(";", $val);
                        $vals = [];
                        foreach ($tmpVals as $curVal) {
                            if (substr($curVal, 0, 1) == "#")
                                continue; // inactive value
                            $vals[] = $curVal;
                        }
                    } else {
                        $vals = [$val];
                    }


                    if ( ! isset ($this->keyVal[$key])) {
                        $this->keyVal[$key] = [];
                    }
                    foreach ($vals as $cur2) {
                        $this->keyVal[$key][] = $cur2;
                    }
                } else {
                    // Modifier
                    if (in_array(substr($cur, 0, 1), ["?", "+", "-", "!", "~"])) {
                        $this->keyVal[substr($cur, 1)] = substr($cur, 0, 1);
                    } else {
                        $this->keyVal[$cur] = true;
                    }
                }
            }
        }

        public function hasKey(string $name) : bool {
            return isset($this->keyVal[strtolower($name)]);
        }

        public function hasModifier (string $name) : bool {
            return isset ($this->keyVal[strtolower($name)]) && is_array($this->keyVal[strtolower($name)]);
        }

        public function getModifier (string $name) : string {
            return $this->keyVal[strtolower($name)];
        }

        public function getValue(string $name) : array {
            return $this->keyVal[strtolower($name)];
        }

    }