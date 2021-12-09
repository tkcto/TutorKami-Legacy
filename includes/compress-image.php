<?php
function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
{

if($ext=="jpg" || $ext=="jpeg" )
{
$src = imagecreatefromjpeg($uploadedfile);
}
else if($ext=="png")
{
$src = imagecreatefrompng($uploadedfile);
}
else if($ext=="gif")
{
$src = imagecreatefromgif($uploadedfile);
}
else
{
$src = imagecreatefrombmp($uploadedfile);
}

list($width,$height)=getimagesize($uploadedfile);
$newheight=($height/$width)*$newwidth;
//$tmp=imagecreatetruecolor($newwidth,$newheight);
$thisHeight = '400';
//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
if($height > $width){
	$tmp=imagecreatetruecolor('210','260');
	imagecopyresampled($tmp,$src,0,0,0,0,'210','260',$width,$height);
	$filename = $path.$actual_image_name; 
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
}else{
	$tmp=imagecreatetruecolor('260','210');
	imagecopyresampled($tmp,$src,0,0,0,0,'260','210',$width,$height);
	$filename = $path.$actual_image_name; 
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
}

return $filename;
}
?>