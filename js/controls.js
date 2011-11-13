// JavaScript Document
$('document').ready(function(){
	
	//kevin deng content controls
	$('#kevin-deng').click(function(){
		$('#kevin-deng-content').fadeIn('slow');
		$('#kevin-deng').css('opacity', '1');
		$('#stephani-alves-content').hide();
		$('#stephani-alves').hide();
	});
	
	$('#kevin-deng-content').click(function(){
		$('#kevin-deng-content').hide();
		$('#kevin-deng').css('opacity', '0.4');
		$('#stephani-alves-content').hide();
		$('#stephani-alves').show();
	});
	
	//stephani alves content controls
	$('#stephani-alves').click(function(){
		$('#stephani-alves-content').fadeIn('slow');
		$('#stephani-alves').css('opacity', '1');
		$('#kevin-deng-content').hide();
		$('#kevin-deng').hide();
	});
	
	$('#stephani-alves-content').click(function(){
		$('#stephani-alves-content').hide();
		$('#stephani-alves').css('opacity', '0.4');
		$('#kevin-deng-content').hide();
		$('#kevin-deng').show();
	});
	
	
	//controls for thumbs
	$(".thumb").fadeTo("fast", 0.6);
        $(".thumb").hover(function() {
            $(this).fadeTo("fast", 1.0);
        }, function() {
            $(this).fadeTo("fast", 0.6);
        });
		
	$(".thumb_photo").fadeTo("fast", 0.6);
        $(".thumb_photo").hover(function() {
            $(this).fadeTo("fast", 1.0);
        }, function() {
            $(this).fadeTo("fast", 0.6);
        });
});