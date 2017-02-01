<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 01.02.17
     * Time: 15:04
     */

    namespace CloudResolv\Resolver;


    interface CloudResolvResolver {




        public function query ($host) : array;


    }