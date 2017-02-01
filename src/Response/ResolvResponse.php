<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 14:51
     */

    namespace CloudResolv\Response;


    class ResolvResponse {


        
        public function forWriting() : ResolvResponse {
            
        }
        
        public function forReading() : ResolvResponse {
            
        }


        public function availabilityZone (string $zoneName) : ResolvResponse {
            
        }
        
        
        public function distributionKey(string $key) : ResolvResponse {
            
        }
        
        public function host() : ResolvHost {
            
        }
        
        public function hosts() : array {
            
        }
        
    }