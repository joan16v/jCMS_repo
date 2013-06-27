<?
        $fuente = @imagecreatefromjpeg(str_replace(" ","%20",$_GET[foto])); 
        $imgAncho = imagesx($fuente); 
        $imgAlto = imagesy($fuente);
        $border = 10;
        $max_an=395;
        $max_al=296;
        $x=$imgAncho;
        $y = $imgAlto;
        if($imgAncho>$max_an || $imgAlto > $max_al){
		if ($imgAlto>=$imgAncho) { // por si la foto es vertical
			$y = $max_al;
			$ratio= $y/$imgAlto;
			$x = $imgAncho*$ratio;
			if ($x>$max_an){
				$x1=$max_an;
				$ratio= $x1/$x;
				$y1 = $y*$ratio;
				$x=$x1;
				$y=$y1;
			}
		} else {
			$x = $max_an;	
			$ratio= $x/$imgAncho;
			$y = $imgAlto*$ratio;
			if ($y>$max_al){
				$y1=$max_al;
				$ratio= $y1/$y;
				$x1 = $x*$ratio;
				$x=$x1;
				$y=$y1;
			}
		}
		}
        $cambasAncho=$x+$border;
        $cambasAlto=$y+$border;
				
		$cambas=imagecreatetruecolor($cambasAncho,$cambasAlto);
		$blanco=imagecolorallocate($cambas,255,255,255);
		
		imagefill($cambas,0,0,$blanco);
		$xCambasI=(int)(($cambasAncho-$x)/2);
		$yCambasI=(int)(($cambasAlto-$y)/2);
		
	/*	$gris_oscuro=imagecolorallocate($cambas,55,55,55);
		Imageline($cambas,2,2,102,2,$gris_oscuro);
		Imageline($cambas,102,2,102,102,$gris_oscuro);
		Imageline($cambas,2,102,102,102,$gris_oscuro);
		Imageline($cambas,2,102,2,2,$gris_oscuro);*/
		
       // $imagen = imagecreatetruecolor($x-1,$y-1);
        ImageCopyResampled($cambas,$fuente,$xCambasI,$yCambasI,0,0,$x,$y,$imgAncho,$imgAlto); 
        header("Content-type: image/jpeg"); 
        imageJpeg($cambas,"",100); 
?>
