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




## CRDL1 Syntax - CloudResolv Definition Language v1  

Each service is defined by a `TXT`-Record starting with:

```
@ IN TXT 'v=crdl1 t=<type>'
```

followed by the options:


### Defining Availability Zones

```
v=crdl1 t=azd name=ac1 net=192.168.90.0/24
```

Will assign the availability zone name "ac1" to all hosts
from subnet 192.168.90.0


### Defining a service

```
v=crdl1 t=sd 
```



## Examples

Define a connection with one master and two slaves for reading

```
_mysql._tcp.cluster.         3600 IN TXT v=crdl1 t=ms  write:_master read:_slaves

;; Slaves for reading. Distribution round robin
_master._mysql._tcp.cluster. 3600 IN SRV 0 0 3306 123.123.123.1. 
_slaves._mysql._tcp.cluster. 3600 IN SRV 0 0 3306 123.123.123.2.

;; Will be used only if both nodes before fail
_slaves._mysql._tcp.cluster. 3600 IN SRV 10 0 3306 123.123.123.3.

;; Unused node. Priority >=999 will be deactivated
_slaves._mysql._tcp.cluster. 3600 IN SRV 999 0 3306 123.123.123.4.
```



Define a cache based on a distribution key

```
_redis_session._tcp.cluster. 3600 IN TXT v=crdl1 t=dk num_slots:8 slots:_a;_b

;; Data will be written to both nodes and read from 
_a._redis_session._tcp.cluster. 3600 IN SRV 0 0 3301 123.123.123.10.
_a._redis_session._tcp.cluster. 3600 IN SRV 0 0 3301 123.123.123.11.


;; Data will be written and read from first node
_b._redis_session._tcp.cluster. 3600 IN SRV 0 0 3301 123.123.123.20.
_b._redis_session._tcp.cluster. 3600 IN SRV 10 0 3301 123.123.123.21.

```