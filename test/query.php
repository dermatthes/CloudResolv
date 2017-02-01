<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 31.01.17
 * Time: 20:15
 */

    require __DIR__ . "/../vendor/autoload.php";

    $start = microtime(true);

    print_r(@dns_get_record("_mysql._tcp.api-cloud.de.",  DNS_ALL, $dummy, $addtl));

    print_r ($addtl);
    

    $resolver = new Net_DNS2_Resolver([]);

    $ret = $resolver->query("_mysql._tcp.api-cloud.de.", "ANY");

    echo "\n\nTime: " . (microtime(true) - $start);
    
    //print_r($ret);