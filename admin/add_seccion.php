<?php

include('../includes/config.php');

if (isset($_POST['nombre'])) {
    $nombre = GetSQLValueString($_POST['nombre'], "string");
    $contenido = GetSQLValueString($_POST['contenido'], "html");
    $nombre_en = GetSQLValueString($_POST['nombre_en'], "string");
    $contenido_en = GetSQLValueString($_POST['contenido_en'], "html");
    $id_padre = GetSQLValueString($_POST['id_padre'], "int");
    $orden = GetSQLValueString(str_replace(",", ".", $_POST['orden']), "float");
    $consulta = "insert into jcms_secciones (nombre,contenido,nombre_en,contenido_en,id_padre,orden) values ('".$nombre."','".$contenido."','".$nombre_en."','".$contenido_en."','".$id_padre."','".$orden."')";

    if (!$query = mysql_query($consulta)) {
        die("Error de conexion a la base de datos.");
    } else {
        header("Location: index.php?mensaje=add_seccion_ok");
    }
    exit(0);
}

?>
<html>
    <head>
        <title>Añadir sección</title>
        <link rel="stylesheet" href="admin_style.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type='text/javascript' src='../js/jquery.min.js'></script>
        <script type="text/javascript" src="./jwysiwyg/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.image.js"></script>
        <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.link.js"></script>
        <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.table.js"></script>
        <link rel="stylesheet" href="./jwysiwyg/jquery.wysiwyg.css" type="text/css"/>
        <link rel="stylesheet" href="./jwysiwyg/plugins/fileManager/wysiwyg.fileManager.css" type="text/css"/>
        <script type="text/javascript" src="./jwysiwyg/plugins/wysiwyg.fileManager.js"></script>

        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $('#contenido,#contenido_en').wysiwyg({
                        css: './editor.css',
                        controls: {
                            html: { visible : true },
                            "fileManager": {
                                visible: true,
                                groupIndex: 12,
                                tooltip: "File Manager",
                                exec: function () {
                                    $.wysiwyg.fileManager.init(function (file) {
                                        file ? alert(file) : alert("No file selected.");
                                    });
                                }
                            }
                        }
                    });
                    $.wysiwyg.fileManager.setAjaxHandler("/admin/jwysiwyg/plugins/fileManager/handlers/PHP/file-manager.php");
                });
            })(jQuery);

            function check_add() {
                if (document.getElementById('nombre').value != "") {
                    document.getElementById('formulario_add_sec').submit();
                } else {
                    alert("Debes escribir un nombre.");
                }
            }
        </script>
    </head>
    <body>
        <h1>Añadir sección</h1>
        <form id="formulario_add_sec" action="" method="post">
            <div>Nombre de la sección <img src="images/es.png" /></div>
            <div><input name="nombre" id="nombre" type="text" style="width: 500px;" /></div>
            <div>Category name <img src="images/en.png" /></div>
            <div><input name="nombre_en" id="nombre_en" type="text" style="width: 500px;" /></div>
            <div style="margin-top: 10px;">Orden</div>
            <div><input name="orden" id="orden" type="text" value="0" style="width: 50px;" /></div>
            <div style="margin-top: 10px;">Contenido <img src="images/es.png" /></div>
            <div><textarea name="contenido" id="contenido" style="width: 639px; height:400px;"></textarea></div>
            <div style="margin-top: 10px;">Description <img src="images/en.png" /></div>
            <div><textarea name="contenido_en" id="contenido_en" style="width: 639px; height:400px;"></textarea></div>
            <div style="margin-top: 10px;">Ubicación</div>
            <div><select name="id_padre" style="width: 300px;"><option value="0">RAÍZ</option><?php

                $sub_level = 0;
                function buscar_hijos_rec($id_cat) {
                    global $sub_level;
                    if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                        $sub_level++;
                        $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                        $exC = mysql_query($sqlC);
                        while ($rowC = mysql_fetch_object($exC)) {
                            $id = $rowC->id;
                            ?><option value="<?php echo $id; ?>"><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $rowC->nombre; ?></option><?php
                            buscar_hijos_rec($id);
                        }
                    }
                }
                $sql2 = "select * from jcms_secciones where id_padre=0 order by orden asc";
                $ex2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_object($ex2)) {
                    $id = $row2->id;
                    ?><option value="<?php echo $id; ?>"><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $row2->nombre; ?></option><?php
                    buscar_hijos_rec($id);
                    $sub_level = 0;
                }

            ?></select></div>
            <div style="margin-top: 10px;"><input type="button" onclick="check_add()" value="Guardar" /> <input type="button" value="Cancelar" onclick="window.location='index.php'" /></div>
        </form>
    </body>
</html>
