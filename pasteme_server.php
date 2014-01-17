<?php


//db info
$db = [
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'password',
		'database' => 'pasteme',
		'table'    => 'pasteme_table'
	];



/**
 * Returns a unique id which has not been used in the db
 *
 */
function generate_uniqueID($tmp_mysqli){

	//generate a unique id
	do{
		$tmp_uniqueID = uniqid();

		$tmp_stmt = $tmp_mysqli->prepare('SELECT id FROM '.$db['table'].' WHERE url = "'.$tmp_uniqueID .'"');
		$tmp_stmt->execute();
		$tmp_res = $tmp_stmt->get_result();
print_r($tmp_res);die;
	}while(count($tmp_res)!=0);

	return $tmp_uniqueID;
}


/**
 * Displays the help
 *
 */
function help(){
	echo 	'<pre>'.
			' Usage: pasteme [-d] string'.PHP_EOL.
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
			PHP_EOL.'</pre>';

			die;

}


/**
 * Validate
 *
 */
function validate($param,$type){
	//validate days
	if($type=='days'){
		switch($param){
			case '365': case '180': case '30':
			case '7':	case '1': case '0':
				break;


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
validate($_POST['d'],'days');
validate($_POST['text'],'text');


//connect to db.
$mysqli = new mysqli($db['hostname'],$db['username'],$db['password'],$db['database']);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


//get a unique id for the url
do{
	$uniqueID = uniqid();

	$res = $mysqli->query('SELECT id FROM '.$db['table'].' WHERE url = "'.$uniqueID .'"');
}while($res->num_rows!=0);



/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare('INSERT INTO '.$db['table'].' (text,d,url) VALUES ("'.$_POST['text'].'",'.$_POST['d'].',"'.$uniqueID.'") ') ) ) {
    
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
echo "true";


/* explicit close recommended */
$stmt->close();
