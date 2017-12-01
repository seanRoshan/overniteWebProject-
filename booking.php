<?php include 'session.php';?>
<? 


$listname  = "";

if (!isset($_SESSION['uniqueUsername'])){
	header("Location: index.php");
}

if ( isset($_GET['listname']) ) {
	$uniquelistname = $_GET['listname'] ;
}
else {
	header("Location: index.php");
}


$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection	
$con = mysqli_connect($servername, $username, $password, $dbname);

if ($con == false){
	//echo "<br> Connection was not successfull<br>";
}
else {
	//echo "MySQL Connected successfully!<br>";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = str_replace("'","''",$data);
	return $data;
}



if (isset($_POST['bookRequest'])){
	
	
	// Initialize Variables Here
	
	$sql_list = "SELECT * FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$uniquelistname'";
	$result_list = mysqli_query($con, $sql_list);
	$row_list = mysqli_fetch_array($result_list);
	
	
	$host = $row_list['username'];
	$price = $row_list['price'];
	
	
	$guest = $_SESSION['uniqueUsername'];
	
	
	$startDate = $_POST['checkin'];
	$endDate = $_POST['checkout'];
	
	$_SESSION['checkin'] = $startDate;
	$_SESSION['checkout'] = $endDate;
	
	$guestCount = $_POST['guestcount'];
	
	//echo $owner."<br>";
		
}


// After booking submit
if (isset($_POST['bookSubmit'])){
	
	$guestFname = test_input($_POST['fName']);
	$guestLname = test_input($_POST['lName']);
	$guestCount = test_input($_POST['numGuests']);
	$guestBio = test_input($_POST['guestBio']);
	
	
	$cardNum = test_input($_POST['cardNum']);	
	$expDate = test_input($_POST['expDate']);	
	$cvv = test_input($_POST['cvv']);
	
	$host = $_SESSION['hostUsername'] ;
	$uniquelistname = $_SESSION['uniqueListingName'] ;
	$guest = $_SESSION['uniqueUsername'];
	$totalCost = $_SESSION['totalCost'];
					
	$startDate = $_SESSION['checkin'];
	$endDate = $_SESSION['checkout'];
	
	
	
	
	$numNights = $_SESSION['NUMCOUNT'];
	
	
	
	
		
	if ( ($cardNum == "374261884571008") && ($cvv == "8359") && ($expDate == "12/20") ) {
					
					$dayCountsFromTodayStart = $_SESSION['STARTINDEX'];
					$dayCountsFromTodayEnd = $_SESSION['ENDINDEX'];
					
							
					// Insert into the database
					$sql_book = "INSERT INTO `BOOKINGTABLE` (`listname`, `host`, `guest`, `startData`, `endData`, `guestCount`, `TotalCost`, `fname`, `lname`) VALUES ('$uniquelistname', '$host' , '$guest' , '$startDate' , '$endDate' , '$guestCount', '$totalCost', '$guestFname', '$guestLname' );";
					
	
					if ($con->query($sql_book) === TRUE) {
						
						
						$dateArray = $_SESSION['LIST_DATEARRAY'];
						$referenceDate = $_SESSION['LIST_TODAY'];
						$id = $_SESSION['LIST_ID'];

/*						echo "dateArray Before: ".$dateArray."<br>";*/
						
						// update array
						for ($i = $dayCountsFromTodayStart; $i <= $dayCountsFromTodayEnd; $i++) {
							$dateArray[$i]="0";
						}
						
/*						echo "dateArray After: ".$dateArray."<br>";
						echo "referenceDate: ".$referenceDate."<br>";
						echo "id: ".$id."<br>";
						echo "length: ".strlen($dateArray)."<br>";*/

						$sql_update = "UPDATE `LISTINGTABLE` SET `dateArray` = '$dateArray', `dateReference` = '$referenceDate' WHERE `LISTINGTABLE`.`ID` = '$id';";
						mysqli_query($con, $sql_update);
						
						
						
						unset($_SESSION['ENDINDEX']);
						unset($_SESSION['hostUsername']);
						unset($_SESSION['uniqueListingName']);
						unset($_SESSION['totalCost']);
						unset($_SESSION['checkin']);
						unset($_SESSION['checkout']);
						unset($_SESSION['LIST_ID']);
						unset($_SESSION['LIST_DATEARRAY']);
						unset($_SESSION['LIST_TODAY']);
						unset($_SESSION['NUMCOUNT']);
						unset($_SESSION['STARTINDEX']);
						unset($_SESSION['ENDINDEX']);
						unset($_SESSION['ERROR_MESSAGE']);
						
							
						
						
						$_SESSION['bookstatus'] = "success";
						
						header("Location: individual_listing.php?listname="."$uniquelistname");
						//echo "New record created successfully";
					} 
					else {
						echo "Error: " . $sql_book . "<br>" . $con->error;
					}			
	
			}
			else {
				$_SESSION['bookstatus'] = "invalidCreditCard";
				header("Location: individual_listing.php?listname="."$uniquelistname");
			}	
		
}

		$sq0 = "SELECT * FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$uniquelistname'";
        $result = mysqli_query($con, $sq0);
        $row = mysqli_fetch_array($result);
        
        if ($row){
        	// Retrive listing information
        	$listingName = $row['listingTitle'];				
        
        	$listingTitle = $row['listingTitle'];
			
        	$host = $row['username'];
			
			$_SESSION['hostUsername'] = $host ;
			$_SESSION['uniqueListingName'] = $uniquelistname;
			
			
        	$city = $row['city']; 
        
            $guestcount = $row['gcount'];
        	$bedcount = $row['bedcount'];

        	$property_type = $row['property_type'];
        	$property_type2 = $row['property_type2'];
        
        	$suitable212 = $row['suitable212'];
        	$suitableInfant = $row['suitableInfant'];
        	$suitablePet = $row['suitablePet'];
        	$smoking = $row['smoking'];
        	$party = $row['party'];
        	$rules = $row['rules'];
            
            $checkIn = $row['checkIn'];
	        $checkOut = $row['checkOut'];
	        
        	$price = $row['price'];
			
			$dateArray = $row['dateArray'];
			$oldReferenceDate = $row['dateReference'];
			
			$id = $row['ID'];
			
			$_SESSION['LIST_ID'] = $id;
			$_SESSION['LIST_DATEARRAY'] = $dateArray;
			$_SESSION['LIST_TODAY'] = $date_today;
			
			
			

        } 
        
        $sql1 = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$uniquelistname'";
    	$result1 = mysqli_query($con, $sql1);
		$row1 = mysqli_fetch_array($result1);
	
		if ($row1){
			$photo = $row1['url'];
		}
		
        
	    $data_s = strtotime($startDate);
		$data_e = strtotime($endDate);
	    
		if ( ($data_s) && ($data_e)){
			
			$valid_startDate = date('F j, Y', $data_s);
			$valid_endDate = date('F j, Y', $data_e);
			$numNights = ($data_e - $data_s)/(60*60*24) ;
		
		}
		
// 		$data_s = strtotime($startDate);
// 		$data_e = strtotime($endDate);
	
// 		if ( ($data_s) && ($data_e) && ($data_s!=$data_e)){

// 			$valid_startDate = date('Y-m-d', $data_s);
// 			$valid_endDate = date('Y-m-d', $data_e);
		
// 			$date_today = date("Y-m-d");
			
// 			$_SESSION['LIST_TODAY'] = $date_today;
			
// 			$dayCountsFromTodayStart = ($data_s - strtotime($date_today))/(60*60*24) ;
// 			$dayCountsFromTodayEnd = ($data_e - strtotime($date_today))/(60*60*24) ;
// 			$numNights = (($data_e - $data_s)/(60*60*24))+1 ;

// 			$_SESSION['NUMCOUNT'] = $numNights;

			
/*			echo "startDate: ".$startDate."<br>";
			echo "endDate: ".$endDate."<br>";
			echo "valid_startDate: ".$valid_startDate."<br>";
			echo "valid_endDate: ".$valid_endDate."<br>";
			echo "date_today: ".$date_today."<br>";
			echo "valid_startDate: ".$valid_startDate."<br>";
			echo "valid_startDate: ".$valid_startDate."<br>";
			echo "valid_startDate: ".$valid_startDate."<br>";*/
			

// 			if ($dayCountsFromTodayStart>=0){
// 				if ($dayCountsFromTodayEnd<30){
					
// /*					echo "Today is " . $date_today . "<br>";
// 					echo "Start Date is ". $valid_startDate . "<br>";
// 					echo "End Date is ". $valid_endDate . "<br>";
// 					echo "Num Nights ". $numNights . "<br>";
// 					echo "Start Date is ".$dayCountsFromTodayStart. " days from today<br>";
// 					echo "End Date is ".$dayCountsFromTodayEnd. " days from today<br>";*/
					
// 					if ($numNights>0){
// 						$validReservation = true;
// 						$_SESSION['STARTINDEX'] = $dayCountsFromTodayStart;
// 						$_SESSION['ENDINDEX'] = $dayCountsFromTodayEnd;
// 						for ($i = $dayCountsFromTodayStart; $i <= $dayCountsFromTodayEnd; $i++) {
//     						//echo "dataArray[$i] = $dateArray[$i] <br>";
// 							if ($dateArray[$i]=="0"){
// 								$validReservation = false;
// 								break;
// 							}
// 						}
// 						if ($validReservation){
// 							//unset($_SESSION['ERROR_MESSAGE']);
							
// 						}
// 						else {
// 							$_SESSION['ERROR_MESSAGE'] = "Selected dates are not available!";
// 							error_reporting(E_ALL);
// 							header("Location: individual_listing.php?".$_SESSION['listname']);
// 						}

// 					}
// 					else {
// 						$_SESSION['ERROR_MESSAGE'] = "checkout date should be after check-in date!";
// 						error_reporting(E_ALL);
// 						header("Location: individual_listing.php?".$_SESSION['listname']);
// 					}
// 				}
// 				else {
// 					$_SESSION['ERROR_MESSAGE'] = "Who knows what will happen beyond one month! We cannot make reservation beyond one month from today!";
// 					error_reporting(E_ALL);
// 					header("Location: individual_listing.php?".$_SESSION['listname']);
// 				}
				
// 			}
// 			else {
// 				$_SESSION['ERROR_MESSAGE'] = "You travel back in time, Can you?!!!";
// 				error_reporting(E_ALL);
// 				header("Location: individual_listing.php?".$_SESSION['listname']);
// 			}
// 		}
// 		else {
// 			$_SESSION['ERROR_MESSAGE'] = "checkout date should be after check-in date!";
// 			error_reporting(E_ALL);
// 			header("Location: individual_listing.php?".$_SESSION['listname']);
// 		}
	
        $subPrice = $price * $numNights; 
        $cleaningFee = 50.00; 
        $serviceFee = number_format($price * 0.15, 2); 
	    $totPrice = number_format($subPrice + $cleaningFee + $serviceFee, 2); 
	
	
		$_SESSION['totalCost'] = $totPrice;
?>	

<html>
    

<head>

	
	<link type="text/css" rel="stylesheet" href="css/bookingForm.css" />
	<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
	<link type="text/css" rel="stylesheet" href="css/navBar.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="js/listing.js" type="text/javascript"></script>
	<script src="js/liveSearch.js"></script>
	<script src="js/navBar.js"> </script>
	
	<title>Book your stay</title>
	
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
    
    <div class="sidetab">
        <!--Will say NumNights in City-->
        <div id="tabTop">
            <div id="tabTopLeft">
                <?
                    if($numNights == 1) { 
                        echo '<h2 class="tab-title">'.$numNights.' night in '.$city.'</h3>'; 
                    }
                    else { 
                        echo '<h2 class="tab-title">'.$numNights.' nights in '.$city.'</h3>';
                    }
                ?>
                <br />
                <br />
                <!--Entire home/apt, private room, shared room-->
                <p class="tab-subtitle" id="propType2"><? echo $property_type2; ?></p> <br />
                <!--Number of beds-->
                <p class="tab-subtitle" id="numBeds"><? echo $bedcount." beds"; ?></p>
            </div>
            
            <div id="tabImage">
                <? echo '<img src="'.$photo.'" class="locationPic">'; ?>
            </div>
            
        </div>
       <hr>
        <!--Number of guests-->
        <img src="https://png.icons8.com/user-account/ios7/20/000000">
        <? 
            if($guestCount == 1) { 
                echo '<p class="tab-subtext" id="numGuests" style="display:inline;">'.$guestCount.' guest</p><br/>'; 
            }
            else { 
                echo '<p class="tab-subtext" id="numGuests" style="display:inline;">'.$guestCount.' guests</p><br/>'; 
            }
        ?>
        <!--Check in date-->
        <img src="https://png.icons8.com/today/dotty/20/000000">
        <p class="tab-subtext" id="checkInDate" style="display:inline;"><? echo $valid_startDate; ?></p>
        <!--Check out date--> 
        <img src="https://png.icons8.com/advance/ios7/20/000000">        
        <p class="tab-subtext" id="checkOutDate" style="display:inline;"></a><? echo $valid_endDate; ?></p>
        <hr>
        <label for="subPrice" id="subPriceLabel"><? echo "$".$price; ?> x <? if($numNights == 1) { echo $numNights." night"; } else { echo $numNights." nights"; } ?> </label>
        <p class="price" id="subPrice"><? echo "$".$subPrice ?></p><br />
        <!--Cleaning fee will be a flat rate-->
        <label for="cleaningFee" id="cleaningFeeLabel">Cleaning Fee</label>
        <p class="price" id="cleaningFee"><? echo "$".$cleaningFee; ?></p><br />
        <!--Service fee will be 15% of the subPrice-->
        <label for="serviceFee" id="serviceFeeLabel">Service Fee</label>
        <p class="price" id="serviceFee"><? echo "$".$serviceFee; ?></p><br/>
        <hr>
        <label for="totalPrice" id="total">Total (USD):</label>
        <p class="total" id="totalPrice"><? echo "$".$totPrice; ?></p>
    </div>    
    
    <form <?echo 'action="booking.php?listname='.'$uniquelistname'.'"'; ?>  method="post" > 
    <div class="fstab">
        <h2 class="fs-title">Review House Rules</h2>
        <ul>
            <? 
            	if($suitable212 === "yes") { 
            	    echo '<img src="https://png.icons8.com/children/win8/18/666666" style="width:18px"><li class="houseRules">Suitable for children 2 - 12</li> <br> <hr class="a">';
            	} 
            	else { 
            	    echo '<img src="https://png.icons8.com/keep-away-from-children/win8/18/666666" style="width:18px"><li class="houseRules">Not suitable for children 2 - 12</li> <br> <hr class="a">';    
            	} 
            	if($suitableInfant === "yes") { 
            	    echo '<img src="https://png.icons8.com/babys-room/win8/18/666666" style="width:18px"><li class="houseRules">Suitable for infants</li> <br> <hr class="a">';
            	} 
            	else { 
            	    echo '<img src="https://png.icons8.com/keep-away-from-children/win8/18/666666" style="width:18px"><li class="houseRules">Not suitable for infants</li> <br> <hr class="a">';
            	} 
                if($smoking === "yes") {
                    echo '<img src="https://png.icons8.com/smoking/win8/18/666666" style="width:18px"><li class="houseRules">Smoking is allowed</li> <br> <hr class="a">'; } 
                else { 
                    echo '<img src="https://png.icons8.com/no-smoking/win8/35/000000" style="width:18px"><li class="houseRules">No smoking</li> <br> <hr class="a">';
                } 
                if($suitablePet === "yes") { 
                    echo '<img src="https://png.icons8.com/chicken/win8/18/666666" style="width:18px"><li class="houseRules">Suitable for pets</li> <br> <hr class="a">'; } 
                else { 
                    echo '<img src="https://png.icons8.com/no-animals/win8/17/000000" style="width:18px"><li class="houseRules">Not suitable for pets</li> <br> <hr class="a">';
                } 
                if($party === "yes") { 
                    echo '<img src="https://png.icons8.com/wine-glass/win8/18/666666"><li class="houseRules">Parties or events allowed</li> <br /> <hr class="a">';
                } 
                else { 
                    echo '<img src="https://png.icons8.com/no-alcohol/win8/18/000000"><li class="houseRules">No parties or events</li> <br /> <hr class="a">';
                } 
                if($checkIn == "Flexible") { 
                    echo '<img src="https://png.icons8.com/key/win8/18/000000"><li class="houseRules">Check in time is flexible.</li> <br /> <hr class="a">';
                } 
                else { 
                    echo '<img src="https://png.icons8.com/key/win8/18/000000"><li class="houseRules">Check in is anytime after '.$checkIn.'</li> <br /> <hr class="a">';
                }
                if($checkOut == "Flexible") {
                    echo '<img src="https://png.icons8.com/key/win8/18/000000"><li class="houseRules">Check out time is flexible </li> <br /> <hr class="a">';
                }
                else { 
                    echo '<img src="https://png.icons8.com/key/win8/18/000000"><li class="houseRules">Check out by '.$checkOut.' </li> <br /> <hr class="a">';
                }
            ?>
            
        </ul>
        
        <h3 class="fs-subtitle">Additional rules</h3>
        <p class="text"><? echo $rules ?></p>
        <input type="button" name="next" class="next action-button" value="Agree and Continue" onclick="nextPrev(1)"/>
    </div>
    
    <div class="fstab">
        <h2 class="fs-title">Who's coming?</h2>
        <h3 class="fs-subtitle">Guests</h3>
        <!--TO-DO: Make this dropbox dynamic. Populate with the maximum number of guests set by the host-->
        <?php
        
            echo '<select class="fs-dropbox" name="numGuests">';
            echo '<option value="1">1 guest</option>';
            for($s = 2; $s <= $guestcount; $s++) { 
                echo "<option value=\"$s\">$s guests</option>";
            }
            echo '</select>';
        ?>
        <h3 class="fs-subtitle"><b>Say hello to your host</b></h3>
        <p class="fs-subtext">Let <? $h1 = substr($host, strpos($host, "_") + 1); echo $h1; ?> know a little about yourself and why you're coming.</p>
        <textarea name="guestBio" rows="5" columns="10">Hey <? echo $h1; ?>! Can't wait to spend some time here.</textarea>
        <input type="button" name="next" class="next action-button" value="Continue" onclick="nextPrev(1)"/>
    </div>
    
    <div class="fstab">
        <h2 class="fs-title">Confirm and Pay</h2>
        
        <div class="paymentOptions">
            <div class="credit">
                <div id="firstName">
                    <label for="fName" class="fs-subtitle"><b>First Name</b></label>
                    <input type="text" id="fName" name="fName" placeholder="John" required/>
                </div>
                
                <div id="lastName">
                    <label for="lName" class="fs-subtitle"><b>Last Name</b></label>
                    <input type="text" id="lName" name="lName" placeholder="Smith" required/>
                </div>
                
                <div id="cardInfo">
                    <label for="" class="fs-subtitle"><b>Card Info</b></label>
                    <input type="text" id="cardNum" name="cardNum" placeholder="Card number" required/>
                    <input type="text" id="expDate" name="expDate" placeholder="Expiration" required/>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV" required/>
                </div>
            </div>
        </div>
        
        <div id="cancellation">
            <p class="fs-subtitle"><b>Cancellation Policy:</b></p>
            <p id="cancelInfo">Cancel up to 7 days in before check in and get a 50% refund (minus service fees).
            Cancel within 7 days of your trip and the reservation is non-refundable. Service fees are refunded 
            when cancellation happens before check in and within 48 hours of booking.
            </p>
        </div>
        
        <div id="agreement">
            <p id="agreeInfo"> 
            I agree to the House Rules, Cancellation Policy, and to the Guest Refund Policy.
            I also agree to pay the total amount shown, which includes Cleaning and Service fees. 
            </p>
        </div>
        <input type="submit" name="bookSubmit" class="submit action-button" value="Request to Book" />
    </div>
        
    </form>
    </body>
</html>

<script>
    $(document).on('change', '.div-toggle', function() {
      var target = $(this).data('target');
      var show = $("option:selected", this).data('show');
      $(target).children().addClass('hide');
      $(show).removeClass('hide');
    });
    $(document).ready(function(){
    	$('.div-toggle').trigger('change');
    });
</script>