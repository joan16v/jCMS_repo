<? 

include('../../includes/config.php');

function file_extension($filename) {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE) {
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
    }
    return $rstr;
}

$uploaddir = "../../images/";
$foto_name=RandomString() . "_" . limpiar_nombre_foto( basename($_FILES['userfile']['name']) );
$uploadfile = $uploaddir . $foto_name;

$extension=strtolower(file_extension(basename($_FILES['userfile']['name'])));
$array_extensiones=array("jpg","png","jpeg","gif");
if( !in_array($extension,$array_extensiones) ) {
    exit(0);
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

//if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  //@chmod($uploadfile,0777);
  //echo "success";
  //echo $foto_name;
  
//} else {
  //echo "error";
//}

?>