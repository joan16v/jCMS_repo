<? 

include('../../includes/config.php');

function file_extension($filename) {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

$uploaddir = "../../images/";
$foto_name=limpiar_nombre_foto( basename($_FILES['userfile']['name']) );
$uploadfile = $uploaddir . $foto_name;

$extension=strtolower(file_extension(basename($_FILES['userfile']['name'])));
$array_extensiones=array("jpg","png","jpeg","gif");
if( !in_array($extension,$array_extensiones) ) {
    die("error");
}

$img_name = $_FILES['userfile']['tmp_name'];
$new_name = $foto_name;			
$new_name_path = $uploadfile;
$max_width = 800;
$max_height = 600;
$size=GetImageSize($_FILES['userfile']['tmp_name']);

if (($size[0] > 800) || ($size[1] > 600)) {
	$width_ratio  = ($size[0] / $max_width);
	$height_ratio = ($size[1] / $max_height);
	if($width_ratio >= $height_ratio) {
	   $ratio = $width_ratio;
	} else {
	   $ratio = $height_ratio;
	}
	$new_width    = ($size[0] / $ratio);
	$new_height   = ($size[1] / $ratio);
} else {
	$new_width = $size[0];
	$new_height = $size[1];
}

if( $extension=="jpg" || $extension=="jpeg" ) $src_img = ImageCreateFromJPEG($_FILES['userfile']['tmp_name']);
if( $extension=="gif" ) $src_img = ImageCreateFromGIF($_FILES['userfile']['tmp_name']);
if( $extension=="png" ) $src_img = ImageCreateFromPNG($_FILES['userfile']['tmp_name']); 

if (!$src_img) {
    die("error");
} else {
	$thumb = ImageCreateTrueColor($new_width,$new_height);
	ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
	ImageJPEG($thumb,$new_name_path);
	ImageDestroy($src_img);
	ImageDestroy($thumb);
	chmod($uploadfile, 0777);
    echo $foto_name;
}			

?>