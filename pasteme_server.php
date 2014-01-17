<?php


//db info
$db = [
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'password',
		'database' => 'pasteme',
	];






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


	//validate string
	//currenty, not needed .....
	if($type=='text'){
	}
}






//validation
validate($_POST['text'],'text');
validate($_POST['d'],'days');



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


if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo "true";


/* explicit close recommended */
$stmt->close();

