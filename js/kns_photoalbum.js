/********************************************
*              Initialization
*********************************************/

$(document).ready(
	function()
	{
		moveWrapper();
		
		$("#fv_close").click(hideFullview);
		
		$(".thumb_img").live("click", thumbnailClick);
		
		$("#link_button").click(linkButtonClick);
			
		$("#fv_top_ad").click(
			function(event) 
			{ 
				event.stopPropagation(); 
			});
		
		$(window).resize(
			function(event) 
			{
				if($("#full_view").is(":visible"))
					moveFullview();
				moveWrapper();
				moveFullviewNavigation();
			});
			
		$(document).bind("click", clickOutsideToHideFullview);
		
		var img = getUrlParameter('img');
		if(img != "")
		{
			var f = getUrlParameter('album') + "/" + img;
			f = replaceAll(f, "/", "%2F");
			loadAndShow(f);
		}	
	});

function replaceAll(string, searchTerm, replacement)
{
	var j = string.replace(searchTerm, replacement);
	var k = j.replace(searchTerm, replacement);
	if(j != k)
		return replaceAll(k, searchTerm, replacement);
	else
		return k;
}



/********************************************
*              Positioning
*********************************************/

function moveFullviewNavigation()
{
	var bt_width = $(".fv_nav").width();
	var bt_height = $(".fv_nav").height();
	
}

function moveInitload()
{
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	
 	var initload = $("#initload");
	initload
	.css("left", (win_width - initload.width())/2)
	.css("top", (win_height - initload.height())/2);
}

function moveFullview()
{
	var w = 500;
	var h = 500;
	
	var fv_pic = $("#fv_pic");
	if(fv_pic != null)
	{
		w = fv_pic.attr("w");
		h = fv_pic.attr("h");
	}
	
	var r = w / h;
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	var box_height = Math.min(h, win_height - 100, (win_width - 50) / r);
	var box_width = Math.min(Math.max(w + 50, 950), win_width, Math.max(box_height * r + 50, 950));
	var left_margin = Math.max(0, (win_width - box_width) / 2);
	var top_margin = Math.max(100, (win_height - box_height) / 2);
	
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
	
	fv_pic.height(box_height);
	fv_pic.css("left", (box_width - 50 - box_height * r) / 2);
}

function moveWrapper()
{
	var win_width = window.innerWidth;
	var box_width = $("#gallery-wrapper").width();
	var left_margin = Math.max(0, (win_width - box_width) / 2) + 10;
	
	$("#gallery-wrapper")
	.css("left", left_margin + "px");
}

	
	
/********************************************
*              Display
*********************************************/

function linkButtonClick(event)
{
	$("#link_url_tb").toggle(150);
	if($("#link_url_tb").is(":visible"))
	{
		$("#link_url_tb").get(0).select();
		if(window.clipboardData)
			var r = clipboardData.setData('Text',$("#link_url_tb").text());  
	}
}

function clickOutsideToHideFullview(event)
{
	var topAd = $("#fv_topAd");
	if(topAd.is(":visible"))
	{
		var left = topAd.offset().left;
		var right = left + topAd.width();
		var top = topAd.offset().top;
		var bottom = top + topAd.height();
		
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
	
	var fullview = $("#full_view");
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
		   hideFullview();
		   
		event.stopPropagation();
	}
}

function showFullview()
{
	moveFullview();
	$("#full_view").fadeIn('fast');
	
	$("body").css("overflow", "hidden");
	$("#gallery-wrapper").css("opacity", ".2");
	$("#header").css("opacity", "0");
	
	var ad = $("#fv_top_ad_iframe");
	ad.get(0).contentWindow.location.replace( ad.attr("src") + "?time=" + new Date().getTime());
	ad.load(function(event) {
	 	$("#fv_top_ad").fadeIn();
	});
	
	$(".thumb_img").css("cursor", "default");
	
	$("#link_url_tb").hide();
}

function hideFullview()
{
	$("body").css("overflow", "");
	$("#gallery-wrapper").css("opacity", "1");
	$("#header").css("opacity", "1");
	$("#full_view").fadeOut("fast");
	$("#fv_top_ad").fadeOut("fast");
	$(".thumb_img").css("cursor", "pointer");
}




/********************************************
*         Full view image loading
*********************************************/

function thumbnailClick(event)
{
	if(!$("#full_view").is(":visible"))
	{
		loadAndShow($(event.target).attr("id"));
		event.stopImmediatePropagation();
		event.stopPropagation();
	}
}

function loadAndShow(url)
{
	$("#fv_pic").remove();
	
	moveInitload();
	$("#initload").fadeIn('fast');
	
	$.get(
		  "fvimage.php",
		  {"url": url},
		  function(bodytxt, status, xhr)
		  {
			  var href = document.location.href;
			  var end = Math.max(href.indexOf("&"));
			  href = href.substring(0, end < 0 ? href.length : end);
			  var fname = url.substring(url.lastIndexOf("%2F") + 3);
			  $("#link_url_tb").text(href + "&img=" + fname);
			  
			  $("#fv_pic_div").append(bodytxt);
			  $("#fv_pic").hide();
			  $("#initload").hide();
			  $("#fv_loading").show();
			  showFullview();
			  //moveFullview();
			  $("#fv_pic").load(function(event)
			  	{
					$("#fv_loading").hide();
					$("#fv_pic").fadeIn();
					//moveFullview();
				});
		  }
	);
}

function getUrlParameter(name)
{
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.href);
	if(results == null)
	return "";
	else
	return results[1];
}

