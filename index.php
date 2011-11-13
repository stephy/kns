<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META NAME="TITLE" CONTENT="Photographers in Los Angeles." > 
<META NAME="DESCRIPTION" CONTENT="Photography is our passion. We enjoy every step in the process, from lighting, to the camera, to post-production and retouching. We also like to explore all genres of photography, be it indoor or outdoor event coverage, wedding photography, family portraits, landscapes, sports – you name it. You can also find photos of UCLA events ">

<META NAME="KEYWORDS" CONTENT="wedding, photography,ucla events, ucla photos, photographers, good photographers, cheap, affordable, los angeles, california, photo, picture, portrait, landscape, best canon, camera, pic, pix, photoshop, kevin, deng, chao, stephani, moroni, alves, stephani Alves, kevin Deng, Chao Deng, retouching"> 

<title>Phographers in Los Angeles, Kevin and Stephani</title>
<link href="css/master.css" rel="stylesheet" type="text/css">
<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="js/jquery-1.7.min.js" type="text/javascript"></script>
<script src="js/controls.js" type="text/javascript"></script>
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

</script>
</head>

<body>
<div id="wrapper-box">
 <?php include('navigation.php'); ?>
    <div id="content-title">
      <p>&nbsp;</p>
      <p><img src="images/banner-home.png" width="1000" height="182" alt="about us"></p>
    </div>
    
<div id="content">
<div id="slider">
    <img src="images/slide_show/slide_3.jpg" class="active">
    <img src="images/slide_show/slide_4.jpg">
    <img src="images/slide_show/slide_5.jpg">
  </div>

<div id="main-left"><img src="images/kevnsteph.jpg" width="300" height="509" alt="kevin and stephani"></div>
<div id="main-right">
  <p><img src="images/welcome.png" width="339" height="63" alt="welcome!"></p>
  <p>kev<strong>n</strong>steph consists of Kevin Deng &amp; Stephani Alves.</p>
  <p>We are both Computer Science students at UCLA. When we are not writing code, we are skilled digital artists with an especially keen interest in photography.</p>
  <p>Years of engineering training and self-learning has given us considerable dexterity with all manners of technology. We are skilled in the entire imaging process, from the lightning, to the camera, to retouching and post-processing.</p>
  <p>Photography however requires more than technical expertise; it is equally an exercise in artistic expression and creativity, and indeed, it is this blend of art and science that draws us so much to it. The creation of a breathtaking picture is truly a multidisciplinary process, and we enjoy every step along the way.</p>
  <p>We don't restrict ourselves to any particular type of photography. We shoot portraits, events, landscapes, architecture – anything that produces a beautiful photograph. We have each been around the world to take in the sights and sounds, but we certainly don't plan on stopping there – much remains to be explored, and many breathtaking images yet await to be captured.</p>
  <p>Recently we have decided to pool our skills (and equipment) together and collaborate on all our work, and this website is where we shall share the fruits of our labor.</p>
  <p>Our work is still in its early stages, but as time goes by, we hope to fill these pages with images of beauty both familiar and exotic, excitement for young and old alike, and the stirring emotion only a perfectly captured moment in time can bring.</p>
  <p>We hope you enjoy your visit.  </p></div>

</div>
	<div style="clear:both"></div>
</div>
 <?php include('footer.php'); ?>
</body>
</html>
