<?
session_start();

include 'dbconnect.php';

if ( (!isset($_GET['email']) ) || (!isset($_GET['hash'])) ){
	header("Location: index.php");
}


$email = $_GET['email'];
$hash = $_GET['hash'];

$sql = "SELECT * FROM `USERDATA` WHERE `email` LIKE '$email' AND `hash` LIKE '$hash'";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_array($result);

if ( ($row['email'] == $email) && ($row['hash'] == $hash) ) {
	$_SESSION['uniqueUsername'] = $row['uniqueUsername'];
	$sql = "UPDATE `USERDATA` SET `active`= '1' WHERE `hash` = '$hash'";
	mysqli_query($con, $sql);
	
}

header("Location: editprofile.php");

?>