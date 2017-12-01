 <?php include 'session.php';?>

<?php include 'dbconnect.php';?>
<?

if (isset($_GET['city'])){
	$location = $_GET['city'];
}

?> 

<html>
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
        <head>
            <link type="text/css" rel="stylesheet" href="css/navBar.css" />
			<link type="text/css" rel="stylesheet" href="css/searchBar.css" />
			<link type="text/css" rel="stylesheet" href="css/result.css" />
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
        
        <?
            echo '<div class="heading" style="padding-top:75px;padding-left:250px;color:darkgray"><h2>Results for "'.$location.'"</h2></div>';
        ?>
        <div class="heading" style="padding-left:275px;color:darkgray"><h2>Places</h2></div>
        
        <?
		
        		$sql0 = "SELECT * FROM LISTINGTABLE WHERE `city` LIKE '$location'";
        		//$sql0 = "SELECT * FROM LISTINGTABLE";
                $result = mysqli_query($con, $sql0);
                $index = 1;
                
                echo '<div class="scrollmenu" align="left" style="margin-left:275px;margin-right:275px; padding:7px;">';
        
                if($row === false)
                {
                    
                }
                else 
                {
                    while($row = mysqli_fetch_array($result))
            		{
            		    if($index%4 == 0)
            		    {
            		        $index = 1;
            		        echo '</div><div class="scrollmenu" align="left" style="margin-left:300px;margin-right:300px; padding:7px;">';
            		    }
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
            			
            			echo '<a href="individual_listing.php?listname='.$uniquelistName.'" style="color:inherit; padding: 7px; width:auto" align="left"><div class="booking-Node" align="left" style="border-style:none;width:32%;-webkit-box-shadow: 0 0 6px #8F8FBC;box-shadow: 0 0 6px #8F8FBC;">';
                        echo '<img src="'.$listImageURL.'" alt="Logo" style="width:100%;height:150px;">';
                        echo '<div id="text-Title"><b>'.$listingTitle.'</b><br/></div>';
                        echo '<div id="text-Rent"><b>$'.$price.' per night</b> </div>';
                        echo '<div id="text-Desc" style="max-height: 3.25em;min-height: 3.25em;">'.$description.'</div>';
                        
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
            			    
                    		    echo '<div style="font-family:\'champagne\'; padding-top:10px;" align="center"> Review: ';
            			  		for ($s = 0; $s < $fullStar; $s++) {
            						echo '<span id="star5" class="fa fa-star bigger" style="color:ORANGE;" align="center"></span>';
            					}
            			  
            			  		for ($s = 0; $s < $halfStar; $s++) {
            						echo '<span id="star1" class="fa fa-star-half-full bigger" style="color:ORANGE" align="center"></span>';
            					} 
            			  
            					for ($s = 0; $s < $emptyStar; $s++) {
            						echo '<span id="star1" class="fa fa-star-o bigger" align="center"></span>';
            					}
                        }
                        else
                        {
                            echo '<div style="font-family:"champagne" align="center"> Review: ';
                            for ($i = 0; $i < 5; $i++) 
                            {
            						echo '<span id="star1" class="fa fa-star-o bigger"></span>';
            				}
                        }
                        $index = $index + 1;
                        echo '</div></div></a>';
                    }
                }
        		
        ?>	
          
        </div>  
    
    <!-- <div class="heading" style="padding-left:275px;color:darkgray"><h2>People</h2></div>
    
    <div class="scrollmenu" align="center" style="margin-left:150px;margin-right:150px; padding:0px;">
        <div class="booking-Node-People" align="left">
            <img src="img/howlsbackground.jpg" alt="Logo" align="center" style="width:50%;height:150px;border-radius:50%;display:block;margin:auto">
            <div id="text-Title"><b>Howls moving castle:</b> <br /></div>
            <div id="text-Desc"> This house travels! Please take this into account. You literally 
                don't know where its going.</div>
                <div align="center" style="padding-top:5px;">
                Review:
                <span id="star1" class="fa fa-star"></span>
                <span id="star2" class="fa fa-star"></span>
                <span id="star3" class="fa fa-star"></span>
                <span id="star4" class="fa fa-star"></span>
                <span id="star5" class="fa fa-star"></span>
                </div>
        </div>
        
        <div class="booking-Node-People" align="left">
            <img src="img/howlsbackground.jpg" alt="Logo" style="width:100%;height:150px;">
            <div id="text-Title"><b>Howls moving castle:</b> <br /></div>
            <div id="text-Desc"> This house travels! Please take this into account. You literally 
                don't know where its going.</div>
                <div align="center" style="padding-top:5px;">
                Review:
                <span id="star1" class="fa fa-star"></span>
                <span id="star2" class="fa fa-star"></span>
                <span id="star3" class="fa fa-star"></span>
                <span id="star4" class="fa fa-star"></span>
                <span id="star5" class="fa fa-star"></span>
                </div>
        </div>
        
        <div class="booking-Node-People" align="left">
            <img src="img/howlsbackground.jpg" alt="Logo" style="width:100%;height:150px;">
            <div id="text-Title"><b>Howls moving castle:</b> <br /></div>
            <div id="text-Rent"><b>$77 per night</b></div>
            <div id="text-Desc"> This house travels! Please take this into account. You literally 
                don't know where its going.</div>
                <div align="center" style="padding-top:5px;">
                Review:
                <span id="star1" class="fa fa-star"></span>
                <span id="star2" class="fa fa-star"></span>
                <span id="star3" class="fa fa-star"></span>
                <span id="star4" class="fa fa-star"></span>
                <span id="star5" class="fa fa-star"></span>
                </div>
        </div>
    </div>-->

        </body>
        <br></br>
        <li class="bottomBar" style = "list-style-type:none; padding-top: 10px; padding-bottom: 5px; padding-left: 10px;"><bottom>Overnite &copy;</bottom></li>
</html>
