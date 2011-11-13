<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="css/foliogallery.css" rel="stylesheet" type="text/css">

<script language="javascript" src="js/jquery-1.6.1.min.js"></script>
<script language="javascript" src="js/foliogallery.js"></script>
<script language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script language="javascript" src="js/spin.js"></script>

</head>

<body>

<div id="wrapper">

    <div id="filmstrip_wrap">
        <div class="filmstrip_scroll" id="fs_scroll_up"></div>
        <div id="filmstrip">
        <?php
        
        include "./utils.php";
		
		$dir = "";
		if (isset($_GET["album"])) 
		   $dir = urldecode($_GET["album"]);
		else 
		{
		   echo "Album not found!";
		   die(mysql_error());
		}
		
        $files = Utils::list_files_full_path("$dir/thumbs/");
        foreach($files as $key => $value)
        {
            $pi = pathinfo($value);
            $fname = $pi["basename"];
            $img_field = Utils::make_img_tag($value, "thumb_img", urlencode("$dir/$fname"), 200);
            
            echo Utils::make_div($img_field, "thumb", "thumb$key");
        }
        for($i = 0; $i < 6; $i++)
            echo Utils::make_div("", "thumb filler", "");
        
        ?>
        </div>
        <div class="filmstrip_scroll" id="fs_scroll_down"></div>
    </div>
    
    <div id="viewer">
    	<div id="loading"></div>
    </div>

</div>


</body>
</html>