<?php

    /* Configuraciones varias */
    /*totales del thumb*/
	$cambasAncho=100;
    $cambasAlto=100;
    $desp=round($cambasAncho/2);
    //$desp=30;
    /*totales de la foto dentro del thumb*/ 
    $max_an=100;
    $max_al=100;
    /* color de fondo */
    $colorfondo=Array();
    $colorfondo['R']=255;
    $colorfondo['G']=255;
    $colorfondo['B']=255;
    /* Borde en el limite de la imagen */
    $conborde=false;
    /* Color del borde */
    $colorborde=Array();
    $colorborde['R']=255;
    $colorborde['G']=255;
    $colorborde['B']=255;
	/* path de imagen no encontrada o error */
	$no_encontrada="images/nofoto.gif";		
	$foto=(isset($_GET['foto']))?($_GET['foto']):("");
	$posicion = strrpos($_GET['foto'],'.')+1;
	$extension =  substr($_GET['foto'],$posicion);
	$fuente ="";
	if (!file_exists($foto)){ $foto=$no_encontrada; }
	if ($foto==""){ $foto=$no_encontrada; }
	$posicion = strrpos($foto,'.')+1;
	$extension =  substr($foto,$posicion);
	$fuente ="";
	switch(strtolower($extension)){
		case "jpeg":
		case "jpg":	
			$fuente = @imagecreatefromjpeg($foto);
			break;
		case "gif": 
			$fuente = @imagecreatefromgif($foto);
			break;
		case "png": 
			$fuente = @imagecreatefrompng($foto);
			break;
		default: break;
	}       
    $imgAncho = imagesx($fuente); 
    $imgAlto = imagesy($fuente);    
	//esta linea solo sirve si los thumbs son cuadrados
	$z = ($imgAncho>$imgAlto)?($imgAlto):($imgAncho);		
	$cambas=imagecreatetruecolor($cambasAncho,$cambasAlto);
	$fondo=imagecolorallocate($cambas,$colorfondo['R'],$colorfondo['G'],$colorfondo['B']);		
	imagefill($cambas,0,0,$fondo);
	$xCambasI=(int)(($cambasAncho-$max_an)/2);
	$yCambasI=(int)(($cambasAlto-$max_al)/2);
	if($conborde){
		$borde=imagecolorallocate($cambas,$colorborde['R'],$colorborde['G'],$colorborde['B']);
		Imageline($cambas,0,0,$cambasAncho-1,0,$borde);
		Imageline($cambas,$cambasAncho-1,0,$cambasAncho-1,$cambasAlto-1,$borde);
		Imageline($cambas,0,$cambasAncho-1,$cambasAncho-1,$cambasAlto-1,$borde);
		Imageline($cambas,0,$cambasAncho-1,0,0,$borde);
	}		
    ImageCopyResampled($cambas,$fuente,$xCambasI,$yCambasI,$desp,0,$max_an,$max_al,$z,$z); 
    header("Content-type: image/jpeg"); 
    imageJpeg($cambas,"",100); 
        
?>