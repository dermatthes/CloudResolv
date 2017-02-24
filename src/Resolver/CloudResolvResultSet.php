<?php
    /**
     * Created by PhpStorm.
     * User: matthes
     * Date: 02.02.17
     * Time: 12:05
     */

    namespace CloudResolv\Resolver;


    use CloudResolv\Resolver\Type\CloudResolv_RR;

    class CloudResolvResultSet {

        
        private $rr = [];
        
        
        public function __construct(array $rrArr) {
            $this->rr = $rrArr;
        }


        /**
         * @param $className
         * @return CloudResolv_RR[]
         */
        public function getByType($className) {
            $result = [];
            foreach ($this->rr as $curRR) {
                if ($curRR instanceof $className)
                    $result[] = $curRR;
            }
            return $result;

        }



    }