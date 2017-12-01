<?
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection	
$link = mysqli_connect($servername, $username, $password, $dbname);

if ($link == false){
	echo "<br> Connection to Database was not successfull<br>";
}
else {
    //echo "MySQL Connected successfully!<br>";
	
}

if(isset($_REQUEST['term'])){
    // Prepare a select statement
    $sql = "SELECT * FROM USERDATA WHERE uniqueUsername LIKE ?";
	

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST['term'] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
				
				
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$username = $row['uniqueUsername'];
					echo "<p><a class='searchLinks'  href='profile.php?username=".$username."'>".$username."</a></p>";
                }
				
				
            } else{
				
				$sql = "SELECT * FROM LISTINGTABLE WHERE country LIKE ?";
				
				if($stmt = mysqli_prepare($link, $sql)){
						// Bind variables to the prepared statement as parameters
						mysqli_stmt_bind_param($stmt, "s", $param_term);

						// Set parameters
						$param_term = $_REQUEST['term'] . '%';

						// Attempt to execute the prepared statement
						if(mysqli_stmt_execute($stmt)){
							$result = mysqli_stmt_get_result($stmt);

							// Check number of rows in the result set
							if(mysqli_num_rows($result) > 0){
								// Fetch result rows as an associative array


								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
									$listingname = $row['uniqueListingname'];
									echo "<p><a class='searchLinks'  href='individual_listing.php?listname=".$listingname ."'>".$listingname ."</a></p>";
								}
				
				
							}
							else {
					
								$sql = "SELECT * FROM LISTINGTABLE WHERE city LIKE ?";

								if($stmt = mysqli_prepare($link, $sql)){
									// Bind variables to the prepared statement as parameters
									mysqli_stmt_bind_param($stmt, "s", $param_term);

									// Set parameters
									$param_term = $_REQUEST['term'] . '%';

									// Attempt to execute the prepared statement
									if(mysqli_stmt_execute($stmt)){
										$result = mysqli_stmt_get_result($stmt);

										
										
										
										
										// Check number of rows in the result set
										if(mysqli_num_rows($result) > 0){
											// Fetch result rows as an associative array
											$cityArray = array();
											
											
											
											while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
												$listingname = $row['uniqueListingname'];
												
												$city = $row['city'];
												$cityArray[$city]=$city;
/*												echo "<p><a class='searchLinks'  href='result.php'>".$cityArray[$city]."</a></p>";
												echo "<p><a class='searchLinks'  href='result.php?city=".$cityArray[$city] ."'>".$cityArray[$city] ."</a></p>";*/
												//echo "<p><a class='searchLinks'  href='individual_listing.php?listname=".$listingname ."'>".$listingname ."</a></p>";
											}
											
											foreach ($cityArray as $city){
												echo "<p>".'<i class="fa fa-map-marker" aria-hidden="true">&nbsp;</i>'."<a class='searchLinks'  href='result.php?city=".$city ."'>".$city ."</a></p>";
											}
											
											

										}
										else {
											
													$sql = "SELECT * FROM LISTINGTABLE WHERE state LIKE ?";

													if($stmt = mysqli_prepare($link, $sql)){
														// Bind variables to the prepared statement as parameters
														mysqli_stmt_bind_param($stmt, "s", $param_term);

														// Set parameters
														$param_term = $_REQUEST['term'] . '%';

														// Attempt to execute the prepared statement
														if(mysqli_stmt_execute($stmt)){
															$result = mysqli_stmt_get_result($stmt);

															// Check number of rows in the result set
															if(mysqli_num_rows($result) > 0){
																// Fetch result rows as an associative array

																while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
																	$listingname = $row['uniqueListingname'];
																	echo "<p><a class='searchLinks'  href='individual_listing.php?listname=".$listingname ."'>".$listingname ."</a></p>";
																}

															}
															else {
																
																echo "<p>No matches found</p>";
																
															}
														}
													}
										}


										}
									}
									
									
								 }
							}
						 }
					
				 }
				 

            }
			
			
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);

?>