var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("fstab");
  x[n].style.display = "block";
}

function nextPrev(n) {
		
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("fstab");
  //document.getElementById("progressbar").classList.remove("active");

   // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  showTab(currentTab);
	
}
