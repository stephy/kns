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
						 if($("#full_view").is(":visible"))
						 	move_full_view();
						 move_wrapper();
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
			  $("#full_view").append(bodytxt);
			  $("#fv_loading").hide();
		  }
	);
}

function hide_fv_on_click_outside(event)
{
	var fullview = $($("#full_view").get(0));
	if($("#full_view").is(":visible"))
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
}

function move_full_view()
{
	var win_width = window.innerWidth;
	var win_height = window.innerHeight;
	var box_height = Math.min(800, win_height, (win_width - 50) / 3 * 2);
	var box_width = Math.min(1250, win_width, win_height / 2 * 3 + 50);
	var left_margin = Math.max(0, (win_width - box_width) / 2) + window.pageXOffset;
	var top_margin = Math.max(0, (win_height - box_height) / 2) + window.pageYOffset;
	
	$("#full_view")
	.css("left", left_margin + "px")
	.css("top", top_margin + "px")
	.css("height", box_height + "px")
	.css("width", box_width + "px");
}

function show_full_view()
{
	$("body").css("overflow", "hidden");
	$("#wrapper").css("opacity", ".3");
	
	move_full_view();
	$("#full_view").css("visibility", "visible");
}

function hide_full_view()
{
	$("body").css("overflow", "");
	$("#wrapper").css("opacity", "1");
	$("#full_view").css("visibility", "hidden");
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