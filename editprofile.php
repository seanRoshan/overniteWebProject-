<?php include 'session.php';?>
<?
if (!isset($_SESSION['uniqueUsername'])){
	header("Location: index.php");
}


$tabVar = 'AS';

if ( isset($_GET['CP']) ){
	$tabVar = 'CP';
}
else if (isset($_GET['EP']) ){
	$tabVar = 'EP';
}
else {
	$tabVar = 'AS';
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

$uname = $_SESSION['uniqueUsername'];	

$query = "SELECT * FROM USERDATA WHERE uniqueUsername='".$uname."' LIMIT 1";

$result_type = mysqli_query($con, $query);

$fname = $lname = "";

if ($row = mysqli_fetch_array($result_type)) {
	
	$fname = $row['firstname'];
	$lname = $row['lastname'];
	
	$avator = $row['avator'];
	$city = $row['city'];
	$country = $row['country'];
	$info = $row['info'];
		
}
else{
	unset($_SESSION['uniqueUsername']);
	header("Location: index.php");
}





?>



<html>
    
    <head>
        <link type="text/css" rel="stylesheet" href="css/signup.css" />
        <link type="text/css" rel="stylesheet" href="css/navBar.css" />
		<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
		<link type="text/css" rel="stylesheet" href="css/ep.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="js/navBar.js"> </script>
		<script src="js/liveSearch.js"></script>
		
		<title>Edit Settings</title>
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
	
    <div class="tab">
      <button class="tablinks" onclick="openT(event, 'AS')" <?  if ($tabVar=='AS'){ echo 'id="defaultOpen"' ; } ?> >Personal Information</button>
      <button class="tablinks" onclick="openT(event, 'EP')" <?  if ($tabVar=='EP'){ echo 'id="defaultOpen"' ; } ?> >Edit Profile</button>
	  <button class="tablinks" onclick="openT(event, 'CP')" <?  if ($tabVar=='CP'){ echo 'id="defaultOpen"' ; } ?> >Change Password</button>
    </div>
    
    <div id="AS" class="tabcontent">
      <h3 style="text-align:center">Change your personal information</h3>
      <hr>
      <br>
        <form action="account_settings.php" method="post">
            <div class="edit">
				<? if (isset($_GET['personalInfoChanged'])){ echo '<center><label class="success">Personal info has been changed successfully!</label></center><br>';}?>
                <label><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" <? echo 'value="'.$fname.'" '?> required>
                    
                <label><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" <? echo 'value="'.$lname.'" '?> required>
                    
                <input type="submit" ID="submitbtn" name="personalInfo" value="Save Changes"/>
            </div>
        </form>
    </div>
    
    <div id="EP" class="tabcontent">
      <h3 style="text-align:center">Change your profile information</h3>
      <hr>
      <br>
        <form action="account_settings.php" method="post" enctype="multipart/form-data">
            <div class="edit">
                
				<? if (isset($_GET['profileInfoChanged'])){ echo '<center><label class="success">The profile info has been changed successfully!</label></center><br>';}?>
				<? if (isset($_GET['notImg'])){ echo '<center><label class="error">The file is not an image!</label></center><br>';}?>
				<? if (isset($_GET['invalidType'])){ echo '<center><label class="error">We only accept .jpg .jpeg and .png formats!</label></center><br>';}?>
				<? if (isset($_GET['largeImg'])){ echo '<center><label class="error">The image is too large, the images should be less then 10MB!</label></center><br>';}?>
				
				
                <img <? echo 'src="'.$avator.'" ' ?> alt="avatar" height="150" width="150" style="border-radius: 100%;display: block;margin: auto">
                <br>
                
				<center><div class="file">
				  	
				  <label for="file-input">Choose a Photo</label>
				  <input name="filesToUpload" id="filesToUpload" type="file"/>
				</div></center>
				
                <br>
				<br>
                
                <label><b>City</b></label>
                <input type="text" placeholder="Enter city" name="city" <? echo 'value="'.$city.'" '?> required>
                    
                <label><b>Country</b></label>
                <input type="text" placeholder="Enter country" name="country" <? echo 'value="'.$country.'" '?> required>
                
                <label><b>Tell us about yourself</b></label>
                <textarea id="descBox" name="descBox" rows="8" columns="100" maxlength="300" style="padding:8px;width:100%;min-width:60%;margin-top:10px;margin-bottom:10px;font-family:'Champagne', Times, serif;" placeholder="All about me..."><? echo $info ?></textarea>
                    
                <input type="submit" ID="submitbtn" name="profileInfo" value="Save Changes"/>
            </div>
        </form>
    </div>
	
	<div id="CP" class="tabcontent">
      <h3 style="text-align:center">Change your password</h3>
      <hr>
      <br>
        <form action="account_settings.php" method="post" >
            <div class="edit">
				<? if (isset($_GET['oldPassWrong'])){ echo '<center><label class="error">Sorry! Wrong old Password, Please Try Again!</label></center><br>';}?>
				<? if (isset($_GET['newpasswordNotMatched'])){ echo '<center><label class="error">Sorry! You new passwords does not match!</label></center><br>';}?>
				<? if (isset($_GET['passwordChanged'])){ echo '<center><label class="success">You password has been changed successfully!</label></center><br>';}?>
				<label><b>Old Password</b></label>
                <input type="password" placeholder="Enter Password" name="pswOld" required>
                    				
				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}" required/>
				<div id="password-msg">
					<h3>Password must contain the following: </h3>
					<p id="lower" class="invalid">A lowercase letter</p>
					<p id="upper" class="invalid">A uppercase letter</p>
					<p id="number" class="invalid">A number</p>
					<p id="special" class="invalid">A special character</p>
					<p id="length" class="invalid">Minimum of 6 characters</p>
				</div>

				<label><b>Confirm Password</b></label>
				<input type="password" placeholder="Confirm Password" name="psw2" id="psw2" pattern="(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}"/>
				
				
                <input type="submit" ID="submitbtn" name="changePass" value="Change Password"/>
            </div>
        </form>
    </div>
		
    </body>
    
    <script>
        function openT(evt, tname) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tname).style.display = "block";
            evt.currentTarget.className += " active";
        }
        
        document.getElementById("defaultOpen").click();
    </script>
	
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
	
	
	

</html>
