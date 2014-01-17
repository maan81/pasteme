<?php

// print_r($argv);

//print_r($_POST);


//db info
$db = [
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'password',
		'database' => 'pasteme',
	];



//connect to db.
$mysqli = new mysqli($db['hostname'],$db['username'],$db['password'],$db['database']);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare('INSERT INTO pasteme_table (text,d) VALUES ("'.$_POST['text'].'",'.$_POST['d'].') ') ) ) {
    
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

// /* Prepared statement, stage 2: bind and execute */
// if (!$stmt->bind_param("text", $_POST['text'])) {
//     echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
// }
// if (!$stmt->bind_param("d", $_POST['d'])) {
//     echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
// }




if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo "true";


/* explicit close recommended */
$stmt->close();




//====================
//$mysqli = new mysqli("example.com", "user", "password", "database");

// if ($mysqli->connect_errno) {
//     echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
// }

// /* Non-prepared statement */
// if (!$mysqli->query("DROP TABLE IF EXISTS test") || !$mysqli->query("CREATE TABLE test(id INT)")) {
//     echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
// }

// /* Prepared statement, stage 1: prepare */
// if (!($stmt = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
//     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
//}


