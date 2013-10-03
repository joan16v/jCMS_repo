<? 

//administracion de jCMS

include('../includes/config.php');

?>
<html>
<head>
<title>jCMS Admin</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="admin_style.css" type="text/css" />
<link rel="shortcut icon" href="../favicon.gif" />

<style>
    body {
        background: url(images/simple-blue-wallpaper.jpg);
    }
    .icono { position: relative; width:64px; height:110px; text-align:center; float:left; margin-right:0px; margin-bottom:0px; }
    .icono img { margin-bottom:3px; border:0px; }    
</style>

</head>
<body>

<? 

if( isset($_GET['mensaje']) ) {
    ?><div style="width: 300px; padding:20px; margin:20px; border:3px solid #61CC02; background:#CCF69E; font-size:20px; font-weight:bold; color:#61CC02;">
        <? 
            switch($_GET['mensaje']) {
                case "add_seccion_ok";
                    echo "Sección añadida con éxito.";
                break;
                case "edit_seccion_ok";
                    echo "Sección modificada con éxito.";
                break;
                case "borrar_seccion_ok";
                    echo "Sección borrada con éxito.";
                break;
                case "add_producto_ok";
                    echo "Producto añadido con éxito.";
                break;
                case "edit_producto_ok";
                    echo "Producto modificado con éxito.";
                break;
                case "borrar_producto_ok";
                    echo "Producto borrado con éxito.";
                break;
                case "add_noticia_ok";
                    echo "Noticia añadida con éxito.";
                break;
                case "edit_noticia_ok";
                    echo "Noticia modificada con éxito.";
                break;                   
                case "borrar_noticia_ok";
                    echo "Noticia borrada con éxito.";
                break;                                   
            }         
        ?>
    </div><?
}

?>

<div style="position:fixed; top:40px; right:40px;">
    <img src="./images/jcms.png" />
</div>  

<div style="margin: 20px;">
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="add_seccion.php"><img src="images/add-icon.png" width="64" height="64" /></a>
        <a href="add_seccion.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Añadir sección</a>
    </div>    
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="edit_seccion.php"><img src="images/edit-icon.png" width="64" height="64" /></a>
        <a href="edit_seccion.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Modificar sección</a>
    </div>
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="borrar_seccion.php"><img src="images/delete-icon.png" width="64" height="64" /></a>
        <a href="borrar_seccion.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Borrar sección</a>
    </div>                  
    
    <div style="clear: both;"><!-- separador --></a></div>
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="add_producto.php"><img src="images/new_prod_icon.png" width="64" height="64" /></a>
        <a href="add_producto.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Añadir producto</a>
    </div>      
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="edit_producto.php"><img src="images/2_050.png" width="64" height="64" /></a>
        <a href="edit_producto.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Modificar producto</a>
    </div> 
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="borrar_producto.php"><img src="images/editdelete.png" width="64" height="64" /></a>
        <a href="borrar_producto.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Borrar producto</a>
    </div>            
    
    <div style="clear: both;"><!-- separador --></a></div>
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="add_noticia.php"><img src="images/news_add.png" width="64" height="64" /></a>
        <a href="add_noticia.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Añadir noticia</a>
    </div>      
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="edit_noticia.php"><img src="images/news_edit.png" width="64" height="64" /></a>
        <a href="edit_noticia.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Modificar noticia</a>
    </div> 
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="borrar_noticia.php"><img src="images/news_delete.png" width="64" height="64" /></a>
        <a href="borrar_noticia.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Borrar noticia</a>
    </div>   
    
    <div style="clear: both;"><!-- separador --></a></div>       
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="add_images.php"><img src="images/image_add.png" width="64" height="64" /></a>
        <a href="add_images.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Subir imagen al servidor</a>
    </div>
    
    <div class="icono" style="position:relative; margin-top:40px; margin-left:40px;">
        <a href="add_images_crop.php"><img src="images/image_add.png" width="64" height="64" /></a>
        <a href="add_images_crop.php" style="font-size: 14px; font-weight:bold; color:#fff; font-family:arial;">Image Crop (beta)</a>
    </div>      
    
</div>

</body>
</html>
