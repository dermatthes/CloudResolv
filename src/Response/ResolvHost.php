<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 14:57
     */

    namespace CloudResolv\Response;


    class ResolvHost {


        public function __construct(ResolvResponse $response) {
        }


        public function getIp() : string {

        }

        public function getIpv4() : string {

        }

        public function getIpv6() : string {

        }

        public function getPort() : int {

        }

        public function getName() : string {

        }

        public function fail() {

        }

        public function nextAlt() : ResolvHost {

        }


    }