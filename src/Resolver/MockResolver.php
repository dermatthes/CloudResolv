<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 22:57
     */

    namespace CloudResolv\Resolver;


    use CloudResolv\Resolver\Type\CloudResolv_RR_A;
    use CloudResolv\Resolver\Type\CloudResolv_RR_AAAA;
    use CloudResolv\Resolver\Type\CloudResolv_RR_SRV;
    use CloudResolv\Resolver\Type\CloudResolv_RR_TXT;

    class MockResolver implements CloudResolvResolver{



        private $mDomain = null;
        private $mRecords = [];


        public function setDomain ($domain) : self {
            $this->mDomain = $domain;
            return $this;
        }


        /**
         * @param $name
         * @param $record
         * @return MockResolver
         */
        public function addRecord ($name, $record) : self {
            if ( ! is_array($this->mRecords[$name]))
                $this->mRecords[$name] = [];

            $record = str_replace("\t", " ", trim ($record));

            if (substr($name, -1) !== ".")
                $name = $name . "." . $this->mDomain;

            $exp = explode(" ", $record);

            $class = array_shift($exp); // IN
            $ttl = array_shift($exp); // TTL
            $recType = array_shift($exp); // SRV / TXT / A

            switch (strtoupper($recType)) {

                case "SRV":
                    $new = new CloudResolv_RR_SRV($name, $ttl, $class);
                    $new->prio = array_shift($exp);
                    $new->weight = array_shift($exp);
                    $new->port = array_shift($exp);
                    $new->server = $exp;
                    break;

                case "TXT":
                    $new = new CloudResolv_RR_TXT($name, $ttl, $class);
                    $new->text = implode(" ", $exp);
                    break;

                case "A":
                    $new = new CloudResolv_RR_A($name, $ttl, $class);
                    $new->address = $exp;
                    break;

                case "AAAA":
                    $new = new CloudResolv_RR_AAAA($name, $ttl, $class);
                    $new->address = $exp;
                    break;

                default:
                    throw new \InvalidArgumentException("Invalid Record: {$name} {$record}");



            }

            $this->mRecords[$name][] = $new;
            return $this;
        }


        public function query($host) : array {
            return $this->mRecords[$host];
        }
    }