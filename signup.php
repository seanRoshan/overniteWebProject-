<?php
   include 'session.php';
   
   if( isset( $_SESSION['uniqueUsername'] ) ) {
	   header("Location: index.php");
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
		
		<title>Join Overnite</title>
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

    <form id="signup" action="signup_action.php" method="post">
        
        <h1 class="reg_title">Sign up to join the Overnite community.</h1>
        
        <div class="reg_form">
			
			<? if (isset($_GET['registed'])){ echo '<center><label class="success">Welcome to the Overnite, Please verify your email to activate you account! You will recieve an activation email in the next few minutes!</label></center><br>';}?>
			
			<? if (isset($_GET['duplicateuser'])){ echo '<center><label class="error">Sorry, your username is already taken, please try another username</label></center><br>';}?>
			
        	<div id="signup_err">
        		Please fill out all of the required fields.
        	</div>
            <label><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" id="fname" required/>
                
            <label><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" required/>
                
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required/>
            
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}" required/>
            <div id="password-msg">
            	<p><b>Password must contain the following: </b></p>
            	<p id="lower" class="invalid">A lowercase letter</p>
            	<p id="upper" class="invalid">A uppercase letter</p>
            	<p id="number" class="invalid">A number</p>
            	<p id="special" class="invalid">A special character (!@#$%^&*)</p>
            	<p id="length" class="invalid">Minimum of 6 characters</p>
            </div>
            
            <label><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="psw2" id="psw2" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}" required/>
                
            <label><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required/>
                
            <input type="submit" ID="submitbtn" name="Submit" value="Submit"/>
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
			
			// $("#signup").validate({
			// 	errorElement: 'input',
			// 	highlight:
			// 	function(element, errorClass) {
			// 		$(element).addClass(errorClass); },
			// 	unhighlight:
			// 	function(element, errorClass) {
			// 		$(element).removeClass(errorClass); }
			// });
	    </script>
    </body>

</html>