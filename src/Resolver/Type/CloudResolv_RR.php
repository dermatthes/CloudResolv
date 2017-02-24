<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 15:10
     */

    namespace CloudResolv\Resolver\Type;


    class CloudResolv_RR {

        public $sortIndex;
        
        public $class;
        
        public $ttl;
        
        public $name;
        
        
        public function __construct($name, $ttl, $class="IN") {
            $this->class = $class;
            $this->ttl = $ttl;
            $this->name = $name;
        }

    }