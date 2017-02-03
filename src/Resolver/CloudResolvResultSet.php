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
            foreach ($rrArr as $cur) {
                $type = str_replace(CloudResolv_RR::class, "", get_class($cur));
                if ( ! isset ($this->rr[$type]))
                    $this->rr[$type] = [];
                $rr[$type][] = $cur;                
            }
        }
        
        
        


    }