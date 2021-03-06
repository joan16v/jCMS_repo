<?php

include('../includes/config.php');

if (isset($_POST['contenido'])) {
    $contenido = GetSQLValueString($_POST['contenido'], "html");
    $contenido_en = GetSQLValueString($_POST['contenido_en'], "html");
    $consulta = "update jcms_seccion_index set contenido='" . $contenido . "', contenido_en='" . $contenido_en . "' where id=1";

    if (!$query = mysql_query($consulta)) {
        die("Error de conexion a la base de datos.");
    } else {
        header("Location: index.php?mensaje=edit_seccion_ok");
    }
    exit(0);
}

?>
<html>
    <head>
        <title>Editar sección</title>
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
        </script>
    </head>
    <body>

    <div style="margin: 20px;">
        <h1>Editar sección</h1>

        <?php $rowSeccion = mysql_fetch_object(mysql_query("select * from jcms_seccion_index where id=1")); ?>

        <script type="text/javascript">
            function check_add() {
                if (document.getElementById('contenido').value != "") {
                    document.getElementById('formulario_add_sec').submit();
                } else {
                    alert("Debes introducir el contenido.");
                }
            }
        </script>

        <form id="formulario_add_sec" action="" method="post">
            <div style="margin-top: 10px;">Contenido <img src="images/es.png" /></div>
            <div><textarea name="contenido" id="contenido" style="width: 639px; height:400px;"><?php echo $rowSeccion->contenido; ?></textarea></div>

            <div style="margin-top: 10px;">Description <img src="images/en.png" /></div>
            <div><textarea name="contenido_en" id="contenido_en" style="width: 639px; height:400px;"><?php echo $rowSeccion->contenido_en; ?></textarea></div>

            <div style="margin-top: 10px;"><input type="button" onclick="check_add()" value="Guardar" /> <input type="button" value="Cancelar" onclick="window.location='edit_seccion.php'" /></div>
        </form>

    </div>
    </body>
</html>
