<?php

//echo "images/noticias/Skrillex.jpg";
//if( file_exists("images/noticias/Skrillex.jpg") ) echo "si";

if (extension_loaded('gd') && function_exists('gd_info')) {
    //echo "It looks like GD is installed";
}

include("includes/resize.php");
$thumb=new thumbnail("images/noticias/Skrillex.jpg");
$thumb->size_width(200);
$thumb->show();
        
?>