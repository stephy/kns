<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META NAME="TITLE" CONTENT="Photographers in Los Angeles." > 
<META NAME="DESCRIPTION" CONTENT="Best Photographers in Los Angeles.  Wedding Photography, Professional Portrait, Family Portraits, Landscape, indoor and outdoor events. ">

<META NAME="KEYWORDS" CONTENT="wedding, photography, photographers, good photographers, cheap, affordable, los angeles, california, photo, picture, portrait, landscape, canon, camera, pic, pix, photoshop, kevin, deng, chao, stephani, moroni, alves, stephani Alves, kevin Deng, Chao Deng, retouching"> 

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Events Photo Gallery around Los Angeles, California</title>

<link href="css/style_master.css" rel="stylesheet" type="text/css">
<link href="css/navigation.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.6.1.min.js"> </script>
<script>
	function swapImages(){
		var $active = $('#slider .active');
		var $next = ($('#slider .active').next().length >0) ? 
		$('#slider .active').next() : $('#slider img:first');
		
		$active.fadeOut(function() {
			$active.removeClass('active');
			$next.fadeIn().addClass('active');
		});
	}
	
	$(document).ready(function() {
		setInterval('swapImages()', 5000);
	});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25847772-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script></head>

<body>
<div id="wrapper">
<?php include('nav.php'); ?>

 <div id="body">
        <div id="news-feed">
         <!---  FEED -->
        <div class="feed_bg">
          <div class="feed_title_new" >
            <h1>Sept 18, 2011 | UCLA Bruin Bash 2011 Photos BATCH 2</h1>
            Photos taken at the UCLA Event Bruin Bash 2011.This marks the end of Bruin Bash Photos. If you didn't make it this time. We apologize, look for us at the next UCLA Event! :)</div>
          <div class="feed_button"><a href="gallery.php?album=gallery/events/ucla_events/bruin_bash_2011_2"><img src="images/empty_hover.png" width="110" height="98" border="0"></a></div>
          </div> <br>
        <!---  FEED -->
          <div class="feed_bg">
          <div class="feed_title_new" >
            <h1>Sept 18, 2011 | UCLA Bruin Bash 2011 Photos BATCH 1</h1>
            Photos taken at the UCLA Event Bruin Bash 2011. If you took a photo at our photobooth and it is not showing here, we will be posting more pictures tomorrow. Come back and check it out!</div>
          <div class="feed_button"><a href="gallery.php?album=gallery/events/ucla_events/bruin_bash_2011"><img src="images/empty_hover.png" width="110" height="98" border="0"></a></div>
          </div>
        </div>
        <div id="ads"><script type="text/javascript"><!--
google_ad_client = "ca-pub-7743840430257018";
/* kevnsteph-ad160x600 */
google_ad_slot = "5184961597";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
  </div>
</div>
</body>
</html>
