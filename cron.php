<?php


//db info
$db = [
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'password',
		'database' => 'pasteme',
		'table'    => 'pasteme_table'
	];




//sql to delete the data which have crossed their days limit
$sql = 'DELETE FROM '.$db['table'].' WHERE (d>0) AND ( (created_at + INTERVAL d DAY) < NOW() AND d>=0 );';


$con=mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);

// Check connection
if (mysqli_connect_errno($con)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,$sql);


mysqli_close($con);
