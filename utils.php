<?php

class Utils
{
	static function list_files_full_path($dir)
	{
		if (is_dir($dir))
		{
			if ($dh = opendir($dir))
			{
				$array = array(0 => "lol");
				$i = 0;
				
				while (($file = readdir($dh)) !== false) 
				{
					$full_path = $dir . "/" . $file;
					if(!is_dir($full_path))
					{
						$path_parts = pathinfo($full_path);
						$extension =  $path_parts['extension'];
						
						if(in_array($extension, explode("|", "jpg|png|gif")))
						{
							$array[$i] = $full_path;
							$i++;
						}
					}
				}
				
				closedir($dh);
				//sort($array);
				return $array;
			}
		}	
	}
	
	static function make_img_tag($path, $class, $id, $height)
	{
		$img_sz = getimagesize($path);
		$display_width = $img_sz[0] / $img_sz[1] * $height;
		return "<img src=\"$path\" class=\"$class\" id=\"$id\" width=\"$display_width\" height=\"$height\" />";
	}
	
	static function make_div($contents, $class, $id)
	{
		$id_attr = empty($id) ? "" : "\"id=$id\"";
		return "<div class=\"$class\" $id_attr >$contents</div>";	
	}
	
	static function make_a($contents, $src)
	{
		return "<a href=\"$src\">$contents</a>";	
	}
}

// http://www.white-hat-web-design.co.uk/blog/resizing-images-with-php/
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}

?>