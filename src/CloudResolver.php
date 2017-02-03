<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 31.01.17
 * Time: 20:13
 */

namespace CloudResolv;


use CloudResolv\Resolver\CloudResolvResolver;
use CloudResolv\Response\ResolvResponse;
use CloudResolv\Response\ResponseFactory;

class CloudResolver
{

    /**
     * @var CloudResolvResolver
     */
    private $mResolver;
    

    public function setResolver (CloudResolvResolver $resolver) {
        $this->mResolver = $resolver;
    }


    public function query (string $query) : ResolvResponse {
        $builder = new ResponseFactory();

        $rrArr = $this->mResolver->query($query);
        return $builder->build($rrArr);
    }
    
    
    public function service(string $service) : ResolvResponse {
        
    }    
}