<?php

// print_r($argv);

print_r($_POST);


//db info
$db['hostname'] = 'localhost';
$db['username'] = 'root';
$db['password'] = 'password';
$db['database'] = 'pasteme';



//connect to db.
$con=mysqli_connect($db['hostname'],$db['username'],$db['password'],$db['database']);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


//close db.
mysqli_close($con);
?> 