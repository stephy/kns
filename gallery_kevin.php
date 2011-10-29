<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">

body
{
	background-image: url(./images/body-background.jpg);
	background-repeat: repeat;	
}

img
{
	border: hidden;
	border-size: 0px;	
}

#wrapper
{
	position: absolute;
	top: 0px;
	left: 200px;
	width: 920px;
}

#full_view
{
	visibility: hidden;
	margin: auto;
	width: 1250px;
	height: 800px;
	position: fixed;
	background: #111;
	z-index: 100;
}

#fv_loading
{
	font-size: 26px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;	
	color: #FFF;
	width: 100%;
	text-align: center;
	position: absolute;
	top: 45%
}

#fv_pic
{
	position: absolute;
	left: 0px;
	top: 0px;	
	height: 100%;
}

#fv_close
{
	position: absolute;
	right: 0px;
	top: 0px;
	width: 50px;
	height: 50px;
	opacity: 0.4;
	cursor: pointer;
}

.fv_close_cross
{
	background: #FFF;
	width: 80%;
	height: 20%;
	position: relative;
	border-radius: 33%;
}

#fv_top_ad
{
	width: 728px;
	height: 90px;
	position: fixed;
	top: 5px;
	background: #CFF;
	z-index: 100;
	display: none;	
}

#cross1
{
	left: 10%;
	top: 40%;
	-webkit-transform: rotate(45deg); 
    -moz-transform: rotate(45deg);  
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=5);		
}

#cross2
{
	left: 10%;
	top: 20%;
	-webkit-transform: rotate(-45deg); 
    -moz-transform: rotate(-45deg);  
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=-5);		
}

#fv_pic_div
{
	position: absolute;
	top: 0px;
	left: 0px;	
}

.fv_nav
{
	width: 60px;
	height: 60px;
	position: absolute;
	left: -80px;
	top: 500px;
	background: #FFF;
	visibility: hidden;
}

.thumb_box
{
	width: 450px;
	height: 300px;
	background: #111;
	text-align: center;
	padding: 3px;
	margin: 2px;
	float: left;
}

.thumb_img
{
	cursor: pointer;	
}

.vertical_thumb_box
{
	background: -webkit-gradient(radial, 50% 10%, 50, 50% 10%, 450, from(#333), to(#000)) #333;
	background: -moz-radial-gradient(50% 10%, circle, #333 50, #000, 450);
}

</style>

<script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script language="javascript">

$(document).ready(init());

$("#wrapper").ready(function(event)
	{
		move_wrapper();
	});
	
$("#fv_close").ready(function(event)
	{
		var fv_close = $($("#fv_close").get(0));
		fv_close.hover( function(event) { fv_close.css("opacity", "1").css("background", "#C00"); },
						function(event) { fv_close.css("opacity", ".4").css("background", ""); } );
		fv_close.click(function(event) { hide_full_view() });
	});
	
$("#fv_top_ad").load(function(event)
	{
		$("#fv_top_ad").click(function(event2) 
			{ 
				alert("HO");
				event2.stopPropagation(); 
			});
	});

function move_wrapper()
{
	var win_width = window.innerWidth;
	var box_width = $("#wrapper").width();
	var left_margin = Math.max(0, (win_width - box_width) / 2);
	
	$("#wrapper")
	.css("left", left_margin + "px")
}

function init()
{
	$(".thumb_img").live("click", function(event) 
		{ 
			$("#fv_pic").remove();
			$("#fv_loading").show();
			show_full_view();
			load_fv_pic(event);
		});
	
	var move_stuff = function(event) 
					 {
						 move_full_view();
						 move_wrapper();
						 move_fv_nav();
						 move_fv_pic();
					 }
	$(document).scroll(move_stuff);
	$(window).resize(move_stuff);
		
	//$("#full_view").click(function(event) { event.stopPropagation() });
	$(document).bind("click", hide_fv_on_click_outside);
}

function load_fv_pic(event)
{
	$.get(
		  "fvimage.php",
		  {"url": $(event.target).attr("id")},
		  function(bodytxt, status, xhr)
		  {
			  //alert(bodytxt);
			  $("#fv_pic_div").append(bodytxt);
			  $("#fv_loading").hide();
			  $("#fv_pic").hide();
			  $("#fv_pic").load(function(event)
			  	{
					move_full_view();
					$("#fv_pic").show();
				});
		  }
	);
}

function hide_fv_on_click_outside(event)
{
	var top_ad = $($("#fv_top_ad").get(0));
	if(top_ad.is(":visible"))
	{
		var left = top_ad.offset().left;
		var right = left + top_ad.width();
		var top = top_ad.offset().top;
		var bottom = top + top_ad.height();
		
		if(event.pageX >= left &&
		   event.pageX <= right &&
		   event.pageY >= top &&
		   event.pageY <= bottom
		  )
		{
			event.stopPropagation();
			return;
		}
	}
	
	var fullview = $($("#full_view").get(0));
	if(fullview.is(":visible"))
	{
		var left = fullview.offset().left;
		var right = left + fullview.width();
		var top = fullview.offset().top;
		var bottom = top + fullview.height();
		
		if(event.pageX < left ||
		   event.pageX > right ||
		   event.pageY < top ||
		   event.pageY > bottom
		  )
		   hide_full_view();
	}
	event.stopPropagation();
}

function move_fv_nav()
{
	var bt_width = $(".fv_nav").width();
	var bt_height = $(".fv_nav").height();
	
}

function move_full_view()
{
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	var box_height = Math.min(800, win_height - 100, (win_width - 50) / 3 * 2);
	var box_width = Math.min(1250, win_width, box_height / 2 * 3 + 50);
	var left_margin = Math.max(0, (win_width - box_width) / 2);
	var top_margin = 100;
	
	$("#full_view")
	.css("left", left_margin + "px")
	.css("top", top_margin + "px")
	.css("height", box_height + "px")
	.css("width", box_width + "px");
	
	// -----------------------------------------------
	
	$("#fv_pic_div")
	.css("width", box_width - 50)
	.css("height", box_height - 0);
	
	// -----------------------------------------------
	
	$("#fv_top_ad")
	.css("left", (win_width - 728) / 2);
	
	// -----------------------------------------------
	
	$("#fv_pic").height(box_height);
	var pic_width = $("#fv_pic").width();
	$("#fv_pic").css("left", (box_width - 50 - pic_width) / 2);
}

function show_full_view()
{
	$("body").css("overflow", "hidden");
	$("#wrapper").css("opacity", ".3");
	
	move_full_view();
	$("#fv_top_ad").show();
	$("#full_view").css("visibility", "visible");
}

function hide_full_view()
{
	$("body").css("overflow", "");
	$("#wrapper").css("opacity", "1");
	$("#full_view").css("visibility", "hidden");
	$("#fv_top_ad").hide();
}

function lol()
{
	$.get("fvimage.php",
		  {"url": encodeURI("photos/events/bruinbash2011/IMG_9538.jpg")},
		  function(bodytxt, status, xhr)
		  {
			  //alert(bodytxt);
			  $("#full_view").remove("#fv_pic");
			  $("#full_view").append(bodytxt);
		  }
		 );
		 
	show_full_view();
}

</script>

</head>




<body>

<div id="fv_top_ad">
	<a href="http://www.google.com" target="_blank"><img src="./images/testad.jpg" /></a>
</div>

<div id="full_view">
	<div class="fv_nav" id="next"></div>
	<div class="fv_nav" id="prev"></div>

	<div id="fv_close">
    	<div class="fv_close_cross" id="cross1"></div>
        <div class="fv_close_cross" id="cross2"></div>
    </div>
    
    <div id="fv_loading">
    	<img src="./images/ajax-loader.gif" />
    </div>
    
    <div id="fv_pic_div">
    	<img id="fv_pic" src="photos/events/bruinbash2011/IMG_9486.jpg"/>
    </div>
</div>

<div id="wrapper">

 <button onclick="javascript: lol();">TEST</button> 

<?php

include "./utils.php";

$thumb_height = 300;

$dir = "./gallery/events/ucla_events/bruin_bash_2011";

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
	if($thumb_sz[0]/$thumb_sz[1] != 3/2)
		$extra_class = " vertical_thumb_box";
		
	$img_field = Utils::make_img_tag($thumb_fname, "thumb_img", urlencode("$value"), $thumb_height);
	//$full_img_field = Utils::make_img_tag($value, "full_img", "img_full$key", 800);
	//$link = Utils::make_a($img_field, "javascript: show_full_view();");
	echo Utils::make_div($img_field, "thumb_box$extra_class", "div$key");
}


?>

</div>

</body>
</html>