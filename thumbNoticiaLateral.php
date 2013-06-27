<?php

include('include/constants.php');

$fuente = @imagecreatefromjpeg($_GET[foto]);
$imgAncho = imagesx($fuente);
$imgAlto = imagesy($fuente);
$prop = $imgAncho/$imgAlto;
if ($imgAlto>$imgAncho) { // por si la foto es vertical
	$x = 218*$prop;
	$y = "218";
} else {
	$x = "218";
	$y = 218/$prop;
}
$imagen = imagecreatetruecolor($x,$y);
ImageCopyResampled($imagen,$fuente,0,0,0,0,$x,$y,$imgAncho,$imgAlto);
header("Content-type: image/jpeg");
imageJpeg($imagen,"",100);
        
?>