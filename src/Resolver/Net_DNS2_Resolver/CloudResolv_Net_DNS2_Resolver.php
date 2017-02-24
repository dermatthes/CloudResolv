<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 24.02.17
     * Time: 12:48
     */

    namespace CloudResolv\Resolver\Net_DNS2_Resolver;


    use CloudResolv\Resolver\CloudResolvResolver;
    use CloudResolv\Resolver\CloudResolvResultSet;
    use CloudResolv\Resolver\Type\CloudResolv_RR;
    use CloudResolv\Resolver\Type\CloudResolv_RR_A;
    use CloudResolv\Resolver\Type\CloudResolv_RR_AAAA;
    use CloudResolv\Resolver\Type\CloudResolv_RR_SRV;
    use CloudResolv\Resolver\Type\CloudResolv_RR_TXT;

    class CloudResolv_Net_DNS2_Resolver implements CloudResolvResolver {

        private $mResolver;
        
        public function __construct() {
            $this->mResolver = new \Net_DNS2_Resolver([]);

            
        }


        private function record2Rr ($in) {
            switch ($in->type) {
                case "A":
                    $ret = new CloudResolv_RR_A($in->name, $in->ttl);
                    $ret->address = $in->address;
                    $ret->sortIndex = "---A_" . $ret->address;
                    return $ret;
                
                case "AAAA":
                    $ret = new CloudResolv_RR_AAAA($in->name, $in->ttl);
                    $ret->address = $in->address;
                    $ret->sortIndex = "AAAA_" . $ret->address;
                    return $ret;
                
                case "SRV":
                    $ret = new CloudResolv_RR_SRV($in->host, $in->ttl);
                    $ret->port = $in->port;
                    $ret->prio = $in->prio;
                    $ret->weight = $in->weight;
                    $ret->server = $in->server;
                    $ret->sortIndex = "-SRV_" . str_pad($ret->prio, 3, STR_PAD_LEFT)
                            . "_" . str_pad($ret->weight, 3, STR_PAD_LEFT)
                            . "_" . str_pad($ret->prio, 3, STR_PAD_LEFT)
                            . "_" . $ret->server;
                    return $ret;
                
                case "TXT":
                    $ret = new CloudResolv_RR_TXT($in->name, $in->ttl);
                    $ret->text = $in->text;
                    $ret->sortIndex = "-TXT_" . $ret->text;
                    return $ret;
                    
                default:
                    return null;
            }
        }





        public function query($host) : CloudResolvResultSet {
            $ret = $this->mResolver->query($host, "ANY");
            $resultSet = [];

            foreach ($ret->answer as $record) {
                $curRR = $this->record2Rr($record);
                if ($curRR === null)
                    continue;
                $resultSet[] = $curRR;
            }

            usort($resultSet, function (CloudResolv_RR $a, CloudResolv_RR $b) {
                if ($a->sortIndex === $b->sortIndex)
                    return 0;
                return ((string)$a->sortIndex > (string)$b->sortIndex);
            });

            return new CloudResolvResultSet($resultSet);
        }
    }