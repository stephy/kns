<?php

include "./utils.php";

$file = urldecode($_GET["url"]);
$img = new SimpleImage();
$img->load($file);
$w = $img->getWidth();
$h = $img->getHeight();

echo "<img id=\"fv_pic\" w=\"$w\" h=\"$h\" src=\"" . $file . "\"/>";

?>