$(window).scroll(function() {
  if ($(this).scrollTop()> 110) {
    $('nav').fadeIn('slow');
   } 
});

/// Scroll back to top
$("a[href='#top']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "10s");
  return false;
});

function myNewFunction(i){
    var pop = "myPopup"+i.toString();
    var popup = document.getElementById(pop);
    if(popup.style.visibility == 'visible')
    {
      popup.style.visibility='hidden';
    }
    else
    popup.style.visibility='visible';
}
