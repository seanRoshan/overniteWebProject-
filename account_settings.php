<?php

session_start();

if (!isset($_SESSION['uniqueUsername'])){
	header("Location: index.php");
}

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
	
	



if (isset($_POST['changePass']) 
		&& !empty($_POST['pswOld']) 
		&& !empty($_POST['psw']) 
        && !empty($_POST['psw2'])
   )
{
	
		// Change Password
	
		$pswOld = md5(test_input($_POST['pswOld']));
		$pwd = md5(test_input($_POST['psw']));
		$pwd2 = md5(test_input($_POST['psw2']));

		$uname = $_SESSION['uniqueUsername'];	

		$query = "SELECT * FROM USERDATA WHERE uniqueUsername='".$uname."' AND password='".$pswOld."' LIMIT 1";

		$result_type = mysqli_query($con, $query);

		if ($row = mysqli_fetch_array($result_type)) {

				if ($pwd == $pwd2){
					$sql = "UPDATE `USERDATA` SET `password`='$pwd' WHERE `uniqueUsername`= '$uname'";
					mysqli_query($con, $sql);
					header("Location: ".$_SESSION['previous_location']."?passwordChanged=1&CP=1");
				}
				else{
					header("Location: ".$_SESSION['previous_location']."?newpasswordNotMatched=1&CP=1");
				}
			}
			else {
				header("Location: ".$_SESSION['previous_location']."?oldPassWrong=1&CP=1");
			}

}

else if (isset($_POST['profileInfo']) 
		&& !empty($_POST['city']) 
        && !empty($_POST['country'])
	   ) 
{
			
	// Change Profile Info
		
	$city = test_input($_POST['city']);
	$country = 	test_input($_POST['country']);
		
	$uname = $_SESSION['uniqueUsername'];	
		
		
		
	$target_dir = "images/";
	$msg = "?";
	$noImg = true;

	if ($_FILES['filesToUpload']['tmp_name']){
		
		$noImg = false;
		
		$name = $_FILES['filesToUpload']['name'];
		$size = $_FILES['filesToUpload']['size'];
		$type = $_FILES['filesToUpload']['type'];
		$file = $_FILES['filesToUpload']['tmp_name'];
		
		
		$target_file = $target_dir . $_SERVER['REQUEST_TIME'] ."_" . basename($name);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$uploadOk = 1;
		$check = getimagesize($file);
				

		$width = $check[0];
		$height = $check[1];

		if($check !== false) {
			$uploadOk = 1;
		} else {
			$msg = $msg . "notImg=1";
			$uploadOk = 0;
		}
		
		// Check if file already exists and rename if necessary
		if (file_exists($target_file)) {
			$renameIndex = 1;
			while (file_exists($target_file ."(".$renameIndex.")")){
				$renameIndex++;
			}
			$target_file = $target_file ."(".$renameIndex.")";
		}
		
		// Check file size is less than 10MB
		if ($size > 10000000) {
			$msg = $msg."&largeImg=1";
			$uploadOk = 0;
		}
		
			
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		   && $imageFileType != "gif" ) {
				$msg = $msg."&invalidType=1";
				$uploadOk = 0;
		}
		
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		} else {
			
			if (move_uploaded_file($file, $target_file)) {
				
			}
			else {
				$uploadOk = 0;
			}
		}
	
	}
	
				
	$query = "SELECT * FROM USERDATA WHERE uniqueUsername='".$uname."' LIMIT 1";
		
	$result_type = mysqli_query($con, $query);

    if ($row = mysqli_fetch_array($result_type)) {
		
		if ($uploadOk == 1){
			$sql = "UPDATE `USERDATA` SET `avator`='$target_file' WHERE `uniqueUsername`= '$uname'";
			$con->query($sql);	
		}
		
		if ( !empty($_POST['descBox']) ){
			$info = test_input($_POST['descBox']);
		}
		else {
			$info = "NO INFO";
		}
		
		$sql = "UPDATE `USERDATA` SET `city`='$city' , `country`='$country' , `info`='$info' WHERE `uniqueUsername`= '$uname'";
		mysqli_query($con, $sql);
		
		if ($uploadOk == 1){
			header("Location: ".$_SESSION['previous_location']."?profileInfoChanged=1&EP=1");
		}
		else {
			if ($noImg){
				header("Location: ".$_SESSION['previous_location']."?profileInfoChanged=1&EP=1");
			}
			else {
				$msg = $msg."&EP=1";
				header("Location: ".$_SESSION['previous_location'].$msg);
			}
			
		}

	  }

    }


    else if (isset($_POST['personalInfo']) 
		&& !empty($_POST['fname']) 
        && !empty($_POST['lname'])
	   ) {
		
	// Change Persoanl Info

			
	$fname = test_input($_POST['fname']) ;	
	$lname = test_input($_POST['lname']) ;	
	
	$uname = $_SESSION['uniqueUsername'];	
				
	$query = "SELECT * FROM USERDATA WHERE uniqueUsername='".$uname."' LIMIT 1";
		
	$result_type = mysqli_query($con, $query);

    if ($row = mysqli_fetch_array($result_type)) {
				   
		$sql = "UPDATE `USERDATA` SET `firstname`='$fname' , `lastname`='$lname' WHERE `uniqueUsername`= '$uname'";
		mysqli_query($con, $sql);
		header("Location: ".$_SESSION['previous_location']."?personalInfoChanged=1&AS=1");

		}

    }
	else {
		header("Location: ".$_SESSION['previous_location']."?AS=1");
    }


?>