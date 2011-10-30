/********************************************
*              Initialization
*********************************************/

$(document).ready(
	function()
	{
		moveWrapper();
		$("#fv_close").click(hideFullview);
		$(".thumb_img").live("click", thumbnailClick);
		$("#fv_topAd").click(
			function(event2) 
			{ 
				event2.stopPropagation(); 
			});
		
		$(window).resize(
			function(event) 
			{
				moveFullview();
				moveWrapper();
				moveFullviewNavigation();
			});
			
		$(document).bind("click", clickOutsideToHideFullview);
		
		var img = getUrlParameter('img');
		if(img != "")
		{
			var f = getUrlParameter('album') + "/" + img;
			loadAndShow(f);
		}	
	});



/********************************************
*              Positioning
*********************************************/

function moveFullviewNavigation()
{
	var bt_width = $(".fv_nav").width();
	var bt_height = $(".fv_nav").height();
	
}

function moveFullview()
{
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	var box_height = Math.min(683, win_height - 100, (win_width - 50) / 3 * 2);
	var box_width = Math.min(1074, win_width, box_height / 2 * 3 + 50);
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
	$("#fv_pic").css("left", (box_width - 50 - $("#fv_pic").width()) / 2);
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
	$("body").css("overflow", "hidden");
	$("#gallery-wrapper").css("opacity", ".4");
	$("#wrapper").css("opacity", "0");

	moveFullview();
	$("#full_view").show();
	
	var ad = $("#fv_top_ad_iframe");
	ad.get(0).contentWindow.location.replace( ad.attr("src") + "?time=" + new Date().getTime());
	ad.load(function(event) {
	 	$("#fv_top_ad").show();
	});
	
	$(".thumb_img").css("cursor", "default");
}

function hideFullview()
{
	$("body").css("overflow", "");
	$("#gallery-wrapper").css("opacity", "1");
	$("#wrapper").css("opacity", "1");
	$("#full_view").hide();
	$("#fv_top_ad").hide();
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
	$("#fv_loading").show();
	showFullview();
	loadFullviewImage(url);
}

function loadFullviewImage(url)
{
	$.get(
		  "fvimage.php",
		  {"url": url},
		  function(bodytxt, status, xhr)
		  {
			  $("#fv_pic_div").append(bodytxt);
			  $("#fv_loading").hide();
			  $("#fv_pic").hide();
			  $("#fv_pic").load(function(event)
			  	{
					moveFullview();
					$("#fv_pic").show();
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

