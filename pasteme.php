#!/usr/bin/php
<?php

//------------------------------------------------------------------------------

// The second part of this needs to be a bash script that allows for pasting of 
// code directly from the command line from remove machines.

// Examples
// $ echo hi | pasteme
// Link: http://linktopaste.com

// The bash script should also allow for an argument to define how long the 
// paste is stored for. The default without the argument should be 30 days

//------------------------------------------------------------------------------


//the reqd. url
$url = 'http://localhost:8080/pasteme_server.php';

//the default number of days
$default_days = 30;



$data = [];
$data_str = false;
$num_of_days = false;


/**
 * Displays the help
 *
 */
function help(){
	echo 	' Usage: pasteme [-d] string'.PHP_EOL.
			PHP_EOL.
			'   Options:'.PHP_EOL.
			'     -d     The number of days to keep in string,'.PHP_EOL. 
			'            where, d could be : '.PHP_EOL.
			PHP_EOL.
			'            365 = 1 Year'.PHP_EOL.
			'            180 = 6 Months'.PHP_EOL.
			'            30  = 1 Month'.PHP_EOL.
			'            7   = 1 Weeks'.PHP_EOL.
			'            1   = 1 Day'.PHP_EOL.
			'            0   = Forever'.PHP_EOL.
			PHP_EOL;

			die;

}


/**
 * Validate
 *
 */
function validate($param,$type){
	//validate days
	if($type='days'){
		switch($param){
			case '360': case '180': case '30':
			case '7':	case '1': case '0':
				return ;


			//invalid number of days
			default:
				help();
		}
	}

}

//loop through each parameter in the command
for($i=1;$i<count($argv);$i++){

	//if the parameter is for the days 
	//make it ready to get the number
	if($argv[$i]=='-d'){
		$num_of_days=true;
		continue;

	//get the number of days if set
	}elseif($num_of_days){

		$data['d'] = validate($argv[$i],'days');
		$num_of_days = false;
		continue;
	
	//display help
	}elseif( ($argv[$i]=='-?') || ($argv[$i]=='--help') ){
		help();
	}

	//get the required string
	$data['text'] = $argv[$i];
}


//display help if text is not set 
if(!isset($data['text'])){
	help();
}


//set the default number of days if not set
$data['d'] = (isset($data['d']) ? $data['d'] : $default_days );


//convert array to string
foreach($data as $k=>$v){
	$data_str .= ($data_str?'&':'');

	$data_str .= $k.'='.$v;
}



//open connection
$ch = curl_init();

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


//if successful ...
if($result == 'true'){
	echo 'Sucessfully added'.PHP_EOL;


//else display error 
}else{
	echo PHP_EOL.$result.PHP_EOL;
}

