<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection	
$con = mysqli_connect($servername, $username, $password, $dbname);

if ($con == false){
	//echo "<br> Connection was not successfull<br>";
}
else {
	//echo "MySQL Connected successfully!<br>";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = str_replace("'","''",$data);
	return $data;
}

function fixURL($data) {
	$data = str_replace(" ","%20",$data);
	return $data;
}

function mydecodeURL($data) {
	$data = str_replace("%20"," ",$data);
	return $data;
}

?>