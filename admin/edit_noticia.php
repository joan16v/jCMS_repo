<?php

include('../includes/config.php');

if (isset($_POST['nombre'])) {
    $id = GetSQLValueString($_POST['id'], "int");
    $nombre = GetSQLValueString($_POST['nombre'], "string");
    $descripcion = GetSQLValueString($_POST['descripcion'], "html");
    $nombre_en = GetSQLValueString($_POST['nombre_en'], "string");
    $descripcion_en = GetSQLValueString($_POST['descripcion_en'], "html");
    $id_seccion = GetSQLValueString($_POST['id_seccion'], "int");
    $consulta = "update jcms_noticias set nombre='" . $nombre . "', descripcion='" . $descripcion . "',nombre_en='" . $nombre_en . "', descripcion_en='" . $descripcion_en . "', id_seccion='" . $id_seccion . "' where id='" . $id . "'";

    if (!$query = mysql_query($consulta)) {
        die("Error de conexion a la base de datos.");
    } else {
        $fichero = $_FILES["fichero"]["name"];
        $fichero_tmp = $_FILES["fichero"]["tmp_name"];
        if ($fichero != "") {
            $destino = "../images/noticias/" . limpiar_nombre_foto($fichero);
            if (move_uploaded_file($fichero_tmp, $destino)) {
                mysql_query("update jcms_noticias set imagen='" . limpiar_nombre_foto($fichero) . "' where id='" . $id . "'");
            }
        }

        header("Location: index.php?mensaje=edit_noticia_ok");
    }
    exit(0);
}

?>
<html>
    <head>
        <title>Editar noticia</title>
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
                    $('#descripcion,#descripcion_en').wysiwyg({
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
            <h1>Editar noticia</h1>
            <?php

            if (isset($_GET['id'])) {

                $id_noticia = GetSQLValueString($_GET['id'], "int");
                $rowNoticia = mysql_fetch_object(mysql_query("select * from jcms_noticias where id='" . $id_noticia . "'"));

                ?>
                <script type="text/javascript">
                    function check_add() {
                        if (document.getElementById('nombre').value != "") {
                            document.getElementById('formulario_add_sec').submit();
                        } else {
                            alert("Debes escribir un titulo.");
                        }
                    }
                </script>

                <form id="formulario_add_sec" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id_noticia; ?>" />

                    <div>Titulo de la noticia <img src="images/es.png" /></div>
                    <div><input name="nombre" id="nombre" type="text" style="width: 500px;" value="<?php echo $rowNoticia->nombre; ?>" /></div>

                    <div>Title <img src="images/en.png" /></div>
                    <div><input name="nombre_en" id="nombre_en" type="text" style="width: 500px;" value="<?php echo $rowNoticia->nombre_en; ?>" /></div>

                    <div style="margin-top: 20px;">Imagen de la noticia</div>
                    <?php
                        if ($rowNoticia->imagen != "") {
                            ?><div><img src="../thumbProd.php?foto=images/noticias/<?php echo $rowNoticia->imagen; ?>" /></div><?php
                        }
                    ?>
                    <div style=" margin-bottom:20px;"><input name="fichero" type="file" style="width:200px;" /></div>

                    <script type="text/javascript" src="../js/AjaxUpload.2.0.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var button = $('#upload_button'), interval;
                            new AjaxUpload('#upload_button', {
                                action: './ajax/subir_imagen.php',
                                onSubmit : function(file , ext){
                                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                                    alert('Error: Solo se permiten imagenes.');
                                    return false;
                                } else {
                                    button.text('Subiendo...');
                                    this.disable();
                                }
                                },
                                onComplete: function(file, response) {
                                    if (response == "error") {
                                        alert("Error subiendo la foto.");
                                    } else {
                                        button.text('Subir foto');
                                        this.enable();
                                        alert("Se ha subido la imagen correctamente. Ahora ya deberia estar disponible en el file manager.");
                                    }
                                }
                            });
                        });
                    </script>

                    <div style="margin-top: 20px; margin-bottom:20px; display:none;">[ <a style="color: #eee; font-weight:bold;" id="upload_button" href="">Subir imagen</a> ]</div>

                    <div style="margin-top: 10px;">Contenido <img src="images/es.png" /></div>
                    <div><textarea name="descripcion" id="descripcion" style="width: 639px; height:400px;"><?php echo $rowNoticia->descripcion; ?></textarea></div>

                    <div style="margin-top: 10px;">Description <img src="images/en.png" /></div>
                    <div><textarea name="descripcion_en" id="descripcion_en" style="width: 639px; height:400px;"><?php echo $rowNoticia->descripcion_en; ?></textarea></div>

                    <div style="margin-top: 10px;">Ubicación</div>
                    <div><select name="id_seccion" style="width: 300px;"><?php

                        $sub_level = 0;
                        $idSeccion = $rowNoticia->id_seccion;
                        function buscar_hijos_rec($id_cat) {
                            global $sub_level;
                            global $idSeccion;
                            if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                                $sub_level++;
                                $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                                $exC = mysql_query($sqlC);
                                while ($rowC=mysql_fetch_object($exC)) {
                                    $id = $rowC->id;
                                    ?><option value="<?php echo $id; ?>" <?php if ($idSeccion == $id) { echo "selected"; } ?>><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $rowC->nombre; ?></option><?php
                                    buscar_hijos_rec($id);
                                }
                            }
                        }
                        $sql2 = "select * from jcms_secciones where id_padre=0 order by orden asc";
                        $ex2 = mysql_query($sql2);
                        while ($row2=mysql_fetch_object($ex2)) {
                            $id = $row2->id;
                            ?><option value="<?php echo $id; ?>" <?php if ($idSeccion == $id) { echo "selected"; } ?>><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $row2->nombre; ?></option><?php
                            buscar_hijos_rec($id);
                            $sub_level = 0;
                        }


                    ?></select></div>
                    <div style="margin-top: 10px;"><input type="button" onclick="check_add()" value="Guardar" /> <input type="button" value="Cancelar" onclick="window.location='edit_noticia.php'" /></div>
                </form>

                <?php
            } else {
                $sub_level = 0;
                function buscar_hijos_rec($id_cat) {
                    global $sub_level;
                    if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                        $sub_level++;
                        $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                        $exC = mysql_query($sqlC);
                        while ($rowC=mysql_fetch_object($exC)) {
                            $id = $rowC->id;
                            echo "<div style=\"padding-left:" . ($sub_level * 10) . "px; font-weight:bold;\">" . $rowC->nombre . "</div>";
                            if (mysql_num_rows(mysql_query("select * from jcms_noticias where id_seccion='" . $id . "'")) > 0) {
                                $sqlP = "select * from jcms_noticias where id_seccion='" . $id . "' order by fecha desc";
                                $exP = mysql_query($sqlP);
                                while ($rowP = mysql_fetch_object($exP)) {
                                    echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Editar noticia\" href=\"edit_noticia.php?id=" . $rowP->id . "\"><img src=\"images/gtk-edit.png\"></a></div>";
                                }
                            }
                            buscar_hijos_rec($id);
                        }
                    }
                }
                $sql2 = "select * from jcms_secciones where id_padre=0 order by orden asc";
                $ex2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_object($ex2)) {
                    $id = $row2->id;
                    echo "<div style=\"padding-left:" . ($sub_level * 10) . "px; font-weight:bold;\">" . $row2->nombre . "</div>";
                    if (mysql_num_rows(mysql_query("select * from jcms_noticias where id_seccion='" . $id . "'")) > 0) {
                        $sqlP = "select * from jcms_noticias where id_seccion='" . $id . "' order by fecha desc";
                        $exP = mysql_query($sqlP);
                        while ($rowP = mysql_fetch_object($exP)) {
                            echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Editar noticia\" href=\"edit_noticia.php?id=" . $rowP->id . "\"><img src=\"images/gtk-edit.png\"></a></div>";
                        }
                    }
                    buscar_hijos_rec($id);
                    $sub_level = 0;
                }
                ?><div style="margin-top: 20px;"><input type="button" value="Volver" onclick="window.location='index.php'" /></div><?php
            }

            ?>
        </div>
    </body>
</html>
