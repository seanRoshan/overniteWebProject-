<? include 'session.php';?>
<? include 'dbconnect.php';?>
<?

$debug = true;
$listingName = "" ;
$uniquelistname = "" ;

if ( isset($_GET['listname']) ){
	$uniquelistname = mydecodeURL($_GET['listname']);
	$_SESSION['listname'] = "listname=".$uniquelistname;
}
else {
	if ( (isset($_SESSION['listname'])) && (isset($_GET['loggedin'])) ){
		error_reporting(E_ALL);
		header("Location: individual_listing.php?".$_SESSION['listname']);
	}
	else{
		error_reporting(E_ALL);
		header("Location: index.php");
	}
}
?>

<?

$sql0 = "SELECT * FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$uniquelistname'";
$result = mysqli_query($con, $sql0);
$row = mysqli_fetch_array($result);

if ($row){

	// Retrive listing information
	$listingName = $row['listingTitle'];	


	$listingTitle = $row['listingTitle'];
	$description = $row['description'];
	$description2 = $row['description2'];
	$host = $row['username'];

	$gcount = $row['gcount'];
	$roomcount = $row['roomcount'];
	$bedcount = $row['bedcount'];
	$bathcount = $row['bathcount'];

	$property_type = $row['property_type'];
	$property_type2 = $row['property_type2'];

	$essentials = $row['essentials'];
	$wifi = $row['wifi'];
	$heat = $row['heat'];
	$aircon = $row['aircon'];
	$tv = $row['tv'];
	$food = $row['food'];
	$entrance = $row['entrance'];
	$living = $row['living'];
	$pool = $row['pool'];
	$washer = $row['washer'];
	$dryer = $row['dryer'];
	$kitchen = $row['kitchen'];
	$parking = $row['parking'];
	$gym = $row['gym'];
	$elevator = $row['elevator'];


	$suitable212 = $row['suitable212'];
	$suitableInfant = $row['suitableInfant'];
	$suitablePet = $row['suitablePet'];
	$smoking = $row['smoking'];
	$party = $row['party'];
	$rules = $row['rules'];
	
	$guestPrep = $row['guestPrep'];
	$checkIn = $row['checkIn'];
	$checkOut = $row['checkOut'];
	$minNight = $row['minNight'];
	$maxNight = $row['maxNight'];
	$price = $row['price'];
	$id = $row['ID'];

	// update dateArray and referenceDate on each load
	
	// $oldReferenceDate = $row['dateReference'];
	// $date_today = date("Y-m-d");
	
	// if ($oldReferenceDate){
	// 	$dataArray = $row['dateArray'];
	// 	if ($dataArray){
	// 		$dayCountsFromTodayReference = ( strtotime($date_today) - strtotime($oldReferenceDate) )/(60*60*24) ;
	// 		if ($dayCountsFromTodayReference>=0 && $dayCountsFromTodayReference<30){
	// 			$validDateArray="";
	// 			for ($i = $dayCountsFromTodayReference; $i < 30; $i++) {
	// 				$validDateArray = $validDateArray.$dataArray[$i];
	// 			}
	// 			for ($j = 0; $j<$dayCountsFromTodayReference; $j++){
	// 				$validDateArray = $validDateArray."1";
	// 			}
	// 			$dataArray = $validDateArray;
	// 			$referenceDate = $date_today;
				
	// 		}
	// 		else {
	// 			$dataArray = "111111111111111111111111111111";
	// 			$referenceDate = $date_today;
	// 		}
	// 	}
	// 	else{
	// 		$dataArray = "111111111111111111111111111111";
	// 		$referenceDate = $date_today;
	// 	}
	// }
	// else {
	// 	$dataArray = "111111111111111111111111111111";
	// 	$referenceDate = $date_today;
	// }

	// $sql_update = "UPDATE `LISTINGTABLE` SET `dateArray` = '$dataArray', `dateReference` = '$referenceDate' WHERE `LISTINGTABLE`.`ID` = '$id';";
	// mysqli_query($con, $sql_update);
	
	
		
		
		

}
else {
	header("Location: index.php");
}

if( isset( $_SESSION['uniqueUsername'] ) ) {
	
	   if ($_SERVER["REQUEST_METHOD"] == "POST") {

		   if ( isset($_POST['commentForm']) ) {
		   
		   		$comment = $stars = $avatar = $susername = "";

		   		if (!empty($_POST["revBox"])){
					$comment = test_input($_POST["revBox"]);
		   		}
			   
			    if (!empty($_POST["star"])){
					$stars = test_input($_POST["star"]);
		   		}
			   
			    $susername = $_SESSION['uniqueUsername'];
			    //$avatar = "img/howl_avatar.jpg";
		   
			    $avatar = $_SESSION['uniqueAvator'];
					
			   	$sql = "INSERT INTO comments (comment, stars, avatar, username, listingname )
				  		VALUES ('$comment', '$stars', '$avatar', '$susername', '$uniquelistname') ";
	
			    if ($debug){
					if ($con->query($sql) === TRUE) {
						#echo "New record created successfully";
					} 
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
				}
			    else {
					$con->query($sql);
				}

		   }
	  }
}

?>

<html>

<head>
	
	<link type="text/css" rel="stylesheet" href="css/list.css" />
    <link type="text/css" rel="stylesheet" href="css/navBar.css" />
	<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="js/liveSearch.js"></script>
	<script src="js/homepage.js"> </script>
	<script src="js/navBar.js"> </script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><? echo $listingName ?></title>
	

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
	
	<?
	

	
	
	$sql1 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistname'";
		
		$result = mysqli_query($con, $sql1);
        
	    $sumStars = 0;
	    $reviewCount = 0;
	
		while($row = mysqli_fetch_array($result)){
			   $sumStars = $sumStars + $row['stars'];
			   $reviewCount++;
		}
		
	    if($reviewCount > 0) { 
	    	$reviewAvg = $sumStars / $reviewCount;
	    } 
	    else { 
	    	$reviewAvg = 0;
	    } 
	
		if($reviewCount > 0) { 
			$fullStar = floor($sumStars / $reviewCount); 
		} 
		else { 
			$fullStar = 0; 
		} 
	
		$halfStar = false;
		if ($reviewAvg>$fullStar){
			$halfStar = true;
		}
	
		$emptyStar = 5 - ($fullStar + $halfStar);
	
	
	
	$sql3 = "SELECT * FROM `USERDATA` WHERE `uniqueUsername` LIKE '$host'";
	$result = mysqli_query($con, $sql3);
	
	$row = mysqli_fetch_array($result);
	
	$fname = $row['firstname'];
	$lname = $row['lastname'];
	$uavator = $row['avator'];
	
	
	$sql4 = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$uniquelistname'";
	
	$imgCount = 0;
	$result0 = mysqli_query($con, $sql4);
	$photoArray = array();
	
	
	while( ($row = mysqli_fetch_array($result0) ) ){
			$photoArray[$imgCount] = $row['url'];
			$imgCount++;
	}
	
	?>
	
	

<div class="img_modal" id="photos">
  <span class="closeG cursor" onclick="closePhotos()">&times;</span>
    <div class="modal-img-content">
		
		<?
			if ($imgCount>=8){
				for ($s = 0; $s < 8; $s++) {
						echo '<div class="slideGallery">';
						echo '<img src="'.$photoArray[$s].'" style="width:100%" height="70%"> ';
						echo '</div>';
				}
			}
			else {
				$emptySlots = 8 - $imgCount;
				for ($s = 0; $s < $imgCount; $s++) {
						echo '<div class="slideGallery">';
						echo '<img src="'.$photoArray[$s].'" style="width:100%" height="70%"> ';
						echo '</div>';
				}
				for ($s = 0; $s < $emptySlots; $s++) {
						echo '<div class="slideGallery">';
						echo '<img src="img/finalOverniteLogo_NEW2.png" style="width:100%" height="70%"> ';
						echo '</div>';
				}

			}
			
		?>

		
      <a class="prev" onclick="plusSlidesG(-1)">&#10094;</a>
      <a class="next" onclick="plusSlidesG(1)">&#10095;</a>

		<?
		
		$imgIndex = 0;
		if ($imgCount>=8){
				for ($s = 0; $s < 8; $s++) {
						$imgIndex++;
						echo '<div class="column">';
						echo '<img class="mini cursor" src="'.$photoArray[$s].'" style="width:100%" height="150px" onclick="currentSlideG('.$imgIndex.')">';
						echo '</div>';
				}
			}
			else {
				$emptySlots = 8 - $imgCount;
				for ($s = 0; $s < $imgCount; $s++) {
						$imgIndex++;
						echo '<div class="column">';
						echo '<img class="mini cursor" src="'.$photoArray[$s].'" style="width:100%" height="150px" onclick="currentSlideG('.$imgIndex.')">';
						echo '</div>';
				}
				for ($s = 0; $s < $emptySlots; $s++) {
						$imgIndex++;
						echo '<div class="column">';
						echo '<img class="mini cursor" src="img/finalOverniteLogo_NEW2.png" style="width:100%" height="150px" onclick="currentSlideG('.$imgIndex.')">';
						echo '</div>';
				}

			}
	

		?>
		
    </div>
</div>

<div class="slideshow-container">
	
	<?
	
	//echo "<br><br><br>ImageCount: ".$imgCount."<br><br><br>";
	
	
	if ($imgCount>=8){
			for ($s = 0; $s < 8; $s++) {
						echo '<div class="mySlides fade">';
					    echo '<img src="'.$photoArray[$s].'"width="100%" height="500px">';
						echo '<button type="button" onclick="openPhotos();" class="photobtn">View Photos</button></div>';
						echo '</div>';
				}
			}
			else {
				$emptySlots = 8 - $imgCount;
				for ($s = 0; $s < $imgCount; $s++) {
						echo '<div class="mySlides fade">';
						echo '<img src="'.$photoArray[$s].'" width="100%" height="500px">';
						echo '<button type="button" onclick="openPhotos();" class="photobtn">View Photos</button></div>';
						echo '</div>';
				}
			}
	?>

<a class="prev1" onclick="plusSlides(-1)" style="margin-top:-100px;">&#10094;</a>
<a class="next1" onclick="plusSlides(1)" style="margin-top:-100px;">&#10095;</a>

</div>
	
<br>
		
<div style="text-align:center">
	
	<?
	
	if ($imgCount>=8){
			for ($s = 0; $s < 8; $s++) {
						echo '<span class="dot" onclick="currentSlide('.($s+1).')"></span>';
				}
			}
			else {
				for ($s = 0; $s < $imgCount; $s++) {
						echo '<span class="dot" onclick="currentSlide('.($s+1).')"></span>';
				}
			}
	
	
	
	
	
	?>
</div>

<br />

<div class="description">
	
	<? 
	
		if (isset($_SESSION['ERROR_MESSAGE']) && (!isset($_SESSION['bookstatus']) ) ){
			echo '<center><label class="error">'.$_SESSION['ERROR_MESSAGE'].'</label></center><br>';
			unset($_SESSION['ERROR_MESSAGE']);
		}
	
		if ( (isset($_SESSION['bookstatus']) ) && $_SESSION['bookstatus'] == 'success' ) {
			echo '<center><label class="success">Your booking has been successful!</label></center><br>';
			unset($_SESSION['bookstatus']);
		}
		if ( (isset($_SESSION['bookstatus']) ) && $_SESSION['bookstatus'] == 'invalidCreditCard' ) {
			echo '<center><label class="error">Your booking was not successful! CreditCard Declined!</label></center><br>';
			unset($_SESSION['bookstatus']);
		}
	
		
	
	?>
	
    <h1><?echo $listingTitle; ?></h1>
    <p>
	<?
	echo $description ;
	?>
	</p>
    <hr>
    
    <div class="host_info">
      <br>
      <div>
            <i class="fa fa-users bigger" aria-hidden="true"></i> <p style="display:inline"><? if($gcount == 1) { echo $gcount." guest"; } else { echo $gcount." guests"; } ?>&nbsp;&nbsp;&nbsp;</p>  
            <i class="fa fa-cube bigger" aria-hidden="true"></i> <p style="display:inline"><? if($roomcount == 1) { echo $roomcount." room"; } else { echo $roomcount." rooms"; } ?>&nbsp;&nbsp;&nbsp;</p> 
            <i class="fa fa-bed bigger" aria-hidden="true"></i> <p style="display:inline"><? if($bedcount == 1) { echo $bedcount." bed"; } else { echo $bedcount." beds"; } ?>&nbsp;&nbsp;&nbsp;</p>
            <i class="fa fa-bath bigger" aria-hidden="true"></i> <p style="display:inline"><? if($bathcount == 1) { echo $bathcount." bath"; } else { echo $bathcount." baths"; } ?>&nbsp;&nbsp;&nbsp;</p>
      </div>
      <br>
      <div class="host">
		  <?
		  if ($uavator){
			  echo '<a href="profile.php?username='.$host.'"><img src="'.$uavator.'" alt="Avatar" class="avatar_listing"></a>';
		  }
		  else {
			  echo '<a href="profile.php?username='.$host.'"><img src='.'"img/avator.png"'.' alt="Avatar" class="avatar_listing"></a>';
		  }
		  ?>
          
          <p style="clear: both;">Hosted by: <? echo $fname." ".$lname?></p>
		  
		  <? echo '<button type="button" onclick="location.href='."'profile.php?username=".$host."' ".'"class="hostbtn">Check out the host</button>'?>
          
      </div>
      
      <div class="rating">
          <p><? echo $property_type ?> &middot; <? echo $property_type2 ?></p>
          <p><? echo $listingName ?></p>
		  
          <div>
			  
			  <?
			  		for ($s = 0; $s < $fullStar; $s++) {
						echo '<span id="star5" class="fa fa-star bigger" style="color:ORANGE" ></span>';
					}
			  
			  		for ($s = 0; $s < $halfStar; $s++) {
						echo '<span id="star1" class="fa fa-star-half-full bigger" style="color:ORANGE" ></span>';
					} 
			  
					for ($s = 0; $s < $emptyStar; $s++) {
						echo '<span id="star1" class="fa fa-star-o bigger"></span>';
					}
			  
			  ?>
			  
          </div>
          <br> 
		  <? echo '<button type="button" onclick="location.href='."'individual_listing.php?listname=".$uniquelistname."#rev'".'"class="hostbtn">Check out the reviews </button>';?>
		  
          <br>
      </div>
    </div>
    
    <hr>
    
    <div class="list_desc">
	<? if ($description2) {
			echo '<br><p>'.$description2.'</p><br><hr>';
        }
	  ?>
      <!--<br>-->
      <!--<p></p>-->
      <!--<br>-->
      <!--<hr>-->
      <!--Want to strikethrough ones not checked in listing form-->
      <h2>Amenities and Spaces</h2>
      <div class="amenities_col1">
		  <?
		  if ($essentials){
			  echo '&nbsp;<i class="fa fa-thumb-tack" aria-hidden="true"></i> <p style="display:inline">&nbsp;&nbsp;Essentials</p><br><br>';
		  }
		  if ($wifi){
			  echo '<i class="fa fa-wifi" aria-hidden="true"></i> <p style="display:inline">&nbsp;Wifi</p><br><br>';
		  }
		  if ($heat){
			  echo '&nbsp;<i class="fa fa-thermometer-full" aria-hidden="true"></i> <p style="display:inline">&nbsp;&nbsp;Heat</p><br><br>';
		  }
		  if ($aircon){
			  echo '<i class="fa fa-snowflake-o" aria-hidden="true"></i> <p style="display:inline">&nbsp;Air conditioning</p><br><br>';
		  }
		  if ($tv){
			  echo '<i class="fa fa-television" aria-hidden="true"></i> <p style="display:inline">&nbsp;TV</p><br><br>';
		  }
		  if ($food){
			  echo '<i class="fa fa-coffee" aria-hidden="true"></i> <p style="display:inline">&nbsp;Breakfast, tea, coffee</p><br><br>';
		  }
		  if ($entrance){
			  echo '<i class="fa fa-key" aria-hidden="true"></i> <p style="display:inline">&nbsp;Private entrance</p><br><br>';
		  }
		  if ($living){
			  echo '&nbsp;<i class="fa fa-lock" aria-hidden="true"></i> <p style="display:inline">&nbsp;&nbsp;Private living room</p><br><br>';
		  }
		  if ($elevator){
			  echo '<i class="fa fa-caret-square-o-up" aria-hidden="true"></i> <p style="display:inline">&nbsp;Elevator</p><br><br>';
		  }
		  if ($parking){
			  echo '<i class="fa fa-car" aria-hidden="true"></i> <p style="display:inline">&nbsp;Parking</p><br><br>';
		  }
		  if ($kitchen){
			  echo '&nbsp;<i class="fa fa-spoon" aria-hidden="true"></i> <p style="display:inline">&nbsp;&nbsp;Kitchen</p><br><br>';
		  }
		  if ($washer){
			  echo '<i class="fa fa-square" aria-hidden="true"></i> <p style="display:inline">&nbsp;Washer</p><br><br>';
		  }
		  if ($dryer){
			  echo '<i class="fa fa-square-o" aria-hidden="true"></i> <p style="display:inline">&nbsp;Dryer</p><br><br>';
		  }
		  if ($gym){
			  echo '<i class="fa fa-universal-access" aria-hidden="true"></i> <p style="display:inline">&nbsp;Gym</p><br><br>';
		  }
		  if ($pool){
			  echo '&nbsp;<i class="fa fa-tint" aria-hidden="true"></i> <p style="display:inline">&nbsp;Pool</p><br><br>';
		  }
		  
		  ?>

      </div>
        
    </div>
    
    <hr>
    
    <div class="rules">
      <!--Want to display only ones that are marked yes in listing form-->
        <h2>House Rules</h2>
		
        <? 
        	if($suitable212 === "yes") { 
            	    echo '<img src="https://png.icons8.com/children/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Suitable for children 2 - 12</p><br><br>';
        	} 
        	else { 
        	    echo '<img src="https://png.icons8.com/keep-away-from-children/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Not suitable for children 2 - 12</p><br><br>';    
        	} 
        	if($suitableInfant === "yes") { 
        	    echo '<img src="https://png.icons8.com/babys-room/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Suitable for infants</p><br><br>';
        	} 
        	else { 
        	    echo '<img src="https://png.icons8.com/keep-away-from-children/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Not suitable for infants</p><br><br>';
        	} 
            if($smoking === "yes") {
                echo '<img src="https://png.icons8.com/smoking/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Smoking is allowed</p><br><br>'; } 
            else { 
                echo '<img src="https://png.icons8.com/no-smoking/win8/35/000000" style="width:18px"><p style="display:inline">&nbsp;No smoking</p><br><br>';
            } 
            if($suitablePet === "yes") { 
                echo '<img src="https://png.icons8.com/chicken/win8/18/666666" style="width:18px"><p style="display:inline">&nbsp;Suitable for pets</p><br><br>'; } 
            else { 
                echo '<img src="https://png.icons8.com/no-animals/win8/17/000000" style="width:18px"><p style="display:inline">&nbsp;Not suitable for pets</p><br><br>';
            } 
            if($party === "yes") { 
                echo '<img src="https://png.icons8.com/wine-glass/win8/18/666666"><p style="display:inline">&nbsp;Parties or events allowed</p><br><br>';
            } 
            else { 
                echo '<img src="https://png.icons8.com/no-alcohol/win8/18/000000"><p style="display:inline">&nbsp;No parties or events</p><br><br>';
            }
        ?>
        
        
    </div>
    
    <hr>
    
    <div class="options">
        <h2>Stay Information</h2>
        <div class="hrs">
        	<i class="fa fa-calendar-minus-o" aria-hidden="true"></i> <p style="display: inline">Minimum stay: <? if($minNight == 1) { echo $minNight." day"; } else { echo $minNight." days"; } ?></p>
        	<br><br>
       		<i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <p style="display: inline">Maximum stay: <? if($maxNight == 1) { echo $maxNight." day"; } else { echo $maxNight." days"; } ?></p>
            <p style="clear:both"></p>
            <? if($checkIn == "Flexible") { 
                echo '<i class="fa fa-calendar-check-o" aria-hidden="true"></i><p style="display:inline">&nbsp;&nbsp;Check in time is flexible</p><br><br>';
            } 
            else { 
                echo '<i class="fa fa-calendar-check-o" aria-hidden="true"></i><p style="display:inline">&nbsp;Check in is anytime after '.$checkIn.'</p><br><br>';
            }
            if($checkOut == "Flexible") {
                echo '<i class="fa fa-calendar-times-o" aria-hidden="true"></i><p style="display:inline">&nbsp;Check out time is flexible</p><br><br>';
            }
            else { 
                echo '<i class="fa fa-calendar-times-o" aria-hidden="true"></i><p style="display:inline">&nbsp;Check out by '.$checkOut.'</p><br><br>';
            } ?>
        </div>
    </div>
    
    <hr>
    
    <?
	if( isset( $_SESSION['uniqueUsername'] ) ) {
		echo '<input type="submit" id="writeRev" name"writeRev" style="float:right; margin-top:15px;" value="Already stayed here? Write a review!">';
	}
	?>
	
	
	<script>
	    $(document).ready(function(){
	        tempList2 = document.getElementsByClassName("indv_rev");
	        if(tempList2.length <= 3) {
	            $("#showmore2").hide();
	        }
	    });  
	</script>
	
	<script>
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
	
	<h2>Reviews</h2>
    <div class="revForm" id="revForm">
    <form id="commentForm" name="commentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?listname='.$uniquelistname;?>" method="post">
        <textarea id="revBox" name="revBox" rows="8" columns="50" maxlength="840" style="padding:8px;" placeholder="Write your review here and remember to select a star rating below..." required></textarea>
      
      <p style="clear:both"></p>
      
      <div class="stars">
          <input class="star star-5" id="star-5" type="radio" value="5" name="star" required/>
          <label class="star star-5" for="star-5"></label>
          <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
          <label class="star star-4" for="star-4"></label>
          <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
          <label class="star star-3" for="star-3"></label>
          <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
          <label class="star star-2" for="star-2"></label>
          <input class="star star-1" id="star-1" type="radio" value="1" name="star"/>
          <label class="star star-1" for="star-1"></label>
      </div>
		  <input type="Submit" value="Submit" name="commentForm" id="revbtn" style="float:left">
	 </form>
		
		
		
    </div>
      <p style="clear:both"></p>
      <hr>
    <div class="reviews" id="rev">

		<?
		
		// Retrive Comments 
		
		$sql1 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistname'";
		
		$result = mysqli_query($con, $sql1);

        if($result === false)
        {
        }
        else
        {
        	while($row = mysqli_fetch_array($result)){
			
			echo '<div class="indv_rev">';
			
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
			echo '<p style="text-align: left">'.$row['comment'];
			echo '</p></div>';
			
			}
        }
		
		?>		
    </div>
    <input type="button" value="Show More" id="showmore2" class="showmoreBtn2" style="background-color: #61E1B6;color: white;font-weight:bold;border: none;cursor: pointer;font-family: 'Champagne', Times, serif;">
	
</div>

<br />

<div class="booktab">
    <h2 style="display:inline"><? echo "$".$price ?></h2><p style="display:inline">&nbsp;per night</p>
    <hr>
    <br>
    <form <? echo "action=booking.php?listname=".fixURL($uniquelistname) ?> method="post">
        <div class="checking">
            <div class="checkin">
                <label for="checkin">Check-in</label>
                <input id="checkin" name="checkin" style="border:1px solid darkgrey; width: 100%" required>
            </div>
        
            <div class="checkout">
                <label for="checkout">Check-out</label>
                <input id="checkout" name="checkout" style="border:1px solid darkgrey; width: 100%" required>

            </div>
        </div>
        <div id="num_Guests" class="num_Guests">
            <div class="gtext" style="font-size:18px; color:#282828;margin-top:6px;"><p>How many guests?</p></div>
            <p></p>
        	<?php
        
	            echo '<select class="guestcount" name="guestcount" style="width:100px;margin-top:5px;">';
	            echo '<option value="1">1 guest</option>';
	            for($s = 2; $s <= $gcount; $s++) { 
	                echo "<option value=\"$s\">$s guests</option>";
	            }
	            echo '</select>';
        	?>
        </div>
		<? 
			echo '<input id="submitbtn" name="bookRequest" type="submit" value="Request to Book"/>';
		?>

    </form>
    <hr>
    <? 
    	if($guestPrep === "Same day") { 
    		echo '<p style="font-size:18px; color: #282828">You are allowed to book this stay on the same day.</p>';
    	} 
    	else { 
    		echo '<p style="font-size:18px; color:#282828">You are required to book this stay at least '.$guestPrep.' in advance.</p>';
    	}
    ?>
</div>

	 <? $sql_dates = "SELECT * FROM BOOKINGTABLE WHERE `listname` LIKE '$uniquelistname'"; 
	$begin_array = array(); 
	$end_array = array(); 
	
	$result_date = mysqli_query($con, $sql_dates); 
	while($row_dates = mysqli_fetch_array($result_date)) { 
		$begin_array[] = $row_dates['startData']; 
		$end_array[] = $row_dates['endData']; 
		// echo "<br><br><br><br>";
		// echo $row_dates['startData']; 
		// echo $row_dates['endData']; echo "<br>";
	} 
	
	echo "<script>"; 
	echo 'var begin_dates = '.json_encode($begin_array).';'; 
	echo 'var end_dates = '.json_encode($end_array).';'; 
	echo "var dateRange = new Array();"; 
	echo "for(var i = 0; i < begin_dates.length; i++) {";
		echo "for(var d = new Date(begin_dates[i]); d <= new Date(end_dates[i]); d.setDate(d.getDate() + 1)) {";
			echo "dateRange.push($.datepicker.formatDate('mm/dd/yy', d));"; 
		echo "}"; 
	echo"}";
	
	// echo "for(var j = 0; j < dateRange.length; j++) {"; 
	// echo "console.log(dateRange[j]);";
	// echo "}";
	
	echo "$('#checkin').datepicker({";
	if($guestPrep == "One day") { echo 'defaultDate: "+1d",'; }
	else if($guestPrep == "Three days") { echo 'defaultDate: "+3d",'; } 
	else if($guestPrep == "Seven days") { echo 'defaultDate: "+1w",'; } 
	echo "minDate: new Date(),"; 
	echo "beforeShowDay: function (date) {";
	echo "var string = jQuery.datepicker.formatDate('mm/dd/yy', date);"; 
	echo "return [dateRange.indexOf(string) == -1 ]";
	echo "}";
	echo "});";
	
	if($guestPrep == "One day") { $defaultCheckout = $minNight + 1; }
	else if($guestPrep == "Three days") { $defaultCheckout = $minNight + 3; } 
	else if($guestPrep == "Seven days") { $defaultCheckout = $minNight + 7; }
	else { $defaultCheckout = $minNight; } 
	
	echo "$('#checkout').datepicker({";
	echo 'defaultDate: "+'.$defaultCheckout.'d",';  
	echo "minDate: new Date(),"; 
	echo "beforeShowDay: function (date) {";
	echo "var string = jQuery.datepicker.formatDate('mm/dd/yy', date);"; 
	echo "return [dateRange.indexOf(string) == -1 ]";
	echo "}";
	echo "});";
	echo "</script>"; 

?>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

<script>
/*global jQuery*/
(function($) {
    var scroll = $('.booktab'),
        Y = scroll.offset().top;

    $(window).on('scroll', function(event) {
        var scrollTop = $(window).scrollTop() + 70;

        scroll.stop(false, false).animate({
            top: scrollTop < Y
                    ? 0 : scrollTop - Y + 15
        }, 0); 
    });
})(jQuery);
</script>

<script>
function openPhotos() {
  document.getElementById('photos').style.display = "block";
}

function closePhotos() {
  document.getElementById('photos').style.display = "none";
}

var slideIndexG = 1;
showSlidesG(slideIndexG);

function plusSlidesG(n) {
  showSlidesG(slideIndexG += n);
}

function currentSlideG(n) {
  showSlidesG(slideIndexG = n);
}

function showSlidesG(n) {
  var i;
  var slides = document.getElementsByClassName("slideGallery");
  var dots = document.getElementsByClassName("mini");
  if (n > slides.length) {slideIndexG = 1}
  if (n < 1) {slideIndexG = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndexG-1].style.display = "block";
  dots[slideIndexG-1].className += " active";
}
</script>

<script>
$(document).ready(function() {
    
// $(document).ready(function() { 
	var disabledDates = [
		'2017-11-27', 
		'2017-11-30'
	];
	
	// $('#checkIn').css('clip', 'auto'); 
// }); 
	
    
});
</script>

<!--Show/Hide the review writing box-->
<script>
      $('#writeRev').click(function() {
         $('#revForm').toggle();
      });
    </script>

</body>

</html>

<?
	mysqli_close($con);  
?>