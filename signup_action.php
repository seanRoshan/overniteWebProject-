<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] != "POST") {
	header("Location: signup.php");
}

if ($_SESSION['previous_location'] ==''){
	header("Location: signup.php");
}

$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection	
$con = mysqli_connect($servername, $username, $password, $dbname);

if ($con == false){
	//echo "<br> Connection to Database was not successfull<br>";
}
else {
	//echo "MySQL Connected successfully!<br>";
}

$first_name = $last_name = $user_name = $password_phrase = $email_address = " ";
$formEntries = 0;

if (!empty($_POST["fname"])){
	$first_name = test_input($_POST["fname"]);
	$formEntries++;
}

if (!empty($_POST["lname"])){
	$last_name = test_input($_POST["lname"]);
	$formEntries++;
}

if (!empty($_POST["uname"])){
	
	$unhashedUsername = test_input($_POST["uname"]);
	$user_name =  md5($unhashedUsername);
	$uniqueUsername = $unhashedUsername;
	
	$sql_user = "SELECT * FROM  `USERDATA` WHERE `username` LIKE '$user_name'";
	$result_user = mysqli_query($con, $sql_user);
	$row_user = mysqli_fetch_array($result_user);
	
	if ($row_user){
		header("Location: signup.php?duplicateuser=1");
	}
	else {
		$formEntries++;
	}

}

if (!empty($_POST["psw"])){
	$unhashedpassword_phrase = test_input($_POST["psw"]);
	$password_phrase = md5($unhashedpassword_phrase);
	$formEntries++;
}

if (!empty($_POST["email"])){
	$email_address = test_input($_POST["email"]);	
	$formEntries++;
}
	
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


if ($formEntries==5){

	
	$name = $first_name." ".$last_name;
	$hash  = md5(rand(0,1000));	
	$avator = "img/avator.png";
		
	$city = $country = "unknown";
	$info = "NO info";

	$sql = "INSERT INTO USERDATA (firstname, lastname, email, username, password, uniqueUsername, hash, active, city, country, info, avator )
	VALUES ('$first_name', '$last_name', '$email_address', '$user_name', '$password_phrase', '$uniqueUsername', '$hash', '0', '$city', '$country', '$info', '$avator')";
	
	$con->query($sql);
	
	$to = $email_address; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$message = 'Hello '.$name.'
	
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
------------------------
Username: '.$unhashedUsername.'
------------------------
Please click this link to activate your account:
http://airbnb.drsvr.co/verify.php?email='.$email_address.'&hash='.$hash.'

Thanks for signing up, and welcome to the Overnite!

'; 

	// Our message above including the link

	$headers = 'From:noreply@overnite.drsvr.co' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
	
	mysqli_close($con);  
	
	header("Location: signup.php?registed=1");

}

?>
