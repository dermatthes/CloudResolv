<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 24.02.17
     * Time: 12:48
     */

    namespace CloudResolv\Resolver\Net_DNS2_Resolver;


    use CloudResolv\Resolver\CloudResolvResolver;

    class CloudResolv_Net_DNS2_Resolver implements CloudResolvResolver {

        private $mResolver;
        
        public function __construct() {
            $this->mResolver = new \Net_DNS2_Resolver([]);

            
        }


        public function query($host) : array {
            $ret = $this->mResolver->query($host, "ANY");
            print_r ($ret);
        }
    }