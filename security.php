<?php

session_start();

if (!isset($_SESSION['previous_location'])){
	$_SESSION['previous_location']='index.php';
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	header("Location: ".$_SESSION['previous_location']);
}



$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection	
$con = mysqli_connect($servername, $username, $password, $dbname);

if ($con == false){
	//echo "<br> Connected was not successfull<br>";
}
else {
	// echo "MySQL Connected successfully!<br>";
}


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

	
    if (isset($_POST['Login']) 
		&& !empty($_POST['uname_login']) 
        && !empty($_POST['psw_login'])) {
			
	$uname = md5(test_input($_POST['uname_login']));
	$pwd = md5(test_input($_POST['psw_login']));
					
	$query = "SELECT * FROM USERDATA WHERE username='".$uname."' AND password='".$pwd."' LIMIT 1";
		
	$result_type2 = mysqli_query($con, $query);

    if ($row = mysqli_fetch_array($result_type2)) {
				   
       $_SESSION['uniqueUsername'] = $row['uniqueUsername'];	
	   $_SESSION['uniqueAvator'] = $row['avator'];	
		
	   if ($row['active']){
		   header("Location: ".$_SESSION['previous_location']."?loggedin=1");
	   }
	   else{
		   header("Location: ".$_SESSION['previous_location']."?notactive=1");
	   }	
	   
			
		
    }
	else {
		header("Location: ".$_SESSION['previous_location']."?wrongpass=1");
    }	
}
?>