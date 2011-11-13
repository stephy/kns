
<?php

$page_title = "";

if(isset($_GET["album"])){
	$page_title = $_GET["album"];
	$page_title = preg_replace('/\//', ' > ', $page_title);
	$page_title = preg_replace('/\_/', ' ', $page_title);
	$page_title = ucwords($page_title);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_title; ?></title>

<link href="css/kns_photoalbum_style.css" rel="stylesheet" type="text/css">
<link href="css/navigation.css" rel="stylesheet" type="text/css">
<link href="css/master.css" rel="stylesheet" type="text/css">

<script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script language="javascript" src="js/kns_photoalbum.js"></script>

</head>

<body>


<div id="fv_top_ad">
<iframe id="fv_top_ad_iframe" src="fvtopad.php"></iframe>
</div>

<div id="full_view">
	<div class="fv_nav" id="next"></div>
	<div class="fv_nav" id="prev"></div>

	<div id="fv_close">
    	<div class="fv_close_cross" id="cross1"></div>
        <div class="fv_close_cross" id="cross2"></div>
    </div>
    
    <div id="link_button">
    	<img src="images/link.png" />
    </div>
    
    <div id="link_url">
    	<textarea id="link_url_tb" readonly="readonly"></textarea>
    </div>
    
    <div id="fv_loading">
    	<img src="images/ajax-loader.gif" />
    </div>
    
    <div id="fv_pic_div">
    	<!--<img id="fv_pic" src="photos/events/bruinbash2011/IMG_9486.jpg"/>-->
    </div>
</div>

<div id="gallery-wrapper">

<div id="wrapper">
	<?php include "./navigation.php";?>
    <h1><?php ;
	echo $page_title;
	?></h1>
</div>

<!--<button onclick="javascript: lol();">TEST</button> -->

<?php

include "./utils.php";

$thumb_height = 300;

$dir = "";
if (isset($_GET["album"])) 
   $dir = urldecode($_GET["album"]);
else {
   echo "Album not found!";
   die(mysql_error());
}
	
if(is_dir($dir) && !is_dir("$dir/thumbs"))
{
	mkdir("$dir/thumbs");
}

$files = Utils::list_files_full_path($dir);
foreach($files as $key => $value)
{
	$pi = pathinfo($value);
	$fname = $pi["basename"];
	$thumb_fname = "$dir/thumbs/$fname";
	if(!file_exists($thumb_fname))
	{
		$thumb = new SimpleImage();
		$thumb->load($value);
		$thumb->resizeToHeight($thumb_height);
		$thumb->save("$dir/thumbs/$fname", IMAGETYPE_JPEG, 90, null);
	}
	
	$extra_class = "";
	$thumb_sz = getimagesize($thumb_fname);
	if($thumb_sz[0]/$thumb_sz[1] < 3/2 - 0.1)
		$extra_class = " vertical_thumb_box";
		
	$img_field = Utils::make_img_tag($thumb_fname, "thumb_img", urlencode("$value"), $thumb_height);
	//$full_img_field = Utils::make_img_tag($value, "full_img", "img_full$key", 800);
	//$link = Utils::make_a($img_field, "javascript: show_full_view();");
	echo Utils::make_div($img_field, "thumb_box$extra_class", "div$key");
}


?>

<div id="gallery-footer">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7743840430257018";
/* Kevnsteph Gallery-footer */
google_ad_slot = "8288854535";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>

</div>

</body>
</html>