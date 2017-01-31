<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 31.01.17
 * Time: 20:15
 */


print_r(dns_get_record("_spf.google.com.",  DNS_ALL - DNS_MX, $dummy, $addtl));


print_r($addtl);