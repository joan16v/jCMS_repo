<meta name="TITLE" content="<?php include("title.php"); ?>" />
<meta name="DESCRIPTION" content="<?php
    if (isset($_GET['id'])) {
        $id_seccion = GetSQLValueString($_GET['id'], "int");
        $rowSeccion = mysql_fetch_object(mysql_query("select * from jcms_secciones where id='" . $id_seccion . "'"));
        $contenido = strip_tags($rowSeccion->contenido);

        if ($_SESSION["lang_session"] == "EN") {
            $contenido = strip_tags($rowSeccion->contenido_en);
        }

        $contenido = reSanitizar($contenido);

        if (strlen($contenido) > 200) {
            $contenido = substr($contenido, 0, 200);
        }

        echo $contenido;
    }

    if (isset($_GET['id_prod'])) {
        $id_producto = GetSQLValueString($_GET['id_prod'], "int");
        $rowProducto = mysql_fetch_object(mysql_query("select * from jcms_productos where id='" . $id_producto . "'"));
        $descripcion = strip_tags($rowProducto->descripcion);

        if ($_SESSION["lang_session"] == "EN") {
            $descripcion = strip_tags($rowProducto->descripcion_en);
        }

        $descripcion=reSanitizar($descripcion);

        if (strlen($descripcion) > 200) {
            $descripcion = substr($descripcion, 0, 200);
        }

        echo $descripcion;
    }

    if (isset($_GET['id_not'])) {
        $id_noticia = GetSQLValueString($_GET['id_not'], "int");
        $rowNoticia = mysql_fetch_object(mysql_query("select * from jcms_noticias where id='" . $id_noticia . "'"));
        $descripcion = strip_tags($rowNoticia->descripcion);

        if ($_SESSION["lang_session"] == "EN") {
            $descripcion = strip_tags($rowNoticia->descripcion_en);
        }

        $descripcion = reSanitizar($descripcion);

        if (strlen($descripcion) > 200) {
            $descripcion = substr($descripcion, 0, 200);
        }

        echo $descripcion;
    }

    if (!isset($_GET['id']) && !isset($_GET['id_prod']) && !isset($_GET['id_not'])) {
        ?>jCMS - free and simple php mysql content management system<?php
    }
?>" />
<meta name="KEYWORDS" content="<?php
    if (isset($_GET['id'])) {
        echo str_replace(" ", ",", $contenido);
    }
    if (isset($_GET['id_prod'])) {
        echo str_replace(" ", ",", $descripcion);
    }
    if (isset($_GET['id_not'])) {
        echo str_replace(" ", ",", $descripcion);
    }
    if (!isset($_GET['id']) && !isset($_GET['id_prod']) && !isset($_GET['id_not'])) {
        ?>jcms, php, mysql, css, cms, jquery, joan16v.<?php
    }
?>" />
<meta name="OWNER" content="<?php echo EMAIL_OWNER; ?>" />
<meta name="AUTHOR" content="<?php echo EMAIL_OWNER; ?>" />
