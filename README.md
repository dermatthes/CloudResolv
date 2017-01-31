# CloudResolv

DNS Resolver/Balancer and caching library for PHP7 parsing SRV, A and AAAA Records


## Examples

Initialize Resolver
``
$resolver = new CloudResolver();
$resolver->setCache (new HeapResolvCache());

$resolver->setSearchPath("example.com");
``

Retrieve IP

``
$ip = $resolver->query("someService")->ip()->roundRobin();
``


