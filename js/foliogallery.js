// init
$(document).ready(function(event)
	{
		$("#fs_scroll_down").click(function(event)
			{
				FilmstripScroll("down");	
			});
			
		$("#fs_scroll_up").click(function(event)
			{
				FilmstripScroll("up");	
			});
			
		$(".thumb:last").css("margin-bottom", "0px");
		
		$(".thumb:not(.filler)").click(function(event)
			{
				ViewPhoto($(event.target).attr("id"));
			});
		
		$(window).resize(Resize);
		
		Resize();
		
		
		/****************************************
		 *********  loading animation  **********
		 ***************************************/
		var opts = 
		{
		  lines: 12, // The number of lines to draw
		  length: 12, // The length of each line
		  width: 20, // The line thickness
		  radius: 10, // The radius of the inner circle
		  color: '#FF0', // #rgb or #rrggbb
		  speed: 1.0, // Rounds per second
		  trail: 60, // Afterglow percentage
		  shadow: false // Whether to render a shadow
		};
		var target = $("#loading").get(0);
		var spinner = new Spinner(opts).spin(target);
		
		// load first pic
		ViewPhoto($(".thumb:not(.filler):first").children().attr("id"));
	});

// resize
function Resize(event)
{
	var win_w = window.innerWidth;
	var win_h = window.innerHeight - 100;
	
	var box_h = Math.min(Math.max(600, win_h), 1185) - 10;
	//console.log(win_w + " , " + win_h);
	
	$("#filmstrip_wrap").height(box_h);
	$("#viewer").height(box_h);
	
	PositionFullPic();
}


// view img
var currentPic = "";

function ViewPhoto(fname)
{
	if(currentPic == fname)
		return;
	else
		currentPic = fname;
	
	$("#fv_pic").fadeOut("slow");
	$("#loading").fadeIn("slow");
	
	$.get(
		"fvimage.php",
		{"url": fname},
		function(bodytxt, status, xhr)
		{
			$("#fv_pic").remove();
			$("#viewer").append(bodytxt);
			
			$("#fv_pic").ready(function(event)
				{
					$("#fv_pic").hide();
					PositionFullPic();	
				});
			
			$("#fv_pic").load(function(event)
				{
					$("#loading").fadeOut("fast");
					$("#fv_pic").fadeIn("slow");
				});
		}
	);
}

function PositionFullPic()
{
	var fvp = $("#fv_pic");
	
	var h = fvp.attr("h");
	var w = fvp.attr("w");
	var ratio = w / h;
	
	var box_h = $("#viewer").height();
	var box_w = $("#viewer").width();
	
	var new_h = ratio >= 1 ? box_w / ratio : box_h;
	var new_w = ratio >= 1 ? box_w : box_h * ratio;
	
	var left = (box_w - new_w) / 2;
	var top = (box_h - new_h) / 2; 
	
	fvp.css({
		"width" : new_w,
		"height" : new_h,
		//"left" : left,
		"margin-top" : top
	});
}

// scroll
function FilmstripScroll(direction)
{
	var fs = $("#filmstrip");
	
	var fs_h = fs.height();
	var fs_w = fs.width();
	var fs_scr = fs.scrollTop();
	
	var vis_thumbs = Math.floor((fs_h + 5) / 205);
	var scroll_amt = vis_thumbs * 205;
	//console.log(vis_thumbs + ", " + scroll_amt);
	
	if($(".filler:first").offset().top <= fs.offset().top + fs_h + 6
			&& direction == "down")
		scroll_amt = 0;
	
	fs.animate(
		{scrollTop: (direction == "down" ? "+=" : "-=") + scroll_amt}, 
		{duration: 1000, easing: "easeInOutCubic"} 
	);
}