<?php include 'session.php';?>
<?
	$_SESSION['RESULTMESSAGE'];
?>
<?php
    // include 'messaging.php';
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";
    
    // Create connection	
    $con = mysqli_connect($servername, $username, $password, $dbname);
    
    // if ($con == false){
    // // 	echo "<br> Connection to Database was not successfull<br>";
    // }
    
    if( isset($_GET['fm'])) { 
        $firstMessage = $_GET['fm']; 
    } 
    if ( isset($_GET['chatID']) ) {
	    $chatID = $_GET['chatID'] ;
	    
    }
    if( isset($_GET['receiver']) ) { 
        $receiver = $_GET['receiver']; 
    } 
    if( isset($_GET['sender']) ) { 
        $sender = $_GET['sender'];
    } 
	$timeStamp = time(); 
	$read = 0; 
	if (!empty($_POST["input_message"])){
		$content = $_POST["input_message"];	
	}


/*	echo "Chat ID: $chatID <br>";
	echo "Sender: $sender <br>";
	echo "Receiver: $receiver <br>";
	echo "First Message: $firstMessage <br>";*/

    if($firstMessage) { 
        $sql_insert = "INSERT INTO `currentChats` (`user1`, `user2`, `chatID`) VALUES ('$sender', '$receiver', '$chatID')";
	    if($con->query($sql_insert) === TRUE) { 
			$_SESSION['RESULTMESSAGE']="The message has been sent successfully!";
/*			error_reporting(E_ALL);
	        header("Location: messaging.php"); */
	    } 
    } 
	
	
    
    $sql_send = "INSERT INTO messagesDB (`sender`, `reciever`, `content`, `read`, `timestamp`, `chatID`) VALUES ('$sender', '$receiver', '$content', '$read', '$timeStamp', '$chatID')";
	
	if ($con->query($sql_send) === TRUE) {
		$_SESSION['RESULTMESSAGE']="The message has been sent successfully!";
		error_reporting(E_ALL);
		header("Location: messaging.php?");
	} 
    
// close connection
    mysqli_close($con);
?>