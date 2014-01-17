#!/usr/bin/php
<?php

print_r($argv[1]);

$params = explode('&', $argv[1]);

$data = [];

foreach ($params as $key=>$val){


	$tmp_arr = explode('=', $val);

	$data[$tmp_arr[0]] = $tmp_arr[1];

}


print_r($data);

//curl -sSd "param1=value1&param2=value2" http://localhost:8080/test.php > file




// The second part of this needs to be a bash script that allows for pasting of 
// code directly from the command line from remove machines.

// Examples
// $ echo hi | pasteme
// Link: http://linktopaste.com

// The bash script should also allow for an argument to define how long the 
// paste is stored for. The default without the argument should be 30 days