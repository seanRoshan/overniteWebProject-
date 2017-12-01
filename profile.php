<?php include 'session.php';?>
<? 
if (  ( !isset($_GET['username']) ) && (  !isset($_SESSION["uniqueUsername"]) )  ) {
	header("Location: index.php");
}    
?>
<?php include 'dbconnect.php';?>


<? 
	if ( isset($_GET['username'] ) ){
		
		$userName = $_GET['username'];
		$sql0 = "SELECT * FROM USERDATA WHERE `uniqueUsername` LIKE '$userName'";
        $result = mysqli_query($con, $sql0);
        $row = mysqli_fetch_array($result);
		
		if ($row){
			$first = $row['firstname'];
        	$last = $row['lastname'];
        	$city = $row['city'];
        	$country = $row['country'];
        	$description = $row['info'];
			$avator = $row['avator'];
		}

	}
	else if (isset($_SESSION["uniqueUsername"])){
		
		$userName = $_SESSION["uniqueUsername"];
		$sql0 = "SELECT * FROM USERDATA WHERE `uniqueUsername` LIKE '$userName'";
        $result = mysqli_query($con, $sql0);
        $row = mysqli_fetch_array($result);	
		if ($row){
			$first = $row['firstname'];
        	$last = $row['lastname'];
        	$city = $row['city'];
        	$country = $row['country'];
        	$description = $row['info'];
			$avator = $row['avator'];
		}
		else{
			unset($_SESSION["uniqueUsername"]);
			header("Location: index.php");
		}
		
	}
	else{
		header("Location: index.php");
	}
	
    if (isset($_POST['Cancelled']))
    {
    	$listingN = $_POST['listingN'];
    	if($listingN != "")
    	{
    	    $sql10 = "DELETE FROM `BOOKINGTABLE` WHERE `listname` LIKE '$listingN'";
            mysqli_query($con, $sql10);
            $sql11 = "DELETE FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$listingN'";
            mysqli_query($con, $sql11);
            header("Location: profile.php");
    	}
    	else 
    	{
    	    header("Location: profile.php");
    	}
    }

?>


<html>
        <head>
            <link type="text/css" rel="stylesheet" href="css/profile.css" />
            <link type="text/css" rel="stylesheet" href="css/navBar.css" />
			<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
            <script src="js/navBar.js"> </script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
			<script src="js/liveSearch.js"></script>
            <title>Profile</title>
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
	
	<div class="modal" id="login" <? if ( ( isset($_GET['wrongpass']) ) || ( isset($_GET['notactive']) ) ){ echo 'style="display: block"'; } ?> >
		<form action="security.php" class="modal-content animate" method="post">
			<div class="imgcontainer">
				<span class="close" onclick="document.getElementById('login').style.display='none'" title="Close Modal">&times;</span>
			</div>
			<div class="container">
				<label><b>Username</b></label> 
				<input name="uname_login" placeholder="Enter Username" required="" type="text"> 
				<label><b>Password</b></label> 
				<input name="psw_login" placeholder="Enter Password" required="" type="password"> 
				<? if (isset($_GET['wrongpass'])){ echo '<label class="error">Wrong Password, Please Try Again!</label>';}?>										
				<? if (isset($_GET['notactive'])){ echo '<label class="error">You account is not active yet, please click on the activation link in your Email!</label>';}?>				
				<input id="submitbtn" name="Login" type="submit" value="Login">
			</div>
			<div class="container" style="background-color:lightgrey">
				<button class="signupbtn" onclick="location.href='signup.php'" type="button">Sign up</button> <span class="psw">Forgot <a href="forgotpass.php" style="color:#57D7AC; font-weight:bold">password?</a></span>
			</div>
		</form>
	</div>	
			
			
			
			
           <style>
                /* The Modal (background) */
                .initial_modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1; /* Sit on top */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                    padding-top: 60px;
                }
                
                /* Modal Content/Box */
                .initial_modal-content {
                    background-color: #fff;
                    border: 1px solid #888;
                    width: 40%; /* Could be more or less, depending on screen size */
                    height: 40%;
                    margin-top: 5%;
                    margin-left: 30%;
                    margin-right: 30%;
                    overflow: auto;
                    position: relative;
                    color: darkgrey;
                    text-align: center;
                }
                
                .initial_close {
                    position: absolute;
                    right: 3%;
                    top: 9px;
                    color: #000;
                    font-size: 35px;
                    font-weight: bold;
                }
                
                .initial_close:hover,
                .initial_close:focus {
                    color: red;
                    cursor: pointer;
                }
                .initial_message_block {
                    clear: both;
                    padding: 20px;
                    position: relative;
                }
                .sendmessage_btn {
                    background-color: #61E1B6;
                    font-family: 'Champagne', Times, serif;
                    color: white;
                    font-weight: bold;
                    font-size: 15px;
                    padding: 0px 10px;
                    border: none;
                    /* Shape of mouse cursor is pointer*/
                    cursor: pointer;
                    width: auto;
                    height: auto;
                    float: right;
                    border-radius: 3%;
                    margin-top: 2%;
                }
                #initial_message_input {
                    font-size: 15px;
                    width: 100%;
                }
                .view_listing_Btn {
                    background-color: #61E1B6;
                    border: none;
                    width: auto;
                    clear: both;
                    cursor: pointer;
                    margin-right: auto;
                    margin-left: auto;
                    border-radius: 3px;
                    color: white;
                    font-weight: bold;
                    padding: 7px 10px;
                }
            </style>

        <?
         $curruser = $_SESSION["uniqueUsername"];
            if (!isset($_SESSION['uniqueUsername']) || $curruser == $userName){
            	echo '<div class="avatar_contact">
                <img src="'.$avator.'" alt="Avatar" class="avatar">
            	</div>';
            }
            else {
            	echo '<div class="avatar_contact">
                <img src="'.$avator.'" alt="Avatar" class="avatar">
                 <a href="#initialsid" style="color:inherit" onclick="document.getElementById(\'initialsid\').style.display=\'block\'">
                 <button id="contactme" class="contactBtn">Contact Me</button></a>
            	</div>';
            }
            echo '<div class="name_location"> <h2>Hey, I\'m '.$first.' '.$last.'!</h2>';
			
            echo '<p>'.$city.', '.$country.'</p></div>';
            
            echo '<div class="profile_description"> <p>'.$description.'</p></div>';
		?>
		
		<? 
		    // The user that is logged in
		    $sender = $_SESSION["uniqueUsername"];
		    // Creates a new chatID
		    $sql_chats = "SELECT * FROM `currentChats` WHERE `user1` LIKE '$userName' OR `user2` LIKE '$userName'";
		    $query_chats = mysqli_query($con, $sql_chats);
		
		    $firstMessage = true; 
		    while($row = mysqli_fetch_array($query_chats)) {  
                if( ($row['user1'] === $sender && $row['user2'] === $userName) || ($row['user2'] === $sender && $row['user1'] === $userName) ) { 
                    $chatID = $row['chatID']; 
                    $firstMessage = false; 
                    break; 
                } 
            }
	        
	        if($firstMessage) { 
	           $chatID = rand(10, 100000);
				//$firstMessage = false;
				
	           echo '<div class="initial_modal" id="initialsid">';
                echo '<form action="sendMessage.php?chatID='.fixURL($chatID).'&receiver='.fixURL($userName).'&sender='.fixURL($sender).'&fm='.fixURL($firstMessage).'"class="initial_modal-content" method="post">'; 
                echo '<span onclick="document.getElementById(\'initialsid\').style.display=\'none\'" class="initial_close" title="Close Modal">&times;</span>';
                        echo '<div style="padding: 50px">';
                        echo '<p style="font-size: 20px">First Message</p>';
                        echo '<form class="initial_message_block">';
                                echo '<input type="text" placeholder="Enter message" name="input_message" ID="initial_message" required>';
                                echo '<button type="submit" value="Send" style="background-color: #61E1B6;border: none;width: 25%;cursor: pointer;border-radius: 3px;">Send</button>';
                        echo '</form>';
                        echo '</div>';
                echo '</div>'; 
            echo '</div>'; 
	        } 
	        else { 
	            echo '<div class="initial_modal" id="initialsid">';
                echo '<form action="sendMessage.php?chatID='.fixURL($chatID).'&receiver='.fixURL($userName).'&sender='.fixURL($sender).'&fm='.fixURL($firstMessage).'" class="initial_modal-content" method="post">'; 
                echo '<span onclick="document.getElementById(\'initialsid\').style.display=\'none\'" class="initial_close" title="Close Modal">&times;</span>';
                        echo $sender; 
                        echo " "; 
                        echo $userName; 
                        echo "<br>";
                        echo '<div style="padding: 50px">';
                        echo '<p style="font-size: 20px">Send a message!</p>';
                        echo '<form class="initial_message_block">';
                                echo '<input type="text" placeholder="Enter message" name="input_message" ID="initial_message" required>';
                                echo '<button type="submit" value="Send" style="background-color: #61E1B6;border: none;width: 25%;cursor: pointer;border-radius: 3px;"">Send</button>';
                        echo '</form>';
                        echo '</div>';
                echo '</div>'; 
            echo '</div>'; 
	        } 

		?>
        
        <script>
            $(document).ready(function(){
                tempList = document.getElementsByClassName("listings_container");
                if(tempList.length <= 3) {
                    $("#showmore").hide();
                }
                tempList2 = document.getElementsByClassName("indv_rev");
                if(tempList2.length <= 3) {
                    $("#showmore2").hide();
                }
            });  
        </script>
        
        <script>
            var cnt = 3;
            listings = document.getElementsByClassName("listings_container");
            $(function () {
                $(".listings_container").slice(0, 3).show();
                    $("#showmore").on('click', function (event) {
                        event.preventDefault();
                        if( $("#showmore").attr('value') == 'Show More') {
                            if((cnt + 3) < listings.length) {
                                cnt = cnt + 3;
                            }
                            else {
                                $("#showmore").attr('value', 'Show Less');
                            }
                            $(".listings_container:hidden").slice(0, 3).slideDown();
                        }
                        else {
                            cnt = 3;
                            $(".listings_container").hide();
                            $(".listings_container").slice(0, 3).show();
                            $("#showmore").attr('value', 'Show More');
                        }
                    });
            });
            
            var cnt2 = 3;
            reviewslist = document.getElementsByClassName("indv_rev");
            $(function () {
                $(".indv_rev").slice(0, 3).show();
                    $("#showmore2").on('click', function (event2) {
                        event2.preventDefault();
                        if( $("#showmore2").attr('value') == 'Show More') {
                            if((cnt2 + 3) < reviewslist.length) {
                                cnt2 = cnt2 + 3;
                            }
                            else {
                                $("#showmore2").attr('value', 'Show Less');
                            }
                            $(".indv_rev:hidden").slice(0, 3).slideDown();
                        }
                        else {
                            cnt2 = 3;
                            $(".indv_rev").hide();
                            $(".indv_rev").slice(0, 3).show();
                            $("#showmore2").attr('value', 'Show More');
                        }
                    });
            });
        </script>
        
        <div class="heading"><h2>Listings</h2></div>
        
        <div style="margin-left: 20%">  
            
            <?
/*                if($_GET["username"] == "")
        		{
        		    $userName = $_SESSION["uniqueUsername"];
        		}
        		else
        		{
        		    $userName = $_GET["username"];
        		}*/
			
        		$sql0 = "SELECT * FROM `LISTINGTABLE` WHERE `username` LIKE '$userName'";
                $result = mysqli_query($con, $sql0);
                
                $listing_message = -1;
        		while($row = mysqli_fetch_array($result))
        		{
        		    $listing_message = 1;
        			$uniquelistName = $row['uniqueListingname'];
        			$uniqueuserName = $row['username'];
                    $listingTitle = $row['listingTitle'];
                	$price = $row['price'];
                	$location = $row['city'];

					$sql_img = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$uniquelistName' LIMIT 1";
					$result1_img = mysqli_query($con, $sql_img);
					$row = mysqli_fetch_array($result1_img);
					
					if ($row>0){
						$listImageURL = $row['url']; 
					}
					else {
						$listImageURL = "img/finalOverniteLogo_NEW2.png";
					}

                	
                	$sql1 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistName'";
                	$result1 = mysqli_query($con, $sql1);

                    echo '<a href="individual_listing.php?listname='.$uniquelistName.'" style="color:inherit">';
                    echo '<div class="listings_container" style="padding-bottom:80px">';
                    echo  '<img src="'.$listImageURL.'" alt="temp listing">';
                    echo '<div class="listing_desc">';
                    echo '<div class="title"><b>'.$listingTitle.'</b></div>';
                    echo '<div class="location"><b>'.$location.'</b></div>';
                    echo '<div class="cost">$'.$price.' per night</div>';
                    
                    if($uniquelistName != "")
                    {
                        $sql2 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistName'";
        		
                		$result1 = mysqli_query($con, $sql2);
                        
                	    $sumStars = 0;
                	    $reviewCount = 0;
                	
                		while($row = mysqli_fetch_array($result1)){
                			   $sumStars = $sumStars + $row['stars'];
                			   $reviewCount++;
                		}
                		if($reviewCount == 0)
                		{
                		    $reviewAvg = 0;
                		    $fullStar = 0;
                		}
                		else {
                		    $reviewAvg = $sumStars / $reviewCount;
                		    $fullStar = floor($sumStars / $reviewCount);
                		}
                	
                		$halfStar = false;
                		if ($reviewAvg>$fullStar){
                			$halfStar = true;
                		}
                	
                		$emptyStar = 5 - ($fullStar + $halfStar);
                		    echo '<div style="font-family:"champagne" align="right"> Review: ';
        			  		for ($s = 0; $s < $fullStar; $s++) {
        						echo '<span id="star5" class="fa fa-star bigger" style="color:ORANGE;" align="right"></span>';
        					}
        			  
        			  		for ($s = 0; $s < $halfStar; $s++) {
        						echo '<span id="star1" class="fa fa-star-half-full bigger" style="color:ORANGE" align="right"></span>';
        					} 
        			  
        					for ($s = 0; $s < $emptyStar; $s++) {
        						echo '<span id="star1" class="fa fa-star-o bigger" align="right"></span>';
        					}
                    }
                    else
                    {
                        echo '<div style="font-family:"champagne" align="right"> Review: ';
                        for ($i = 0; $i < 5; $i++) 
                        {
        						echo '<span id="star1" class="fa fa-star-o bigger"></span>';
        				}
                    }
                    echo '</div></div>';
                    if ($userName == $_SESSION["uniqueUsername"])
                    {
                        echo '<form action="profile.php" method="post">'; 
                                        echo '<input type="submit" name="Cancelled" value="Cancel Listing" id="view_listing" class="view_listing_Btn" style="margin-bottom: 3%">';
                                        echo '<input id="listingN" name="listingN" type="hidden" value="'.$uniquelistName.'">';
                        echo '</form>';
                	}
                    echo '</div></a>';
                }
                if ($listing_message == -1)
                {
                    echo '<div style="clear:both"><h3>No listings yet.</h3></div>';
                }
		    ?>
        </div>

        
        <input type="button" value="Show More" id="showmore" class="showmoreBtn">

        <div class="heading"><h2>Reviews</h2></div>

        <div class="reviews">
            <?
        		// Retrive Comments 
/*        		if($_GET["username"] == "")
        		{
        		    $userName = $_SESSION["uniqueUsername"];
        		}
        		else
        		{
        		    $userName = $_GET["username"];
        		}*/
        		$sql4 = "SELECT * FROM `LISTINGTABLE` WHERE `username` LIKE '$userName'";
                $result4 = mysqli_query($con, $sql4);
                if($result4 === FALSE)
                {}
                else
                {
                    $review_message = -1;
                    while($row = mysqli_fetch_array($result4))
                    {
                        $review_message = 1;
                        $listing = $row['uniqueListingname'];
                		$sql3 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$listing'";
                        $result3 = mysqli_query($con, $sql3);
                        if($result3 === FALSE)
                        {}
                        else
                        {
                            while($row = mysqli_fetch_array($result3))
                            {
            			
                    			echo '<div class="indv_rev" style="border-bottom:thin solid lightgray; margin-top:0px;padding-top:0px">';
                    			
                    			//$img_url = $row['avatar'];	
                    			
                    			$name = $row['username'];
                    			
                    			// Get the profile image of the reviewer
                    			$sql_revUser = "SELECT * FROM USERDATA WHERE `uniqueUsername` LIKE '$name'";
                    			$result_revUser = mysqli_query($con, $sql_revUser);
                    			$row_revUser = mysqli_fetch_array($result_revUser);
                    			if($row_revUser) {
                    			    $img_url = $row_revUser['avator'];
                    			}
                    			
                    			$name = substr($name, strpos($name, "_") + 1); 
                    			
                    			echo '<img src='.$img_url.' alt="Avatar" class="rev_avatar">';
                    			echo '<p style="float: left">&nbsp;'.$name.'</p>';
                    
                    			echo "<div><br>";
                    			
                    			$starCount = $row['stars'];
                    			$offStars = 5 - $starCount;
                    		
                    			for ($s = 0; $s < $offStars; $s++) {
                    				echo '<span id="star1" class="fa fa-star-o" style="float:right"></span>';
                    			}
                    			
                    			for ($s = 0; $s < $starCount; $s++) {
                    				echo '<span id="star1" class="fa fa-star " style="float:right;color:ORANGE"></span>';
                    			} 
                    			 
                    			echo "</div><br>";
                    			echo '<p style="text-align: left; margin-top: 30px;">'.$row['comment'];
                    			echo '</p></div>';
            		        }
                        }
                    }
                    if ($review_message == -1)
                    {
                        echo '<div style="clear:both; margin-left: 20%"><h3>No reviews yet.</h3></div>';
                    }
                }
		    ?>
            
        </div>

        <input type="button" value="Show More" id="showmore2" class="showmoreBtn2">

        </body>
        
</html>