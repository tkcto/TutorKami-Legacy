<?php
/*
 * PHP function to resize an image maintaining aspect ratio
 * http://salman-w.blogspot.com/2008/10/resize-images-using-phpgd-library.html
 *
 * Creates a resized (e.g. thumbnail, small, medium, large)
 * version of an image file and saves it as another file
 */

define('THUMBNAIL_IMAGE_MAX_WIDTH', 250);
define('THUMBNAIL_IMAGE_MAX_HEIGHT', 250);

function generate_image_thumbnail($source_image_path, $thumbnail_image_path)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
    } else {
        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}

define('THUMBNAIL_IMAGE_MAX_WIDTH_TESTI', 360);
define('THUMBNAIL_IMAGE_MAX_HEIGHT_TESTI', 600);
function generate_image_thumbnail_testi($source_image_path, $thumbnail_image_path)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH_TESTI / THUMBNAIL_IMAGE_MAX_HEIGHT_TESTI;
    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH_TESTI && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT_TESTI) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT_TESTI * $source_aspect_ratio);
        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT_TESTI;
    } else {
        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH_TESTI;
        $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH_TESTI / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}
/*
 * Uploaded file processing function
 */

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
 // https://medium.com/thetiltblog/fixing-rotated-mobile-image-uploads-in-php-803bb96a852c
function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}



define('UPLOADED_IMAGE_DESTINATION', './../fadhli/testimage/images/');
define('THUMBNAIL_IMAGE_DESTINATION', './../fadhli/testimage/thumbnails/');

define('THUMBNAIL_IMAGE_DESTINATION2', './../images/profile/');
define('THUMBNAIL_IMAGE_DESTINATION3', './../images/testimonial/');



function process_image_upload($field, $namaFile)
{
    $temp_image_path = $_FILES[$field]['tmp_name'];
    $temp_image_name = $_FILES[$field]['name'];
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
    switch ($temp_image_type) {
        case IMAGETYPE_GIF:
            break;
        case IMAGETYPE_JPEG:
            break;
        case IMAGETYPE_PNG:
            break;
        default:
            return false;
    }
 
if(isMobile()){
    $deviceType = 'mobile';
}
else {
    $deviceType = 'desktop';
}
/*   
    //$uploaded_image_path = UPLOADED_IMAGE_DESTINATION . $namaFile;
    $uploaded_image_path = UPLOADED_IMAGE_DESTINATION .$deviceType.'-' . preg_replace('{\\.[^\\.]+$}', '.jpg', $namaFile);
    move_uploaded_file($temp_image_path, $uploaded_image_path);
correctImageOrientation($uploaded_image_path);
    $thumbnail_image_path = THUMBNAIL_IMAGE_DESTINATION .$deviceType.'-' . preg_replace('{\\.[^\\.]+$}', '.jpg', $namaFile);
    $result = generate_image_thumbnail($uploaded_image_path, $thumbnail_image_path);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
*/

    $uploaded_image_path = UPLOADED_IMAGE_DESTINATION .$deviceType.'-' . $namaFile.'.jpg';
    move_uploaded_file($temp_image_path, $uploaded_image_path);
correctImageOrientation($uploaded_image_path);
    $thumbnail_image_path = THUMBNAIL_IMAGE_DESTINATION2 . $namaFile.'.jpg';
    $result = generate_image_thumbnail($uploaded_image_path, $thumbnail_image_path);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
    
    
    
    
    
}


function process_image_upload_testi($field, $namaFile){
    $temp_image_path = $_FILES[$field]['tmp_name'];
    $temp_image_name = $_FILES[$field]['name'];
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
    switch ($temp_image_type) {
        case IMAGETYPE_GIF:
            break;
        case IMAGETYPE_JPEG:
            break;
        case IMAGETYPE_PNG:
            break;
        default:
            return false;
    }
 
if(isMobile()){
    $deviceType = 'mobile';
}
else {
    $deviceType = 'desktop';
}
    $uploaded_image_path = UPLOADED_IMAGE_DESTINATION .$deviceType.'-' . $namaFile.'.jpg';
    move_uploaded_file($temp_image_path, $uploaded_image_path);
    correctImageOrientation($uploaded_image_path);
    $thumbnail_image_path = THUMBNAIL_IMAGE_DESTINATION3 . $namaFile.'.jpg';
    $result = generate_image_thumbnail_testi($uploaded_image_path, $thumbnail_image_path);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

?>