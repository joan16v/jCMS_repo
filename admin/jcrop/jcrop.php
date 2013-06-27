<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//$targ_w = $targ_h = 150;
    $targ_w=    $_POST['w'];
    $targ_h=    $_POST['h'];
	$jpeg_quality = 90;

	$src = "../".$_POST['fichero'];
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

    ?>
    <html>
    <head>
    <title>Subir fotos al servidor</title>
    <link rel="stylesheet" href="admin_style.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <script type='text/javascript' src='../js/jquery.min.js'></script>
    
    </head>
    <body>
    
    <div style="margin: 20px;">
        <h1>Subir fotos al servidor con jQuery CROP (beta)</h1>    
        
        <div>Foto subida con �xito.</div>
        
        <div>
            <img src="<? echo $src; ?>" />
        </div>
        
        <div>
            <input type="button" value="OK" onclick="window.location='../index.php'" />
        </div>
        
    </div>    
    </body>
    </html>            
    <?
	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);

	exit;
}

?>