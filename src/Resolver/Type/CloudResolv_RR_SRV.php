<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 22:06
     */

    namespace CloudResolv\Resolver\Type;


    class CloudResolv_RR_SRV extends CloudResolv_RR {

        public $prio;
        
        public $weight;
        
        public $port;
        
        public $server;

    }