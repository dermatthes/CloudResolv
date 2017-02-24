<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 22:33
     */

    namespace CloudResolv\Response;


    class ResolvResponse_CRDL_RR implements ResolvResponse {

        public function forWriting() : ResolvResponse {
            // TODO: Implement forWriting() method.
        }

        public function forReading() : ResolvResponse {
            // TODO: Implement forReading() method.
        }

        public function availabilityZone(string $zoneName) : ResolvResponse {
            // TODO: Implement availabilityZone() method.
        }

        public function distributionKey(string $key) : ResolvResponse {
            // TODO: Implement distributionKey() method.
        }

        public function host() : ResolvHost {
            // TODO: Implement host() method.
        }

        public function hosts() : array {
            // TODO: Implement hosts() method.
        }
    }