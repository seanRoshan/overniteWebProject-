<?php include 'session.php';?>
<?php include 'dbconnect.php';?>
<?
if (!isset($_SESSION['uniqueUsername'])){
	header("Location: index.php");
}
?>

<html>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        
        <head>
            <link type="text/css" rel="stylesheet" href="css/navBar.css" />
            <link type="text/css" rel="stylesheet" href="css/messaging.css" />
	        <link type="text/css" rel="stylesheet" href="css/searchBar.css" />
            <script src="js/navBar.js"> </script>
            <script src="js/liveSearch.js"></script>
            <title>Messages</title>
        </head>
        
        <body style="background-color:white;font-family:'Champagne', Times, serif;">
            
            <div class="navbar">
				<ul class="nav">
					<li style="list-style: none; display: inline">
						<a href="index.php"><img alt="bigO" class="head_logo" src="img/Overnite_O.png" style="float:left;"></a>

								<?
								if (isset($_SESSION['uniqueUsername'])){
									echo '<div class="dropdown">';
									echo '<img class="dropbtn" onclick="myFunction()" src="img/popdown_menu_gray.png">';
									echo '<div class="dropdown-content" id="myDropdown">';
									echo '<a href="profile.php?'.$_SESSION['uniqueUsername'].'">Profile</a> ';
									echo '<a href="editprofile.php">Edit Profile</a>';
									echo '<a href="messaging.php">Messages</a> ';
									echo '<a href="?logout=1">Log Out</a>';
									echo '</div>';
									echo '</div>';
								}						
								?>

					</li>

					<div class="search-box">
								<input type="search" autocomplete="off" placeholder="Search...">
								<div class="result"></div>
					</div>

						<?
						if (isset($_SESSION['uniqueUsername'])){
							echo '<li class="navb">';
							echo '<a href="trips.php">Trips</a>';
							echo '</li>';
							echo '<li class="navb">';
							echo '<a href="listing_ms.php">Become a host</a>';
							echo '</li>';
						}
						else {
							echo '<li class="navb">';
							echo '<a href="signup.php">SIGNUP</a>';
							echo '</li>';
							echo '<li class="navb">';
							echo '<a href="#login" onclick="document.getElementById('."'login')".'.style.display='."'block'".'">LOGIN</a>';
							echo '</li>';
						}
						?>
					</ul>
				</div>
        	
			
			
			
			<?
			
				
			
				$owner = $_SESSION['uniqueUsername'];
			 //   echo $owner;
				// $sender_name = "";
				// $reciever_name = "";
				// $content = "";
				// $conversation_id = "";
				// $readStatus = "";
			
				
				// Fetch All messages from the user
				// $sql_messages = "SELECT UNIQUE `conversation_id`, ` FROM `messagesDB` WHERE `sender` LIKE '$owner' or `reciever` LIKE '$owner'";
				
				// $result_messages = mysqli_query($con, $sql_messages);
      
				// while($message = mysqli_fetch_array($result)){
				// 	$sender_name = $message['sender'];
				// 	$reciever_name = $message ['reciever'];
				// 	$content = $message['content'];
				// 	$conversation_id = $message['id'];
				// 	$readStatus = $message['read'];
				// }
			
			
				
			
			
			    // Send a message
				// $current_conversation_id = 1;
				// $tempSender = "1510817642_mcast052";
				// $tempReceiver = "1510804950_timoo";
				// $timeStamp = time(); 
				// $sql_send = "INSERT INTO `messagesDB` (`sender`, `reciever`, `content`, `id`, `read`) VALUES ('$tempSender', '$tempReceiver', 'WAZZUP TIA', '$current_conversation_id', '0')";
			
				// mysqli_query($con, $sql_messages);
				// $sql_send = "INSERT INTO `messagesDB` (`sender`, `reciever`, `content`, `read`, `timestamp`, `uniqueID`, `chatID`) VALUES ('$tempSender', '$tempReceiver', 'WAZZUP TIA', '0', '$timeStamp',' ', '1234')";

	           // mysqli_query($con, $sql_send); 
				
			?>

            <div class="outer">
            <div class="title"><h2 style="text-align: center">Inbox</h2>
            </div>
            
            <? 
				if ( isset($_SESSION['RESULTMESSAGE']) ){
						echo '<center><label class="success">'.$_SESSION['RESULTMESSAGE'].'</label></center><br>';
						unset($_SESSION['RESULTMESSAGE']);
				}
				
                // Gets an array of all the chats I'm a part of
            	$sql_chats = "SELECT * FROM `currentChats` WHERE `user1` LIKE '$owner' OR `user2` LIKE '$owner'";
            	$result_chats = mysqli_query($con, $sql_chats);
            	
                if($result_chats) {
                    echo '<div id="inbox" class="inbox">';
                    while($row = mysqli_fetch_array($result_chats))
            		{ 
            		    $chatID = $row['chatID']; 
                        $user2 = "";
                        if($owner === $row['user1']) { $user2 = $row['user2']; } 
                        else { $user2 = $row['user1']; } 
                        
                        $sql_user2 = "SELECT * FROM USERDATA WHERE `uniqueUsername` LIKE '$user2'";
                        $result_user2 = mysqli_query($con, $sql_user2);
                        $row_user2 = mysqli_fetch_array($result_user2);
                        if($row_user2) { 
                            $img_url = $row_user2['avator'];
                            $fname = $row_user2['firstname'];
                            $lname = $row_user2['lastname']; 
                        }
                        
                        echo "<a href=\"#id101\" onclick=\"document.getElementById('$chatID').style.display='block';scrollToBottom();\"><div class=\"Read\"><img src=\"$img_url\" class=\"imgid\"><p>$fname $lname</p></div></a>";
                        
                        $sql_messages = "SELECT * FROM `messagesDB` WHERE `chatID` LIKE '$chatID' ORDER BY `timestamp` ASC";
                        $result_messages = mysqli_query($con, $sql_messages); 
                        echo '<div class="message_modal" id="'.$chatID.'">';
                        echo '<form action="sendMessage.php?chatID='.fixURL($chatID).'&receiver='.fixURL($user2).'&sender='.fixURL($owner).'" class="message_modal-content animate" method="post">';
                        echo '<div class="xcontainer">';
                        echo '<span onclick="document.getElementById(\''.$chatID.'\').style.display=\'none\'" class="message_close" title="Close Modal">&times;</span>';
                        echo '</div>';
                        echo '<div class="sender">';
                        echo "<h1>$fname $lname</h1>";
                        echo '</div>';
                        echo '<div class="chat_container" id="chatcont">';
                        
                        while($row_msg = mysqli_fetch_array($result_messages)) {
                            //Query messagesDB to get all messages by chatID
                            //  LOOP TO FILL WITH MESSAGES IN EACH CHAT
                            // If I am sender, create right bubble
                            $content = $row_msg['content'];
                            $ts=$row_msg['timestamp'];
                            $t=(date("H:i",$ts));
                            $sender = $row_msg['sender'];

                            if($owner === $sender) { //chat class
                                echo '<div class="chat">';
                                echo '<p>'.$content.'</p>';
                                echo '<p class="message_time">'.$t.'</p>';
                                echo '</div>';
                            } 
                            // Else, create left bubble
                            else { // other class
                                echo '<div class="other">';
                                echo '<p>'.$content.'</p>';
                                echo '<p class="message_time">'.$t.'</p>';
                                echo '</div>';
                            } 
                            
                        }
                        echo '</div>';
                        echo '<div class="new_message_block">';
                        echo '<input type="text" name="input_message" class="message_input">';
                        echo '<button type="submit" class="sendmessage_btn" value="Send">Send</button>';
                        
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
            		} 
            		echo '</div>';
            		
                }
                else { 
                    echo "<div>No messages? Go to a host's profile to start a message!</div>"; 
                } 
                    //<script>
            /* global $ */
            /*$('#$chatID\').on(\'hidden.bs.modal\', function() {
             return false;
            });
            </script>*/
            
            ?>
            
            <script>
            /* global $ */
             function scrollToBottom(){
               $('.chat_container').scrollTop($('.chat_container')[0].scrollHeight);
            }
            </script>
            
        </body>
        
</html>
