<?
session_start();

$debug = true;
$debug_echo = false;

if ($_GET['logout']=='1') {
	unset($_SESSION['uniqueUsername']);
	header( "refresh:1;url=index.php" );
} 

if( !isset( $_SESSION['uniqueUsername'] ) ) {
	   header("Location: index.php");
}


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = str_replace("'","''",$data);
	return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	// Create connection	
	$con = mysqli_connect($servername, $username, $password, $dbname);

	if ($con == false){
		//echo "<br> Connection to Database was not successfull<br>";
	}
	else {
		//echo "MySQL Connected successfully!<br>";
	}
	
	
	$uniqueUsername = $_SESSION['uniqueUsername'];
	
	
	// STEP 1
	
	$property_type = $property_type2 = $guestOnly = "";
	
	if (!empty($_POST["property_type"])){
		$property_type = test_input($_POST["property_type"]);	
	}
	
	if (!empty($_POST["property_type2"])){
		$property_type2 = test_input($_POST["property_type2"]);	
	}
	
	if (!empty($_POST["guestOnly"])){
		$guestOnly = test_input($_POST["guestOnly"]);	
	}
	
	if ($debug_echo){
		//echo "property_type:>".$property_type."<br>";
	   // echo "property_type2:>".$property_type2."<br>";
	   // echo "guestOnly:>".$guestOnly."<br>";
	}
	
	// STEP 2

	$gcount = $roomcount = $bedcount = "";
	
	if (!empty($_POST["gcount"])){
		$gcount = test_input($_POST["gcount"]);	
	}
	
	if (!empty($_POST["roomcount"])){
		$roomcount = test_input($_POST["roomcount"]);	
	}
	
	if (!empty($_POST["bedcount"])){
		$bedcount = test_input($_POST["bedcount"]);	
	}
	
	//echo "gcount:>".$gcount."<br>";
	//echo "roomcount:>".$roomcount."<br>";
	//echo "bedcount:>".$bedcount."<br>";
	
	// STEP 3

	$bathcount = $private_bath = "";
	
	if (!empty($_POST["bathcount"])){
		$bathcount = test_input($_POST["bathcount"]);	
	}
	
	if (!empty($_POST["private_bath"])){
		$private_bath= test_input($_POST["private_bath"]);	
	}
	
	//echo "bathcount:>".$bathcount."<br>";
	//echo "private_bath:>".$private_bath."<br>";
	
	
	// STEP 4

	$country = $streetAddress = $streetAddress2 = $city = $state = $zipcode = "";
	
	if (!empty($_POST["country"])){
		$country = test_input($_POST["country"]);	
	}
	
	if (!empty($_POST["streetAddress"])){
		$streetAddress= test_input($_POST["streetAddress"]);	
	}
	
	if (!empty($_POST["streetAddress2"])){
		$streetAddress2= test_input($_POST["streetAddress2"]);	
	}
	
	if (!empty($_POST["city"])){
		$city= test_input($_POST["city"]);	
	}
	
	if (!empty($_POST["state"])){
		$state= test_input($_POST["state"]);	
	}
	
	if (!empty($_POST["zipcode"])){
		$zipcode= test_input($_POST["zipcode"]);	
	}
	
	//echo "country:>".$country."<br>";
	//echo "streetAddress:>".$streetAddress."<br>";
	//echo "streetAddress2:>".$streetAddress2."<br>";
	//echo "city:>".$city."<br>";
	//echo "state:>".$state."<br>";
	//echo "zipcode:>".$zipcode."<br>";
	
	
	
	// STEP 5
	
	$essentials = $wifi = $heat = $aircon = $tv = $food = $entrance = "";
	
	if (!empty($_POST["essentials"])){
		$essentials = test_input($_POST["essentials"]);	
	}
	
	
	if (!empty($_POST["wifi"])){
		$wifi = test_input($_POST["wifi"]);	
	}
	
	
	if (!empty($_POST["heat"])){
		$heat = test_input($_POST["heat"]);	
	}
	
	
	if (!empty($_POST["aircon"])){
		$aircon = test_input($_POST["aircon"]);	
	}
	

	if (!empty($_POST["tv"])){
		$tv = test_input($_POST["tv"]);	
	}
	
	
	if (!empty($_POST["food"])){
		$food = test_input($_POST["food"]);	
	}
	
	
	if (!empty($_POST["entrance"])){
		$entrance = test_input($_POST["entrance"]);	
	}
	
	
	//echo "essentials:>".$essentials."<br>";
	//echo "wifi:>".$wifi."<br>";
	//echo "heat:>".$heat."<br>";
	//echo "aircon:>".$aircon."<br>";
	//echo "tv:>".$tv."<br>";
	//echo "food:>".$food."<br>";
	//echo "entrance:>".$entrance."<br>";
	
	
	// STEP 6
	
	$living = $pool = $washer = $dryer = $kitchen = $parking = $gym = $elevator ="";
	
	if (!empty($_POST["living"])){
		$living = test_input($_POST["living"]);	
	}
	
	
	if (!empty($_POST["pool"])){
		$pool = test_input($_POST["pool"]);	
	}
	
	
	if (!empty($_POST["washer"])){
		$washer = test_input($_POST["washer"]);	
	}
	
	
	if (!empty($_POST["dryer"])){
		$dryer = test_input($_POST["dryer"]);	
	}
	
	
	if (!empty($_POST["kitchen"])){
		$kitchen = test_input($_POST["kitchen"]);	
	}
	
	
	if (!empty($_POST["parking"])){
		$parking = test_input($_POST["parking"]);	
	}
	
	
	if (!empty($_POST["gym"])){
		$gym = test_input($_POST["gym"]);	
	}
	
	
	if (!empty($_POST["elevator"])){
		$elevator = test_input($_POST["elevator"]);	
	}
	
	
	//echo "living:>".$living."<br>";
	//echo "pool:>".$pool."<br>";
	//echo "washer:>".$washer."<br>";
	//echo "dryer:>".$dryer."<br>";
	//echo "kitchen:>".$kitchen."<br>";
	//echo "parking:>".$parking."<br>";
	//echo "gym:>".$gym."<br>";
	//echo "elevator:>".$elevator."<br>";	
		
		
	
	// STEP 8

	$desc = $desc2 = "";
	
	if (!empty($_POST["desc"])){
		$desc = test_input($_POST["desc"]);	
	}
	
	if (!empty($_POST["desc2"])){
		$desc2= test_input($_POST["desc2"]);	
	}
	
	
	if ($debug_echo){
		//echo "desc:>".$desc."<br>";
	    //echo "desc2:>".$desc2."<br>";
	}
	
	
	
	// STEP 9

	$listingTitle = "";
	
	if (!empty($_POST["listingTitle"])){
		$listingTitle = test_input($_POST["listingTitle"]);	
		$uniqueListingTitle = $_SERVER['REQUEST_TIME']. "_" .$listingTitle;
	}
		
	//echo "listingTitle:>".$listingTitle."<br>";

		

	// STEP 10

	$suitable212 = $suitableInfant = $suitablePet = $smoking = $party = $rules = "";
	
	if (!empty($_POST["suitable212"])){
		$suitable212 = test_input($_POST["suitable212"]);	
	}
		
	//echo "suitable212:>".$suitable212."<br>";

	
	if (!empty($_POST["suitableInfant"])){
		$suitableInfant = test_input($_POST["suitableInfant"]);	
	}
		
	//echo "suitableInfant:>".$suitableInfant."<br>";
	
	
	if (!empty($_POST["suitablePet"])){
		$suitablePet = test_input($_POST["suitablePet"]);	
	}
	
	//echo "suitablePet:>".$suitablePet."<br>";
		
	
	
	if (!empty($_POST["smoking"])){
		$smoking = test_input($_POST["smoking"]);	
	}
	
	//echo "smoking:>".$smoking."<br>";
	
	
	if (!empty($_POST["party"])){
		$party = test_input($_POST["party"]);	
	}
	
	//echo "party:>".$party."<br>";
	
	
	
	if (!empty($_POST["rules"])){
		$rules = test_input($_POST["rules"]);	
	}
	
	
	if ($debug_echo){
		//echo "rules:>".$rules."<br>";
	}
	
	
	// STEP 11
	
	$guestPrep = $checkIn = $checkOut = "";
	
	if (!empty($_POST["guestPrep"])){
		$guestPrep = test_input($_POST["guestPrep"]);	
	}
		
	//echo "guestPrep:>".$guestPrep."<br>";
	
	if (!empty($_POST["checkIn"])){
		$checkIn = test_input($_POST["checkIn"]);	
	}
		
	//echo "checkIn:>".$checkIn."<br>";
	
	if (!empty($_POST["checkOut"])){
		$checkOut = test_input($_POST["checkOut"]);	
	}
	
	//echo "checkOut:>".$checkOut."<br>";
	
	
	// STEP 12
	
	$minNight = $maxNight = "";
	
	if (!empty($_POST["minNight"])){
		$minNight = test_input($_POST["minNight"]);	
	}
		
	//echo "minNight:>".$minNight."<br>";
	
	if (!empty($_POST["maxNight"])){
		$maxNight = test_input($_POST["maxNight"]);	
	}
		
	//echo "maxNight:>".$maxNight."<br>";
	
	
	// STEP 13
	
	$price = "";
	
	if (!empty($_POST["price"])){
		$price = test_input($_POST["price"]);	
	}
		
	//echo "price:>". $price ."<br>";
	
	
	
	$target_dir = "images/";
	$imageIndex = 0;
	
	//echo "count:>".count($_FILES['filesToUpload']['tmp_name'])."<br>";
	
	if(count($_FILES['filesToUpload']['tmp_name'])) {
		
	foreach ($_FILES['filesToUpload']['tmp_name'] as $file) {

		$name = $_FILES['filesToUpload']['name'][$imageIndex];
		$size = $_FILES['filesToUpload']['size'][$imageIndex];
		$type = $_FILES['filesToUpload']['type'][$imageIndex];
		$target_file = $target_dir . $_SERVER['REQUEST_TIME'] ."_" . basename($name);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$uploadOk = 1;
		$check = getimagesize($file);
		
			
		//echo $name."<br>";
		//echo $target_file."<br>";
		
		
		$width = $check[0];
		$height = $check[1];
		
		
		//echo "width: ".$width."<br>";
		//echo "height: ".$height."<br>";
		//echo "size: ".$size."<br>";
		//echo "type: ".$type."<br>";
		//echo "imageFileType: ".$imageFileType."<br>";
		
		
		
		
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . "."."<br>";
			$uploadOk = 1;
		} else {
			//echo "File is not an image.";
			$uploadOk = 0;
		}
		
		
		
		
		// Check if file already exists and rename if necessary
	if (file_exists($target_file)) {
		$renameIndex = 1;
		
		while (file_exists($target_file ."(".$renameIndex.")")){
			$renameIndex++;
		}
		
		$target_file = $target_file ."(".$renameIndex.")";
	}
		
	// Check file size is less than 10MB
	if ($size > 10000000) {
		//echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
		
			
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	   && $imageFileType != "gif" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
	}
		
		
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($file, $target_file)) {
			//echo "The file ". basename($name). " has been uploaded.";
			$active_username = $_SESSION['uniqueUsername'];
			$sql = "INSERT INTO USERPHOTOS (username, url, listingname)
				VALUES ('$active_username', '$target_file', '$uniqueListingTitle')";
			$con->query($sql);	
		}
		else {
			//echo "Sorry, there was an error uploading your file.";
		}
	}
	
	$imageIndex++;
		
	}
}

	
	$active_username = $_SESSION['uniqueUsername'];
	
	
	$sql1 = "INSERT INTO LISTINGTABLE (
	username, property_type, property_type2, 
	guestOnly, gcount, roomcount, bedcount, 
	bathcount, private_bath,
	country, streetAddress, streetAddress2, city, state, zipcode,
	essentials, wifi, heat, aircon, tv, food, entrance,
	living, pool, washer, dryer, kitchen, parking, gym, elevator,
	description, description2,
	listingTitle,
	suitable212, suitableInfant, suitablePet, smoking, party, rules,
	guestPrep, checkIn, checkOut,
	minNight , maxNight, 
	price,
	uniqueListingname
	)
				VALUES ('$active_username', '$property_type' , '$property_type2', 
				'$guestOnly', '$gcount', '$roomcount', '$bedcount', 
				'$bathcount', '$private_bath',
				'$country', '$streetAddress', '$streetAddress2', '$city','$state', '$zipcode',
				'$essentials', '$wifi', '$heat', '$aircon','$tv', '$food', '$entrance',
				'$living', '$pool', '$washer', '$dryer','$kitchen', '$parking', '$gym', '$elevator',
				'$desc', '$desc2',
				'$listingTitle',
				'$suitable212', '$suitableInfant', '$suitablePet', '$smoking', '$party', '$rules',
				'$guestPrep', '$checkIn', '$checkOut',
				'$minNight', '$maxNight',
				'$price' ,
				'$uniqueListingTitle'
				)";

	if ($debug){
		if ($con->query($sql1) === TRUE) {
			header("Location: individual_listing.php?listname=".$uniqueListingTitle);
			echo "New record created successfully";
		} 
		else {
			echo "Error: " . $sql1 . "<br>" . $con->error;
		}
	}
	
	
	mysqli_close($con);  
	
	//echo "End of file!";

	//header( "refresh:1;url=index.php" );
	
}

?>


<html lang="en">
	
    <head>
        
<!--        <link type="text/css" rel="stylesheet" href="css/listingForm.css" />
        <link type="text/css" rel="stylesheet" href="css/switchfield.css" />
		<link type="text/css" rel="stylesheet" href="css/navBar2.css" />
		<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/navBar.js"> </script>
		<script src="js/liveSearch.js"></script>
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
		
		<link type="text/css" rel="stylesheet" href="css/listingForm.css" />
		<link type="text/css" rel="stylesheet" href="css/switchfield.css" />
        <link type="text/css" rel="stylesheet" href="css/navBar.css" />
		<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="js/navBar.js"> </script>
		<script src="js/liveSearch.js"></script>
		<script src="js/listing.js" type="text/javascript"></script>
		

        <title>Become a Host</title>
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
		
    <form id="bookingmsform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <!--Step 1: place type-->
        <div class="fstab">
            <div id="tabBody">
                    <h2 class="fs-title">What kind of place are you listing?</h2>
                    <h3 class="fs-question">What type of property is this?</h3>
                    <select class="fs-dropbox" name="property_type">
                        <option value="Apartment">Apartment</option>
                        <option value="Condo">Condominium</option>
                        <option value="House">House</option>
                        <option value="In-Law">In-law</option>
                        <option value="Guest Suite">Guest Suite</option>
                        <option value="Townhouse">Townhouse</option>
                        <option value="Vacation Home">Vacation home</option>
                        <option value="Cabin">Cabin</option>
                        <option value="Dorm">Dorm</option>
                        <option value="Dungeon">Dungeon</option>
                    </select>
                    <h3 class="fs-question">What will the guests have?</h3>
                    <select class="fs-dropbox" name="property_type2">
                        <option value="Entire place">Entire place</option>
                        <option value="Private room">Private room</option>
                        <option value="Shared room">Shared room</option>
                    </select>
                    <h3 class="fs-question">Is this set up as a dedicated space for guests?</h3>
                    <div class="control-group">
                            <label class="control control--radio">Yes, it's primarily set up for guests
                            <input type="radio" id="r_left" name="guestOnly" value="yes"/>
                            <div class="control__indicator"></div>
                            </label>
                            <label class="control control--radio">No, I keep my personal belongings here
                            <input type="radio" id="r_right" name="guestOnly" value="no"/>
                            <div class="control__indicator"></div>
                            </label>
                    </div>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 2: Bedrooms-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">How many guests can your place accomodate?</h2>
                <label for="gcount" class="fs-question">Guests
                <input type="number" value="1" min="1" id="gcount" name="gcount" class="count" />
                </label>
                 
                <label for="roomcount" class="fs-question">How many bedrooms can guests use?
                <input type="number" value="1" min="1" id="roomcount" name="roomcount"  class="count" />
                </label>
    
                
                <label for="bedcount" class="fs-question">How many beds can guests use?
                    <input type="number" value="1" min="1" id="bedcount" name="bedcount" class="count" />
                </label>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 3: Bathrooms-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">How many bathrooms?</h2>
                <label for="bathcount" class="fs-question">Bathrooms
                <input type="number" value="1" min="1" id="bathcount" name="bathcount" class="count" />
                </label>
                <h3 class="fs-question">Is the bathroom private?</h3>
                <div class="control-group">
                        <label class="control control--radio">Yes
                        <input type="radio" id="b_left" name="private_bath" value="yes"/>
                        <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio">No
                        <input type="radio" id="b_right" name="private_bath" value="no"/>
                        <div class="control__indicator"></div>
                        </label>
                </div>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 4: Location-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">Where's your place located?</h2>
                <label for="country" class="fs-question">Country</label> <br />
                <select class="fs-dropbox" name="country">
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Japan">Japan</option>
                    <option value="Mexico">Mexico</option>
                    <!--TO-DO: Add available countries-->
                </select> <br /> <br />
                <label for="streetAddress" class="fs-question">Street Address</label>
                <input type="text" name="streetAddress" placeholder="e.g. 123 Main St." required />
                <label for="streetAddress2" class="fs-question">Apt, Suite, Bldg. (optional)</label>
                <input type="text" name="streetAddress2" placeholder="e.g. Apt 1Q" /> 
                <label for="city" class="fs-question">City</label>
                <input type="text" name="city" placeholder="e.g. Los Angeles" /> 
                <label for="state" class="fs-question">State</label>
                <input type="text" name="state" placeholder="e.g. CA" /> 
                <label for="zipcode" class="fs-question">Zipcode</label>
                <input type="text" name="zipcode" placeholder="e.g. 92304" /> 
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 5: Amenities-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">What amenities do you offer?</h2>
                <div class="control-group">
                    <label class="control control--checkbox">Essentials
                        <input type="checkbox" name="essentials" value="Essentials"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">Wifi
                        <input type="checkbox" name="wifi" value="Wifi"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">Heat
                        <input type="checkbox" name="heat" value="Heat"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">Air Conditioning
                        <input type="checkbox" name="aircon" value="Air Conditioning"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">TV
                        <input type="checkbox" name="tv" value="TV"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">Breakfast, coffee, tea
                        <input type="checkbox" name="food" value="Breakfast, coffee, tea"/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--checkbox">
                        <input type="checkbox" name="entrance" value="Private entrance"/>Private entrance<br />
                        <div class="control__indicator"></div>
                    </label>
                </div>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 6: Shared Spaces-->
        <div class="fstab">
            <div id="tabBody">
            <h2 class="fs-title">What spaces can guests use?</h2>
            <div class="control-group">
                <label class="control control--checkbox">Private living room
                    <input type="checkbox" name="living" value="Private living room"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Pool
                    <input type="checkbox" name="pool" value="Pool"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Laundry - Washer
                    <input type="checkbox" name="washer" value="Washer"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Laundry - Dryer
                    <input type="checkbox" name="dryer" value="Dryer"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Kitchen
                    <input type="checkbox" name="kitchen" value="Kitchen"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Parking
                    <input type="checkbox" name="parking" value="Parking"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Gym
                    <input type="checkbox" name="gym" value="Gym"/>
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--checkbox">Elevator
                    <input type="checkbox" name="elevator" value="Elevator" />
                    <div class="control__indicator"></div>
                </label>
            </div>
            <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 7: Upload photos-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">Show us what your place looks like.</h2>
            	<input name="filesToUpload[]" id="filesToUpload" type="file" multiple />
           		<p>Allow up to 8 photos.</p>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        
        <!--Step 8: Description-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">Edit your description here</h2>
                <h3 class="fs-question">Tell us more! Give your guests a brief overview of your place and what you have to offer.</h3>
                <textarea id="descriptionBox" name="desc" rows="12" columns="20" required ></textarea>
                <p>Additional information (Optional)</p>
                <textarea id="descriptionBox2" name="desc2" rows="3" columns="20"></textarea>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 9: Title-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">Name your place</h2>
                <input type="text" id="titleBox" name="listingTitle" maxlength="100" />
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
        <!--Step 10: House Rules-->
        <div class="fstab">
            <div id="tabBody">
            <h2 class="fs-title">House Rules</h2>
            <h3 class="fs-question">Only guests who agree to your house rules can book. Let guests know if their trip is a right fit
            for your home.</h3>
            <div class="switch-field">
              <div class="switch-title">Suitable for children (2-12 years)</div>
              <input type="radio" id="switch_left" name="suitable212" value="yes" checked/>
              <label for="switch_left">Yes</label>
              <input type="radio" id="switch_right" name="suitable212" value="no" />
              <label for="switch_right">No</label>
            </div>
            <div class="switch-field">
              <div class="switch-title">Suitable for infants (Under 2 years)</div>
              <input type="radio" id="switch_3_left" name="suitableInfant" value="yes" checked/>
              <label for="switch_3_left">Yes</label>
              <input type="radio" id="switch_3_right" name="suitableInfant" value="no" />
              <label for="switch_3_right">No</label>
            </div>
            <div class="switch-field">
              <div class="switch-title">Suitable for pets</div>
              <input type="radio" id="switch_4_left" name="suitablePet" value="yes" checked/>
              <label for="switch_4_left">Yes</label>
              <input type="radio" id="switch_4_right" name="suitablePet" value="no" />
              <label for="switch_4_right">No</label>
            </div>
            <div class="switch-field">
              <div class="switch-title">Smoking allowed</div>
              <input type="radio" id="switch_5_left" name="smoking" value="yes" checked/>
              <label for="switch_5_left">Yes</label>
              <input type="radio" id="switch_5_right" name="smoking" value="no" />
              <label for="switch_5_right">No</label>
            </div>
            <div class="switch-field">
              <div class="switch-title">Events or parties allowed</div>
              <input type="radio" id="switch_6_left" name="party" value="yes" checked/>
              <label for="switch_6_left">Yes</label>
              <input type="radio" id="switch_6_right" name="party" value="no" />
              <label for="switch_6_right">No</label>
            </div>
            <br />
        
            <textarea name="rules" placeholder="Quiet hours? No shoes in the house? No parking?" rows="3" columns="20"></textarea>
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
		
		<!-- Step 11: Checkin - Checkout -->
        <div class="fstab">
            <div id="tabBody">
                <!--<div style="height:440px">-->
                <h2 class="fs-title">How much time do you need before a guest arrives?</h2>
                <select class="fs-dropbox" name="guestPrep">
                    <option value="Same day">Same day</option>
                    <option value="One day">One day</option>
                    <option value="Three days">Three days</option>
                    <option value="Seven days">Seven days</option>
                </select>
                
                <h3 class="fs-question">What time can guests check in?</h3>
                <h3 class="fs-question">From:</h3>
                <select class="fs-dropbox" name="checkIn">
                    <option value="Flexible">Flexible</option>
                    <option value="8AM">8AM</option>
                    <option value="9AM">9AM</option>
                    <option value="10AM">10AM</option>
                    <option value="11AM">11AM</option>
                    <option value="12PM">12PM</option>
                    <option value="1PM">1PM</option>
                    <option value="2PM">2PM</option>
                    <option value="3PM">3PM</option>
                    <option value="4PM">4PM</option>
                    <option value="5PM">5PM</option>
                    <option value="6PM">6PM</option>
                    <option value="7PM">7PM</option>
                    <option value="8PM">8PM</option>
                    <option value="9PM">9PM</option>
                    <option value="10PM">10PM</option>
                    <option value="11PM">11PM</option>
                    <option value="12AM">12AM</option>
                </select>
                
                <h3 class="fs-question">To:</h3>
                <select class="fs-dropbox" name="checkOut">
                    <option value="Flexible">Flexible</option>
                    <option value="8AM">8AM</option>
                    <option value="9AM">9AM</option>
                    <option value="10AM">10AM</option>
                    <option value="11AM">11AM</option>
                    <option value="12PM">12PM</option>
                    <option value="1PM">1PM</option>
                    <option value="2PM">2PM</option>
                    <option value="3PM">3PM</option>
                    <option value="4PM">4PM</option>
                    <option value="5PM">5PM</option>
                    <option value="6PM">6PM</option>
                    <option value="7PM">7PM</option>
                    <option value="8PM">8PM</option>
                    <option value="9PM">9PM</option>
                    <option value="10PM">10PM</option>
                    <option value="11PM">11PM</option>
                    <option value="12AM">12AM</option>
                </select>
                <!--</div>-->
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
		<!--Step 12: Trip Duration-->
        <div class="fstab">
            <div id="tabBody">
            <!--<div style="height:300px">-->
                <h2 class="fs-title">How long can guests stay?</h2>
                <h3 class="fs-question">Min. Nights</h3>
                <input type="number" value="1" min="1" id="minNight" name="minNight" class="count" />
                <h3 class="fs-question">Max. Nights</h3>
                <input type="number" value="1" min="1" id="maxNight" name="maxNight" class="count" /> 
                <br />
                <!--</div>-->
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="button" name="next" class="next action-button" value="Next" onclick="nextPrev(1)"/>
                </div>
            </div>
        </div>
        
		<!--Step 13: House Rules-->
        <div class="fstab">
            <div id="tabBody">
                <h2 class="fs-title">Base price</h2>
                <h3 class="fs-question">Your base price is your default nightly rate.</h3>
                <input type="number" value="1" min="1" id="price" name="price" class="count" />
                <br />
                <div id="h"><hr></div>
                <div id="btns">
                    <input type="button" name="back" class="previous action-button" value="Previous" onclick="nextPrev(-1)"/>
                    <input type="submit" name="submit" class="back action-button" value="Submit">
                </div>
            </div>
        </div>
        
    </form>
    
    </body>
    
</html> 