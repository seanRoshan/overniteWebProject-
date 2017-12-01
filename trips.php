<?php include 'session.php';?>
<?php include 'dbconnect.php';?>
<?



if (!isset($_SESSION['uniqueUsername'])){
	error_reporting(E_ALL);
	header("Location: index.php");
}
   

if (isset($_POST['Cancelled'])){
	
	$bookId = $_POST['bookId'];

	if($bookId != "")
	{
	    $sql10 = "DELETE FROM `BOOKINGTABLE` WHERE `id` LIKE '$bookId'";
        mysqli_query($con, $sql10);
		error_reporting(E_ALL);
        header("Location: trips.php");
	}
	else {
		error_reporting(E_ALL);
	    header("Location: index.php");
	}
}

?>

<html>
    
        <head>
            <link type="text/css" rel="stylesheet" href="css/profile.css" />
            <link type="text/css" rel="stylesheet" href="css/navBar.css" />
			<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
			<script src="js/liveSearch.js"></script>
            <script src="js/navBar.js"> </script>
           
           
            <title>Trips</title>
        </head>
        
<body style="background-color:white;font-family:'Champagne', Times, serif;color: gray">
		
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

            <script>
                $(document).ready(function(){
                    tempList = document.getElementsByClassName("listings_container");
                    if(tempList.length <= 3) {
                        $("#showmore").hide();
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
            </script>
            
            <style>
                /* The Modal (background) */
                .trips_modal {
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
                .trips_modal-content {
                    background-color: #fff;
                    border: 1px solid #888;
                    width: 40%; /* Could be more or less, depending on screen size */
                    height: 60%;
                    margin-top: 5%;
                    margin-left: 30%;
                    margin-right: 30%;
                    overflow: auto;
                    position: relative;
                    color: darkgrey;
                    text-align: center;
                }
                
                .trips_close {
                    position: absolute;
                    right: 2%;
                    top: 9px;
                    color: #000;
                    font-size: 35px;
                    font-weight: bold;
                }
                
                .trips_close:hover,
                .trips_close:focus {
                    color: red;
                    cursor: pointer;
                } 
                
                #tabTop { 
                    height: 120px;
                    margin-bottom: -14px;
                } 
                
                #tabTopLeft { 
                    width: 50%;
                    float: left;
                    text-align: left;
                } 
                
                #tabImage { 
                    float: right;
                    width: 20%;
                    height: 20%;
                }
                
                .tab-title {
                	font-size: 15px;
                	color: #2C3E50;
                	font-family: montserrat;
                	margin-bottom: 10px;
                	float: left;
                	text-align: left;
                }
                
                .tab-subtitle { 
                    font-size: 15px;
                    clear: both;
                    display:inline-block;
                    text-align: left;
                } 
                .price { 
                    font-size: 15px;
                    font-weight: bold;
                    text-align: right;
                    margin-top: -1%;
                }
                .total { 
                    font-weight: bold;
                    color: black;
                    text-align: right;
                    font-size: 19px;
                } 
                
                .locationPic { 
                    width: 100%;
                } 
                
                .tab-subtitle{
                    clear: both;
                    float: left;
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
                    padding: 14px 20px;
                }
            </style>
            <? 
                    $userName = $_SESSION["uniqueUsername"];
            		$sql0 = "SELECT * FROM `BOOKINGTABLE` WHERE `guest` LIKE '$userName'";
                    $result = mysqli_query($con, $sql0);
                    
                    $tmp = 0;
            		while($row = mysqli_fetch_array($result))
            		{
            		    $valid_startDate = 0;
                		$valid_endDate = 0;
                		$numNights = 0;
            		    $tmp++;
            		    $listing = $row['listname'];
            		    $startDate = $row['startData'];
            		    $endDate = $row['endData'];
            		    $data_s = strtotime($startDate);
                		$data_e = strtotime($endDate);
                	
                		if ( ($data_s) && ($data_e))
                		{
                			$valid_startDate = date('Y-m-d', $data_s);
                			$valid_endDate = date('Y-m-d', $data_e);
                			$numNights = ($data_e - $data_s)/(60*60*24) ;
                		}
            		    $place = $row['listname'];
            		    $place = explode("_", $place);
            		    $link = $row['listname'];
            		    $place = $place[1];
            		    $cost = $row['TotalCost'];
            		    $you = $row['guest'];
            		    $bookIden = $row['id'];
						$guest_count = $row['guestCount'];
            		    
            		    
            		    $sql1 = "SELECT * FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$listing'";
                        $result1 = mysqli_query($con, $sql1);
                		$row1 = mysqli_fetch_array($result1);
                		
            		    $uniquelistName = $row1['uniqueListingname'];
						
						
						
						
						
                		$uniqueuserName = $row1['username'];
                        $listingTitle = $row1['listingTitle'];
                        $price = $row1['price'];
                        $location = $row1['city'];
                        $beds = $row1['bedcount'];
                        $prop_type = $row1['property_type'];
                        
                        
                        
                        $sql5 = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$listing'";
                    	$result5 = mysqli_query($con, $sql5);
                    	$row5 = mysqli_fetch_array($result5);
                    	$photo = $row5['url'];
                    
                        
                        $nPrice = $price*$numNights;
                        $service = $nPrice * .15;
                        
                        $cost = ($nPrice) + $service + 50;
                        
            		    if($you == "")
            		    {
            		        $you = "yay";
            		    }
            		    
            		    echo '<div class="trips_modal" id="'.$tmp.'">';
                		    echo '<div class="trips_modal-content">';
                    		    echo '<span onclick="document.getElementById(\''.$tmp.'\').style.display=\'none\'" class="trips_close" title="Close Modal">&times;</span>';
                                echo '<div style="padding: 50px">';
                                    echo '<div id="tabTop">';
                                        echo '<div id="tabTopLeft">';
                                            echo '<h2 class="tab-title" style="font-family: \'champagne\' ">'.$numNights.' night(s) in '.$place.'</h3>';
                                            echo '<p class="tab-subtitle" id="propType2">'.$prop_type.'</p> <br />';
                                            echo '<p class="tab-subtitle" id="numBeds">'.$beds.' bed(s)</p>';
                                        echo '</div>';
                                        echo '<div id="tabImage">';
                                            echo '<img src="'.$photo.'" class="locationPic"/>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<hr style="clear:both">';
                                    echo '<img src="https://png.icons8.com/user-account/ios7/20/000000">';
                                    echo '<p class="tab-subtext" id="numGuests" style="display:inline;">'.$guest_count.' guest(s)</p> <br/>';
                                    echo '<img src="https://png.icons8.com/today/dotty/20/000000">';
                                    echo '<p class="tab-subtext" id="checkInDate" style="display:inline;">'.$startDate.'</p>';
                                    echo '<img src="https://png.icons8.com/advance/ios7/20/000000">';
                                    echo '<p class="tab-subtext" id="checkOutDate" style="display:inline;"></a>'.$endDate.'</p>';
                                    echo '<hr>';
                                    echo '<label for="subPrice" id="subPriceLabel">$'.$price.' x '.$numNights.' night(s)</label>';
                                    echo '<p class="price" id="subPrice">$'.$nPrice.'</p><br />';
                                    echo '<label for="cleaningFee" id="cleaningFeeLabel">Cleaning Fee</label>';
                                    echo '<p class="price" id="cleaningFee">$50.00</p><br />';
                                    echo '<label for="serviceFee" id="serviceFeeLabel">Service Fee</label>';
                                    echo '<p class="price" id="serviceFee">$'.$service.'</p><br/>';
                                    echo '<hr>';
                                    echo '<label for="totalPrice" id="total">Total (USD):</label>';
                                    echo '<p class="total" id="totalPrice">'.$cost.'</p>';
                                    echo '<a href="individual_listing.php?listname='.$link.'" style="color:inherit">';
                                        echo '<input type="button" value="View Listing" id="view_listing" class="view_listing_Btn" style="margin-bottom: 3%">';
                                    echo '</a><br>';
                                    
                                    echo '<form action="trips.php" method="post">'; 
                                        echo '<input type="submit" name="Cancelled" value="Cancel Booking" id="view_listing" class="view_listing_Btn" style="margin-bottom: 3%">';
                                        echo '<input id="bookId" name="bookId" type="hidden" value="'.$bookIden.'">';
                                    echo '</form>';
        
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
            ?>
            
            <div class="heading" style="margin-top: 3%"><h2>Trips Booked</h2></div>
            
            <div style="margin-left: 20%">
                <?
            		$userName = $_SESSION["uniqueUsername"];
            		
            		$sql0 = "SELECT * FROM `BOOKINGTABLE` WHERE `guest` LIKE '$userName'";
                    $result = mysqli_query($con, $sql0);
                    
                    $tmp = 1;
                    $trips_message = -1;
                    while($row = mysqli_fetch_array($result))
                    {
                        $trips_message = 1;
                        $listing = $row['listname'];
                        $sql1 = "SELECT * FROM `LISTINGTABLE` WHERE `uniqueListingname` LIKE '$listing'";
                        $result1 = mysqli_query($con, $sql1);
                        
                        $sql5 = "SELECT * FROM `USERPHOTOS` WHERE `listingname` LIKE '$listing'";
                    	$result5 = mysqli_query($con, $sql5);
                    	$row5 = mysqli_fetch_array($result5);
                    	$photo = $row5['url'];
                    	$photoList = $row5['listingname'];
                        
                		$row1 = mysqli_fetch_array($result1);
                		    $tuniquelistName = $row1['uniqueListingname'];
                			$uniquelistName = $row1['uniqueListingname'];
                			$uniquelistNameArray = explode("_", $uniquelistName);
							
							if (sizeof($uniquelistNameArray)>1){
								$uniquelistName = $uniquelistNameArray[1];
							}
						
                			$uniqueuserName = $row1['username'];
                            $listingTitle = $row1['listingTitle'];
                        	$price = $row1['price'];
                        	$location = $row1['city'];
                        	
                        	$sql2 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$uniquelistName'";
                        	$result2 = mysqli_query($con, $sql2);
        
                            echo '<a href="#'.$tmp.'" style="color:inherit" onclick="document.getElementById(\''.$tmp.'\').style.display=\'block\'">';
                            echo '<div class="listings_container">';
                            echo  '<img src="'.$photo.'" alt="temp listing">';
                            echo '<div class="listing_desc">';
                            echo '<div class="title"><b>'.$uniquelistName.'</b></div>';
                            echo '<div class="location"><b>'.$location.'</b></div>';
                            echo '<div class="cost">$'.$price.' per night</div>';
                            
                            if($uniquelistName != "")
                            {
                                $sql3 = "SELECT * FROM `comments` WHERE `listingname` LIKE '$tuniquelistName'";
                		
                        		$result3 = mysqli_query($con, $sql3);
                                
                        	    $sumStars = 0;
                        	    $reviewCount = 0;
                        	
                        		while($row2 = mysqli_fetch_array($result3)){
                        			   $sumStars = $sumStars + $row2['stars'];
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
                            echo '</div></div></div></a>';
                            $tmp = $tmp + 1;
                    }
    		    ?>
                
            </div>
            
            <?
            if ($trips_message == -1)
                    {
                        echo '<div style="clear:both" align = "center"><h3>You haven\'t booked any trips yet.</h3></div>';
                    }
            ?>
        
            <input type="button" value="Show More" id="showmore" class="showmoreBtn" style="margin-bottom: 3%">
                
        </body>
        
</html>
