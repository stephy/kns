<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META NAME="TITLE" CONTENT="Photographers in Los Angeles." > 
<META NAME="DESCRIPTION" CONTENT="Best Photographers in Los Angeles.  Wedding Photography, Professional Portrait, Family Portraits, Landscape, indoor and outdoor events. ">

<META NAME="KEYWORDS" CONTENT="wedding, photography, photographers, good photographers, cheap, affordable, los angeles, california, photo, picture, portrait, landscape, canon, camera, pic, pix, photoshop, kevin, deng, chao, stephani, moroni, alves, stephani Alves, kevin Deng, Chao Deng, retouching"> 

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Contact Us | Phographers in Los Angeles Kevin Deng and Stephani Alves</title>

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
    <div id="slider">
    <img src="images/slide_show/profile_pics_kev_steph.jpg" class="active">
    <img src="images/slide_show/slide_kevin.jpg" >
    <img src="images/slide_show/slide_stephani.jpg" >
	</div>
    <div id="body">
        <div id="news-feed">
          <h1>Event Coverage</h1>
            If you have an upcoming event in Los Angeles and would like us to cover it, feel free to send us an email at contact@kevnsteph.com. Rates are negotiable depending on the nature of the event.<br>
          <h1>Prints</h1>
            <p>See something you like? We sell custom-made prints of most of our pictures in various sizes. Send us an email at contact@kevnsteph.com.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><br>
            </p>
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
