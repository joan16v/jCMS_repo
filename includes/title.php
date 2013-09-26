<? 

// SEO title

if(isset($_GET['id'])) {
    $id_seccion=GetSQLValueString($_GET['id'],"int");
    $rowSeccion=mysql_fetch_object(mysql_query("select * from jcms_secciones where id='".$id_seccion."'"));
    $nombre=$rowSeccion->nombre;
    if( $_SESSION["lang_session"]=="EN" ) $nombre=$rowSeccion->nombre_en; 
    echo $nombre." - ".PAGE_TITLE;
}

if(isset($_GET['id_prod'])) {
    $id_producto=GetSQLValueString($_GET['id_prod'],"int");
    $rowProducto=mysql_fetch_object(mysql_query("select * from jcms_productos where id='".$id_producto."'"));    
    $nombre=$rowProducto->nombre;
    if( $_SESSION["lang_session"]=="EN" ) $nombre=$rowProducto->nombre_en;
    echo $nombre." - ".PAGE_TITLE;
}

if(isset($_GET['id_not'])) {
    $id_noticia=GetSQLValueString($_GET['id_not'],"int");
    $rowNoticia=mysql_fetch_object(mysql_query("select * from jcms_noticias where id='".$id_noticia."'"));    
    $nombre=$rowNoticia->nombre;
    if( $_SESSION["lang_session"]=="EN" ) $nombre=$rowNoticia->nombre_en;
    echo $nombre." - ".PAGE_TITLE;
}

if( !isset($_GET['id']) && !isset($_GET['id_prod']) && !isset($_GET['id_not']) ) {
    echo PAGE_TITLE;
}

?>
