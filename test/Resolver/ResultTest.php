<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 24.02.17
     * Time: 12:45
     */

    namespace CloudResolvTest\Resolver;


    use CloudResolv\Resolver\Net_DNS2_Resolver\CloudResolv_Net_DNS2_Resolver;
    use PHPUnit\Framework\TestCase;


    class ResultTest extends TestCase
    {

        public function testRoundRobinA () {
            $r = new CloudResolv_Net_DNS2_Resolver();
        }
        
    }