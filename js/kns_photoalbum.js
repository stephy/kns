$(document).ready(init());

$("#gallery-wrapper").ready(function(event)
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
	var box_width = $("#gallery-wrapper").width();
	var left_margin = Math.max(0, (win_width - box_width) / 2) + 10;
	
	$("#gallery-wrapper")
	.css("left", left_margin + "px");
}

function init()
{
	$(".thumb_img").live("click", function(event) 
		{ 
			$("#fv_pic").remove();
			$("#fv_loading").show();
			show_full_view();
			load_fv_pic(event);
			event.stopImmediatePropagation();
			event.stopPropagation();
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
	var pic_width = $("#fv_pic").width();
	$("#fv_pic").css("left", (box_width - 50 - pic_width) / 2);
}

function show_full_view()
{
$("body").css("overflow", "hidden");
$("#gallery-wrapper").css("opacity", ".4");
$("#wrapper").css("opacity", "0");
//$("#wrapper").attr("disabled", "disabled");

move_full_view();
$("#full_view").css("visibility", "visible");
$("#fv_top_ad_iframe").get(0).contentWindow.location.replace( $("#fv_top_ad_iframe").attr("src") + "?time=" + new Date().getTime());
$("#fv_top_ad_iframe").load(function(event) {
 $("#fv_top_ad").show();
});
}
function hide_full_view()
{
	$("body").css("overflow", "");
	$("#gallery-wrapper").css("opacity", "1");
	$("#wrapper").css("opacity", "1");
	//$("#wrapper").attr("disabled", "");
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