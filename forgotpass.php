<?php
   include 'session.php';
   
   if( isset( $_SESSION['uniqueUsername'] ) ) {
	   header("Location: index.php");
   }

   include 'dbconnect.php';

?>



<?

	

	if (isset($_POST['forgotPassSubmit'])){
		
		unset($_SESSION['resetResult']);
		
		$uname = test_input($_POST['uname']);
		$email_address = test_input($_POST['email']);
		
		$hashed_username = md5($uname);
		
		$sql0 = "SELECT * FROM `USERDATA` WHERE `username` LIKE '$hashed_username' AND `email` LIKE '$email_address' LIMIT 1 ";
		$result = mysqli_query($con, $sql0);
		$row = mysqli_fetch_array($result);

		if ($row){
			
			$hash  = $row['hash'];
			$first_name = $row['firstname'];
			$last_name = $row['lastname'];
			
			$name = $first_name." ".$last_name;
			
			$unhashedUsername = $uname;
			
			
			$to = $email_address; // Send email to our user
			$subject = 'ResetPassword | Verification'; // Give the email a subject 
			$message = 'Hello '.$name.'
	
You have requested to reset you password, ignore this email if you did not.
------------------------
Username: '.$unhashedUsername.'
------------------------
Please click this link to reset your password:
http://airbnb.drsvr.co/changePassScript.php?email='.$email_address.'&hash='.$hash.'

Thanks for being a member of Overnite!

'; 

	// Our message above including the link

	$headers = 'From:noreply@overnite.drsvr.co' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
	
	mysqli_close($con);  
	
	header("Location: forgotpass.php");
			
			
			
		    $_SESSION['resetResult'] = "emailSent";	
		}
		else {
			
			$_SESSION['resetResult'] = "usernotFound";
		}
	}



?>

<html>
    
    <head>
        <link type="text/css" rel="stylesheet" href="css/signup.css" />
        <link type="text/css" rel="stylesheet" href="css/navBar.css" />
		<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="js/navBar.js"> </script>
		<script src="js/liveSearch.js"></script>
		
		<title>Forgot Password</title>
    </head>
    
    <body>
    
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

    <form id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        
        <h1 class="reg_title">Please fill this form to reset you password!</h1>
        
        <div class="reg_form">
			
			<?
				if (  (isset($_SESSION['resetResult'])) && ($_SESSION['resetResult']=="emailSent") ){
					echo '<center><label class="success">We should recieve a link to reset your password in the next few minutes!</label></center><br>';
					unset($_SESSION['resetResult']);
				}
			
				if (  (isset($_SESSION['resetResult'])) && ($_SESSION['resetResult']=="usernotFound") ){
					echo '<center><label class="error">Sorry, your username and Email combination is not valid!</label></center><br>';
					unset($_SESSION['resetResult']);
				}

			?>
			
        	<div id="signup_err">
        		Please fill out all of the required fields.
        	</div>
		    
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required/>
            
            <label><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required/>
                
            <input type="submit" ID="submitbtn" name="forgotPassSubmit" value="Submit"/>
        </div>
      
															 
    </form>
           
        <!--Checks if password meets requirements    -->
	    <script>
	    	$("#psw").focus( function() {
	        	$("#password-msg").show();
		    });
		    
		    $("#psw").blur(function() { 
		    	$("#password-msg").hide();
		    });
		    
		    $("#psw").keyup(function() { 
		    	var lowerCaseLetter = /[a-z]/g; 
		    	if( lowerCaseLetter.test($("#psw").val()) ) { 
		    		$("#lower").removeClass("invalid"); 
		    		$("#lower").addClass("valid"); 
		    		
		    	} 
		    	else { 
		    		$("#lower").removeClass("valid"); 
		    		$("#lower").addClass("invalid"); 
		    	}
		    	
		    	var upperCaseLetter = /[A-Z]/g; 
		    	if( upperCaseLetter.test($("#psw").val()) ) { 
		    		$("#upper").removeClass("invalid"); 
		    		$("#upper").addClass("valid"); 
		    		
		    	} 
		    	else { 
		    		$("#upper").removeClass("valid"); 
		    		$("#upper").addClass("invalid"); 
		    	}
		    	
		    	var numbers = /[0-9]/g; 
		    	if( numbers.test($("#psw").val()) ) { 
		    		$("#number").removeClass("invalid"); 
		    		$("#number").addClass("valid"); 
		    		
		    	} 
		    	else { 
		    		$("#number").removeClass("valid"); 
		    		$("#number").addClass("invalid"); 
		    	}
		    	
		    	var specialChars = /[!@#$%^&*]/g; 
		    	if( specialChars.test($("#psw").val()) ) { 
		    		$("#special").removeClass("invalid"); 
		    		$("#special").addClass("valid"); 
		    		
		    	} 
		    	else { 
		    		$("#special").removeClass("valid"); 
		    		$("#special").addClass("invalid"); 
		    	}
		    	
		    	if( $("#psw").val().length >= 6) { 
		    		$("#length").removeClass("invalid"); 
		    		$("#length").addClass("valid"); 
		    	} 
		    	else { 
		    		$("#length").removeClass("valid"); 
		    		$("#length").addClass("invalid"); 
		    	} 
		    }); 
	    </script>
	    
	    <!--Checks if passwords match-->
	    <script>
	    	$("input:password").blur(function() { 
	    		var pass = $("#psw").val(); 
	    		var pass2 = $("#psw2").val(); 
	    		if(pass.length > 0 && pass2.length > 0  && pass != pass2) {
	    			$("#psw2").removeClass("validInput");
	    			$("#psw2").addClass("invalidInput");
	    		} 
	    		else if(pass.length > 0 && pass2.length > 0 && pass == pass2) { 
	    			$("#psw2").removeClass("invalidInput");
	    			$("#psw2").addClass("validInput");
	    		}
	    	});
	    </script>
	    
	    <script>
			$("form input").on("invalid", function(event) { 
				event.preventDefault(); 
				$("#signup_err").show();
			});
			
	    </script>
    </body>

</html>