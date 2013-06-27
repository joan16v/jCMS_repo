<? 

if(isset($_GET['id'])) {
    
    //contenido de la seccion
    $id_seccion=GetSQLValueString($_GET['id'],"int");
    $rowSeccion=mysql_fetch_object(mysql_query("select * from jcms_secciones where id='".$id_seccion."'"));
    $contenido=$rowSeccion->contenido;
    if( $_SESSION["lang_session"]=="EN" ) $contenido=$rowSeccion->contenido_en;
    $contenido=youtube($contenido);
    echo $contenido;
    
    //productos
    if( mysql_num_rows(mysql_query("select * from jcms_productos where id_seccion='".$id_seccion."'"))>0 ) {
        ?><div style="clear: both;"><!-- separador --></div><?
        $sqlP="select * from jcms_productos where id_seccion='".$id_seccion."' order by orden asc";
        $exP=mysql_query($sqlP);
        while( $rowP=mysql_fetch_object($exP) ) {
            
            $nombre_producto=$rowP->nombre;
            if( $_SESSION["lang_session"]=="EN" ) $nombre_producto=$rowP->nombre_en;
             
            ?><div class="contentProducto">
                <div class="fotoProducto">
                    <a href="index.php?id_prod=<? echo $rowP->id; ?>&desc=<? echo url_clean($nombre_producto); ?>"><img src="thumbProd.php?foto=images/<? 
                        if( mysql_num_rows(mysql_query("select * from jcms_productos_imagenes where id_producto='".$rowP->id."'"))>0 ) {
                            echo mysql_result(mysql_query("select imagen from jcms_productos_imagenes where id_producto='".$rowP->id."' order by orden asc limit 1"),0,"imagen");
                        } else {
                            ?>nopic.jpg<?
                        }
                    ?>" /></a>
                </div>
                <div class="nombreProducto">
                    <a href="index.php?id_prod=<? echo $rowP->id; ?>&desc=<? echo url_clean($nombre_producto); ?>"><? echo $nombre_producto; ?></a>
                </div>
            </div><?
        }
    }
    
    //noticias
    if( mysql_num_rows(mysql_query("select * from jcms_noticias where id_seccion='".$id_seccion."'"))>0 ) {
        ?><div style="clear: both;"><!-- separador --></div><?
        $sqlP="select * from jcms_noticias where id_seccion='".$id_seccion."' order by fecha desc";
        $exP=mysql_query($sqlP);
        while( $rowP=mysql_fetch_object($exP) ) {
            
            $nombre_noticia=$rowP->nombre;
            if( $_SESSION["lang_session"]=="EN" ) $nombre_noticia=$rowP->nombre_en;
            
            $desc_noticia=$rowP->descripcion;
            if( $_SESSION["lang_session"]=="EN" ) $desc_noticia=$rowP->descripcion_en;              
            
            ?><div class="contentNoticia">
                <? if( $rowP->imagen!="" ) {
                    ?>
                    <div class="imagenNoticia">
                        <a href="index.php?id_not=<? echo $rowP->id; ?>&desc=<? echo url_clean($nombre_noticia); ?>"><img src="thumbProd.php?foto=images/noticias/<? echo $rowP->imagen; ?>" /></a>
                    </div>                    
                    <?
                } ?>
                <div class="tituloNoticia">
                    <a href="index.php?id_not=<? echo $rowP->id; ?>&desc=<? echo url_clean($nombre_noticia); ?>"><? echo $nombre_noticia; ?></a>
                </div>
                <div class="fechaNoticia">
                    <? $fechaNot=strtotime($rowP->fecha); echo date("d/m/Y",$fechaNot); ?>
                </div>
                <div class="resumenNoticia">
                    <? if( strlen($desc_noticia)>200 ) {
                        echo substr(strip_tags($desc_noticia),0,197)."...";
                    } else {
                        echo strip_tags($desc_noticia);
                    } ?> <a href="index.php?id_not=<? echo $rowP->id; ?>&desc=<? echo url_clean($nombre_noticia); ?>">[+]</a>
                </div>
            </div>
            <div style="clear: both;"><!-- separador noticia --></div><?
        }
    }    
    
}  

if(isset($_GET['id_prod'])) {
    
    //mostrar un producto
    $id_producto=GetSQLValueString($_GET['id_prod'],"int");
    $rowProducto=mysql_fetch_object(mysql_query("select * from jcms_productos where id='".$id_producto."'"));
    
    $nombre_producto=$rowProducto->nombre;
    if( $_SESSION["lang_session"]=="EN" ) $nombre_producto=$rowProducto->nombre_en; 
    
    ?><h1><? echo strtoupper($nombre_producto); ?></h1><?
    
    /* ?><h2><? echo $rowProducto->precio; ?> &euro;</h2><? */
    
    $descripcion=$rowProducto->descripcion;
    if( $_SESSION["lang_session"]=="EN" ) $descripcion=$rowProducto->descripcion_en;
    $descripcion=youtube($descripcion);
    echo $descripcion;
    
    if( mysql_num_rows(mysql_query("select * from jcms_productos_imagenes where id_producto='".$id_producto."'"))>0 ) {
        ?><script type="text/javascript" src="./js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="./js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function() {                	
            	$("a.grouped").fancybox({
            		'transitionIn'	:	'elastic',
            		'transitionOut'	:	'elastic',
            		'speedIn'		:	600, 
            		'speedOut'		:	200, 
            		'overlayShow'	:	true
            	});                	
            });            
        </script><?
        
        if( $_SESSION["lang_session"]=="ES" ) {
            ?><div class="gal_img">Galer&iacute;a de im&aacute;genes</div><?    
        }
        if( $_SESSION["lang_session"]=="EN" ) {
            ?><div class="gal_img">Image gallery</div><?
        }
        
        ?><div class="contenedorImagenesProductos"><?
            $sqlIP="select * from jcms_productos_imagenes where id_producto='".$id_producto."' order by orden asc";
            $exIP=mysql_query($sqlIP);
            while( $rowIP=mysql_fetch_object($exIP) ) {
                ?><div class="imagenProducto">
                    <a class="grouped" rel="gb_imageset" href="images/<? echo $rowIP->imagen; ?>"><img src="./thumbGal.php?foto=images/<? echo $rowIP->imagen; ?>" /></a>
                </div><?
            }        
        ?></div><?
    }    
    
}

if(isset($_GET['id_not'])) {
    
    //mostrar una noticia
    $id_noticia=GetSQLValueString($_GET['id_not'],"int");
    $rowNoticia=mysql_fetch_object(mysql_query("select * from jcms_noticias where id='".$id_noticia."'"));
    
    $nombre_noticia=$rowNoticia->nombre;
    if( $_SESSION["lang_session"]=="EN" ) $nombre_noticia=$rowNoticia->nombre_en; 
    
    ?><h1><? echo ($nombre_noticia); ?></h1><?
    
    ?><h2><? $fechaNot=strtotime($rowNoticia->fecha); echo date("d/m/Y",$fechaNot); ?></h2><?
    
    if( $rowNoticia->imagen!="" ) {
        ?>
        <div style="text-align: center;"><img src="thumbGrande.php?foto=images/noticias/<? echo $rowNoticia->imagen; ?>" /></div>
        <?
    }
    
    $descripcion=$rowNoticia->descripcion;
    if( $_SESSION["lang_session"]=="EN" ) $descripcion=$rowNoticia->descripcion_en; 
    $descripcion=youtube($descripcion);
    echo $descripcion; 
    
}

if(isset($_GET['search'])) {
    
    //busqueda
    if( $_SESSION["lang_session"]=="ES" ) { ?><h1 style="margin-bottom: 20px;">BUSCANDO "<? echo strtoupper($_GET['search']); ?>"</h1><? }
    if( $_SESSION["lang_session"]=="EN" ) { ?><h1 style="margin-bottom: 20px;">SEARCHING "<? echo strtoupper($_GET['search']); ?>"</h1><? }
    
    $search=GetSQLValueString($_GET['search'],"text"); //echo "-".$search."-";
    $sqlSecciones="select * from jcms_secciones where nombre like '%".$search."%' or contenido like '%".$search."%'"; //echo $sqlSecciones;
    if( $_SESSION["lang_session"]=="EN" ) $sqlSecciones="select * from jcms_secciones where nombre_en like '%".$search."%' or contenido_en like '%".$search."%'"; 
    $exSecciones=mysql_query($sqlSecciones);
    while( $rowSecciones=mysql_fetch_object($exSecciones) ) {
        
        $secciones_nombre=$rowSecciones->nombre;
        if( $_SESSION["lang_session"]=="EN" ) $secciones_nombre=$rowSecciones->nombre_en;
        $secciones_contenido=$rowSecciones->contenido;
        if( $_SESSION["lang_session"]=="EN" ) $secciones_contenido=$rowSecciones->contenido_en; 
        
        ?><div style="margin-top: 20px;">
            <div><a style="font-size: 14px; font-weight:bold;" href="index.php?id=<? echo $rowSecciones->id; ?>"><? echo $secciones_nombre; ?></a></div>
            <div style="margin-top: 3px;"><? echo substr( strip_tags($secciones_contenido), 0, 200)."..."; ?></div>
        </div><?
    }
    
}

if( !isset($_GET['id']) && !isset($_GET['id_prod']) && !isset($_GET['id_not']) && !isset($_GET['search']) ) {
    
    if( isset($_GET['seccion']) ) {
        if( $_GET['seccion']=="contacto" ) {
            include("includes/contact.php");
        } else {
            header("Location: index.php");
            exit(0);
        }
    } else {
        //contenido de la seccion index    
        $rowSeccion=mysql_fetch_object(mysql_query("select * from jcms_seccion_index where id=1"));
        $contenido=$rowSeccion->contenido;
        if( $_SESSION["lang_session"]=="EN" ) $contenido=$rowSeccion->contenido_en;
        $contenido=youtube($contenido);
        echo $contenido;            
    }
       
}

?>