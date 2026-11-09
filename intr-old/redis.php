<?php
$array = [ 

    "what is redis" => "I",

    "Install" => "npm i ioredis || 6379",

    "Redis commands" => "

        =======STRING======== <br /><br />

        set key value  <br />
        get key <br />
        set key value nx ===> key fail if key already exists <br />
        mset key1 value1 key2 value2 key3 value3 ===> helpfull to set multiple key <br />
        mget key1 key2 key3 <br />
        set count 0 <br />
        incr count || incrby count 10  <br /><br />

        =======LIST======== <br /><br />

        lpush, rpush, lpop, rpop key value ===> store value to make list (array)  <br />
        lrange key 0 -1 ===> get all value of list <br />
        llen key ===> get total number of element in list <br />
        LTRIM key 0 -1 <br />
        EXISTS key ===> check key exist <br />
        DEL key ===> delete any key <br /> <br />

        =======SET========  <br /> <br />

        sadd key value ===> adds a new member to a set<br />
        srem key value ===> removes the specified member from the set <br />
        scard key value ===> return size of set<br /><br />

        =======HASH========  <br /> <br />

        hset key key1 value1 key2 value2 key3 value3 ===> sets the value of one or more fields on a hash <br />
        hget key key1 ===> returns the value at a given field <br />
        hmget key key1 key2 key3 ===> returns the value of multiple field <br />
        hgetall key ===> returns all value <br /><br />


        =======STREAM========  <br /> <br />

        XADD ===> adds a new entry to a stream <br />
        XRANGE ===> returns a range of entries between two supplied entry IDs <br />
        XREAD ===> reads one or more entries <br />
        XLEN ===> eturns the length of a stream <br />

        =======GEOSPATIAL========  <br /> <br />

        GEOADD ===> adds a location longitude comes before latitude  <br />
        GEOSEARCH ===> returns locations with a given radius <br />

        =======BITMAP========  <br /> <br />
        SETBIT  <br />
        GETBIT <br />



    "

  
];

include('bottom.php');