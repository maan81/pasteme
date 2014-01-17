#!/usr/bin/php
<?php

//print_r($argv);die;

//print_r($argv[1]);

// $params = explode('&', $argv[1]);

// print_r($params);die;


//the reqd. url
$url = 'http://localhost:8080/pasteme_server.php';


$data = [];
$num_of_days = false;


//loop through each parameter in the command
foreach ($argv as $key=>$val){


	//if the parameter is for the days 
	//make it ready to get the number
	if($val=='-d'){
		$num_of_days=true;
		continue;

	//get the number of days if set
	}elseif($num_of_days){

		$data['d'] = $val;
		$num_of_days = false;
		continue;
	}

	//get the required string
	$data['text'] = $val;

}

// if(!isset($data['d'])){
// 	$data['d'] = 30;
// }

//set the default number of days if not set
$data['d'] = (isset($data['d']) ? $data['d'] : 30 );



$data_str = false;
foreach($data as $k=>$v){
	$data_str .= ($data_str?'&':'');

	$data_str .= $k.'='.$v;
}

//print_r($data);die;


//$arr = array('Hello','World!','Beautiful','Day!');
//$data_str = implode("&",$data);
//print_r($data_str);die;


//open connection
$ch = curl_init();

// //set the url, number of POST vars, POST data
// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch,CURLOPT_POST, 2);
// curl_setopt($ch,CURLOPT_POSTFIELDS, $data_str);

//set the url, number of POST vars, POST data
$options = [
				CURLOPT_URL 		=> $url,
				CURLOPT_POST 		=> 2,
				CURLOPT_POSTFIELDS	=> $data_str,
				CURLOPT_RETURNTRANSFER=> 1,
			];
curl_setopt_array($ch,$options);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

if($result == 'true'){
	echo 'Sucessfully added'.PHP_EOL;

}else{
	echo PHP_EOL.$result.PHP_EOL;
}







//curl -sSd "text=".$data['text']."&d=".$data['d'] $url;

//curl -sSd  "d=".$data['d']."&text=".$data['text']  $url ;


// $cmd = "curl -sSd "."d=".$data['d']."&text=".$data['text'] .' '. $url ;

// $cmd;

//curl -sSd "param1=value1&param2=value2" http://localhost:8080/test.php;




// The second part of this needs to be a bash script that allows for pasting of 
// code directly from the command line from remove machines.

// Examples
// $ echo hi | pasteme
// Link: http://linktopaste.com

// The bash script should also allow for an argument to define how long the 
// paste is stored for. The default without the argument should be 30 days