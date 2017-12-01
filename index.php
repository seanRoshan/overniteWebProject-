 <?php include 'session.php';?>

<?php include 'dbconnect.php';?>
<?

$sql0 = "SELECT * FROM `LISTINGTABLE`";
$result = mysqli_query($con, $sql0);
$row = mysqli_fetch_array($result);

if ($row){

	// Retrive listing information
	$listingName = $row['listingTitle'];	


	$listingTitle = $row['listingTitle'];
	$description = $row['description2'];

	$price = $row['price'];

}
else {
	header("Location: index.php");
}
?> 

<script>
$(document).ready(function() {
    if (true) {
      $("#star1").css("color", "orange");
    }
    if (true) {
      $("#star2").css("color", "orange");
    }
    if (true) {
      $("#star3").css("color", "orange");
    }
    if (true) {
      $("#star4").css("color", "orange");
    }
    if (true) {
      $("#star5").css("color", "orange");
    }
    
});
</script>

<html>
	
<head>
		
    <link type="text/css" rel="stylesheet" href="css/homepage.css" />
    <link type="text/css" rel="stylesheet" href="css/navBar.css" />
	<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="js/liveSearch.js"></script>
	<script src="js/homepage.js"> </script>
	<script src="js/navBar.js"> </script>
	
    <title>Overnite</title>
	
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
	
  	<div style="padding-bottom:25px; position: relative ; margin-top: 1px;">
        <img src="img/homePageImage2.png" style="width:100%;height:91%;z-index:-1"></img>
        <a href="result.php?city=Los Angeles"><img src="img/points.png"  style="width:15px;height:15px;position:absolute; left:15.15%; top:50%;z-index:0" alt="Los Angeles"></img></a>
		<a href="result.php?city=New York"><img src="img/points.png"  style="width:15px;height:15px;position:absolute; left:28%; top:45.25%;z-index:0" alt="New York"></img></a>
		<a href="result.php?city=Japan"><img src="img/points.png"  style="width:15px;height:15px;position:absolute; left:76.5%; top:49.25%;z-index:0" alt="Japan"></img></a>
		<a href="result.php?city=Korea"><img src="img/points.png"  style="width:15px;height:15px;position:absolute; left:73.5%; top:49.25%;z-index:0" alt="Korea"></img></a>
		<a href="result.php?city=England"><img src="img/points.png"  style="width:15px;height:15px;position:absolute; left:43.25%; top:42%;z-index:0" alt="England"></img></a>
  
<!--        <span class="popuptext" id="myPopup2" style="z-index:9999;left:12.5%; top:45%;z-index:0">Los Angeles</span>
        <span class="popuptext" id="myPopup1" style="z-index:9999;left:25%; top:40.25%;z-index:0">New York</span>
        <span class="popuptext" id="myPopup3" style="z-index:9999;left:73.5%; top:44.25%;z-index:0">Japan</span>
        <span class="popuptext" id="myPopup4" style="z-index:9999;left:70.5%; top:44.25%;z-index:0">Korea</span>
        <span class="popuptext" id="myPopup5" style="z-index:9999;left:40.25%; top:37%;z-index:0">England</span>-->

    </div>
    
    <nav class="scrolltop">
       <br></br>
     <center><a id="scrolltop" style="margin-left:0px; margin-right: 0px; padding: 0px;">Explore the world one night at a time!</a></center> 
     <!-- <br></br>
     <div class="search-box" style="z-index:1;height:70px;width:70%;margin-left:200px;">
       				 	<input type="search" autocomplete="off" placeholder="Search..." style="z-index:1;font-size:7em;width:70%;">
						<div class="result" style="z-index:1"></div> -->
     </div>
    </nav>

    <!--<nav class="scrolltop">    
    </nav>-->
    
    <div class="whiteSpace">
    </div>

    
    <h3 style= "text-indent: 40px;font-family: 'Champagne', Times, serif;font-size:2em;">Explore:</h3>
    
        
    <div class="scrollmenu" style="margin-left:60px;margin-right:60px; padding:0px;">
        
        <div class="explore-Node" style="width:0px">
        </div>
        
        <?
		
		$sql0 = "SELECT * FROM LISTINGTABLE";
        $result = mysqli_query($con, $sql0);

		while($row = mysqli_fetch_array($result))
		{
			$uniquelistName = $row['uniqueListingname'];	

        	$listingTitle = $row['listingTitle'];
        	$description = $row['description'];
        
        	$price = $row['price'];
        	
        	$sql1 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistName'";
        	$result1 = mysqli_query($con, $sql1);
        	
        	$sqla = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$uniquelistName'";
        	
        	$resulta = mysqli_query($con, $sqla);
        		
            $row = mysqli_fetch_array($resulta);
            if ($row>0){
				$listImageURL = $row['url']; 
			}
			else {
				$listImageURL = "img/finalOverniteLogo_NEW2.png";
			}
			
			echo '<a href="individual_listing.php?listname='.$uniquelistName.'" style="color:inherit"><div class="explore-Node">';
            echo '<img src="'.$listImageURL.'" alt="Logo" style="width:100%;height:100%;">';
            echo '<div id="homepage-text-Title"><b>'.$listingTitle.'</b> <br /></div>';
            echo '<div id="homepage-text-Title" style="font-size:1em;padding-top:0px;"><b>$'.$price.' per night</b> </div>';
            echo '<div id="homepage-text-Desc" style="min-height:2.75em;max-height:2.75em">'.$description.'</div>';
            
            if($uniquelistName != "")
            {
                $sql2 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistName'";
		
        		$result1 = mysqli_query($con, $sql2);
                
        	    $sumStars = 0;
        	    $reviewCount = 0;
        	    $fullStar = 0;
        	    $reviewAvg = 0;
        	
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
			    
        		    echo '<div style="font-family:\'champagne\'" align="right"> Review: ';
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
            echo '</div></div></a>';
        }
		?>	
            
    </div>
</body>
<br></br>
<li class="bottomBar" style = "list-style-type:none; padding-top: 10px; padding-bottom: 5px; padding-left: 10px;"><bottom>Overnite &copy;</bottom></li>
</html>
