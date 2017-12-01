<?
session_start();
$_SESSION['previous_location'] = $_SERVER['PHP_SELF'];
if ($_GET['logout']=='1') {
	unset($_SESSION['uniqueUsername']);
	unset($_SESSION['uniqueAvator']);
} 
?>