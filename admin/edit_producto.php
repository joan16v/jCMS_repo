<?php

include('../includes/config.php');

if (!function_exists('json_decode')) {
    function json_decode($content, $assoc = false) {
        require_once '../includes/JSON.php';
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        } else {
            $json = new Services_JSON;
        }
        return $json->decode($content);
    }
}

if (isset($_POST['nombre'])) {
    $id = GetSQLValueString($_POST['id'], "int");
    $nombre = GetSQLValueString($_POST['nombre'], "string");
    $descripcion = GetSQLValueString($_POST['descripcion'], "html");
    $nombre_en = GetSQLValueString($_POST['nombre_en'], "string");
    $descripcion_en = GetSQLValueString($_POST['descripcion_en'], "html");
    $precio = GetSQLValueString( str_replace(",", ".", $_POST['precio']), "float");
    $id_seccion = GetSQLValueString($_POST['id_seccion'], "int");
    $orden = GetSQLValueString( str_replace(",", ".", $_POST['orden']), "float");
    $array_imagenes = json_decode( str_replace("\\", "", $_POST['arrayorden']));
    $consulta = "update jcms_productos set nombre='" . $nombre . "', nombre_en='" . $nombre_en . "', descripcion='" . $descripcion . "', descripcion_en='" . $descripcion_en . "', id_seccion='" . $id_seccion . "', precio='" . $precio . "', orden='" . $orden . "' where id='" . $id . "'";

    if (!$query = mysql_query($consulta)) {
        die("Error de conexion a la base de datos.");
    } else {
        if (isset($_POST["fotos"]) && is_array($_POST["fotos"]) && count($_POST["fotos"]) > 0) {
            mysql_query("delete from jcms_productos_imagenes where id_producto='" . $id . "'");

            foreach ($array_imagenes as $imagen) {
                $cons = "insert into jcms_productos_imagenes (id_producto,imagen,orden) values ('" . $id . "','" . $imagen[0] . "','" . $imagen[1] . "')";
                mysql_query($cons);
            }
        }

        header("Location: index.php?mensaje=edit_producto_ok");
    }
    exit(0);
}

?>
<html>
    <head>
    <title>Editar producto</title>
    <link rel="stylesheet" href="admin_style.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type='text/javascript' src='../js/jquery.min.js'></script>
    <script type="text/javascript" src="./jwysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.image.js"></script>
    <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.link.js"></script>
    <script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.table.js"></script>
    <link rel="stylesheet" href="./jwysiwyg/jquery.wysiwyg.css" type="text/css" />
    <link rel="stylesheet" href="./jwysiwyg/plugins/fileManager/wysiwyg.fileManager.css" type="text/css" />
    <script type="text/javascript" src="./jwysiwyg/plugins/wysiwyg.fileManager.js"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#descripcion,#descripcion_en').wysiwyg({
                    css: './editor.css',
                    controls: {
                        html: {visible : true},
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
        <h1>Editar producto</h1>
        <?php

        if (isset($_GET['id'])) {

            $id_producto = GetSQLValueString($_GET['id'], "int");
            $rowProducto = mysql_fetch_object(mysql_query("select * from jcms_productos where id='" . $id_producto . "'"));

            ?>

            <script type="text/javascript" src="../js/AjaxUpload.2.0.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    var button = $('#upload_button'), interval;
                    new AjaxUpload('#upload_button', {
                        action: './ajax/add_foto.php',
                        onSubmit : function(file , ext){
                        if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                            alert('Error: Solo se permiten imagenes.');
                            return false;
                        } else {
                            button.text('Subiendo...');
                            this.disable();
                        }
                        },
                        onComplete: function(file, response){
                            if( response=="error" ) {
                                alert("Error subiendo la foto.");
                            } else {
                                button.text('Subir foto');
                                this.enable();
                                actualizar_div_fotos(response);
                                //alert("Se ha subido la foto correctamente.");
                            }
                        }
                    });
                });
            </script>

            <script type="text/javascript">
                var numfotos = 0;
                var array_fotos = new Array();

                function loadFotosInicio() {
                    <?php

                    $sqlIP = "select * from jcms_productos_imagenes where id_producto='" . $id_producto . "' order by orden asc";
                    $exIP = mysql_query($sqlIP);
                    $numfotos = 0;
                    while ($rowIP = mysql_fetch_object($exIP)) {
                        ?>$('#div_fotos').append('<div id="fotothumb<?php echo $numfotos ?>" class="elementofoto" style="position:relative; float:left; width:70px; height:70px; margin-right:10px;"><img src="../thumbProducto.php?foto=images/<?php echo $rowIP->imagen; ?>" /><input type="hidden" name="fotos[]" value="<?php echo $rowIP->imagen; ?>" /><div style="width:20px; height:20px; position:absolute; top:0px; right:0px; z-index:10;"><a class="enlacequitar" href="javascript:quitarfoto(<?php echo $numfotos; ?>);"><img src="images/borrar.png" /></a></div><div style="position:absolute; top:60px; left:17px; width:16px; height:16px; z-index:10;"><a class="enlacemenos" href="javascript:orden_menos(<?php echo $numfotos; ?>);"><img src="images/izq.png" /></a></div><div style="position:absolute; top:61px; left:33px; width:16px; height:16px; z-index:10;"><a class="enlacemas" href="javascript:orden_mas(<?php echo $numfotos; ?>);"><img src="images/der.png" /></a></div></div>');
                        var array_foto = new Array();
                        array_foto[0] = '<?php echo $rowIP->imagen; ?>';
                        array_foto[1] = <?php echo $numfotos ?>;
                        array_fotos[numfotos] = array_foto;
                        numfotos++;
                        <?php
                        $numfotos++;
                    }

                    ?>
                }

                function actualizar_div_fotos(foto) {
                    $('#div_fotos').append('<div id="fotothumb' + numfotos + '" class="elementofoto" style="position:relative; float:left; width:70px; height:70px; margin-right:10px;"><img src="../thumbProducto.php?foto=images/' + foto + '" /><input type="hidden" name="fotos[]" value="' + foto + '" /><div style="width:20px; height:20px; position:absolute; top:0px; right:0px; z-index:10;"><a class="enlacequitar" href="javascript:quitarfoto(' + numfotos + ');"><img src="images/borrar.png" /></a></div><div style="position:absolute; top:60px; left:17px; width:16px; height:16px; z-index:10;"><a class="enlacemenos" href="javascript:orden_menos(' + numfotos + ');"><img src="images/izq.png" /></a></div><div style="position:absolute; top:61px; left:33px; width:16px; height:16px; z-index:10;"><a class="enlacemas" href="javascript:orden_mas(' + numfotos + ');"><img src="images/der.png" /></a></div></div>');
                    var array_foto = new Array();
                    array_foto[0] = foto;
                    array_foto[1] = numfotos;
                    array_fotos[numfotos] = array_foto;
                    numfotos++;
                }
                function quitarfoto(id) {
                    $('#fotothumb'+id).remove();
                    if (id == 0) {
                        array_fotos.shift();
                    } else {
                        array_fotos.splice(id);
                    }
                    reordenar_fotos();
                }

                function orden_menos(id) {
                    if ((id - 1) >= 0) {
                        var div = '<div id="fotothumb' + id + '" class="elementofoto" style="position:relative; float:left; width:70px; height:70px; margin-right:10px;">' + $('#fotothumb'+id).html() + '</div>';
                        $('#fotothumb' + id).remove();
                        $('#fotothumb' + (id - 1)).before(div);
                        array_fotos[id][1] = parseFloat(array_fotos[id - 1][1]) - (0.001);
                        array_fotos.sort(function(a, b) {
                            if (a[1] < b[1]) return -1;
                            if (a[1] > b[1]) return 1;
                            return 0;
                        });
                        reordenar_fotos();
                    }
                }
                function orden_mas(id) {
                    if (id < (array_fotos.length - 1)) {
                        var div = '<div id="fotothumb' + id + '" class="elementofoto" style="position:relative; float:left; width:70px; height:70px; margin-right:10px;">' + $('#fotothumb' + id).html() + '</div>';
                        $('#fotothumb' + id).remove();
                        $('#fotothumb' + (id + 1)).after(div);
                        array_fotos[id][1] = parseFloat(array_fotos[id + 1][1]) + (0.001);
                        array_fotos.sort(function(a, b) {
                            if (a[1] < b[1]) return -1;
                            if (a[1] > b[1]) return 1;
                            return 0;
                        });
                        reordenar_fotos();
                    }
                }
                function reordenar_fotos() {
                     var i = 0;
                     $("#div_fotos .elementofoto").each(function (index) {
                        $(this).attr('id', 'fotothumb' + i);
                        i++;
                     });
                     i = 0;
                     $('#div_fotos .enlacequitar').each(function (index) {
                        $(this).attr('href','javascript:quitarfoto(' + i + ');');
                        i++;
                     });
                     i = 0;
                     $('#div_fotos .enlacemenos').each(function (index) {
                        $(this).attr('href','javascript:orden_menos(' + i + ');');
                        i++;
                     });
                     i = 0;
                     $('#div_fotos .enlacemas').each(function (index) {
                        $(this).attr('href','javascript:orden_mas(' + i + ');');
                        i++;
                     });
                }
                function dump(arr, level) {
                    var dumped_text = "";
                    if (!level) {
                        level = 0;
                    }
                    var level_padding = "";
                    for (var j = 0; j < (level + 1); j++) {
                        level_padding += "    ";
                    }
                    if (typeof(arr) == 'object') {
                        for (var item in arr) {
                            var value = arr[item];
                            if (typeof(value) == 'object') {
                                dumped_text += level_padding + "'" + item + "' ...\n";
                                dumped_text += dump(value, level + 1);
                            } else {
                                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                            }
                        }
                    } else {
                        dumped_text = "===>" + arr + "<===(" + typeof(arr) + ")";
                    }
                    return dumped_text;
                }

                function check_add() {
                    if (document.getElementById('nombre').value != "") {
                        document.getElementById('arrayorden').value = $.toJSON(array_fotos);
                        document.getElementById('formulario_add_sec').submit();
                    } else {
                        alert("Debes escribir un nombre.");
                    }
                }

                $(document).ready(function() {
                    loadFotosInicio();
                });
            </script>

            <script type="text/javascript" src="../js/jquery.json-2.2.js"></script>

            <form id="formulario_add_sec" action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id_producto; ?>" />
                <input type="hidden" name="arrayorden" id="arrayorden" value="" />

                <div>Nombre del producto <img src="images/es.png" /></div>
                <div><input name="nombre" id="nombre" type="text" style="width: 500px;" value="<?php echo $rowProducto->nombre; ?>" /></div>

                <div>Product name <img src="images/en.png" /></div>
                <div><input name="nombre_en" id="nombre_en" type="text" style="width: 500px;" value="<?php echo $rowProducto->nombre_en; ?>" /></div>

                <div style="margin-top: 10px;">Orden</div>
                <div><input name="orden" id="orden" type="text" value="<?php echo $rowProducto->orden; ?>" style="width: 50px;" /></div>

                <div style="margin-top: 10px;">Precio</div>
                <div><input name="precio" id="precio" type="text" style="width: 100px;" value="<?php echo $rowProducto->precio; ?>" /></div>

                <div style="margin-top: 10px;">Descripción <img src="images/es.png" /></div>
                <div><textarea name="descripcion" id="descripcion" style="width: 639px; height:400px;"><?php echo $rowProducto->descripcion; ?></textarea></div>

                <div style="margin-top: 10px;">Description <img src="images/en.png" /></div>
                <div><textarea name="descripcion_en" id="descripcion_en" style="width: 639px; height:400px;"><?php echo $rowProducto->descripcion_en; ?></textarea></div>

                <div style="margin-top: 10px;">Fotos del producto</div>

                <div style="margin-bottom: 10px;">[ <a style="color: #eee; font-weight:bold;" id="upload_button" href="">Subir foto</a> ]</div>
                <div id="div_fotos" style="position:relative; width: 100%;"></div>
                <div style="clear: both;"><!-- separador --></div>

                <div style="margin-top: 20px;">Ubicación</div>
                <div><select name="id_seccion" style="width: 300px;"><?php
                    $sub_level = 0;
                    $idSeccion = $rowProducto->id_seccion;
                    function buscar_hijos_rec($id_cat) {
                        global $sub_level;
                        global $idSeccion;
                        if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                            $sub_level++;
                            $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                            $exC = mysql_query($sqlC);
                            while ($rowC = mysql_fetch_object($exC)) {
                                $id = $rowC->id;
                                ?><option value="<?php echo $id; ?>" <?php if ($idSeccion == $id) { echo "selected"; } ?>><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $rowC->nombre; ?></option><?php
                                buscar_hijos_rec($id);
                            }
                        }
                    }
                    $sql2 = "select * from jcms_secciones where id_padre=0 order by orden asc";
                    $ex2 = mysql_query($sql2);
                    while ($row2 = mysql_fetch_object($ex2)) {
                        $id = $row2->id;
                        ?><option value="<?php echo $id; ?>" <?php if ($idSeccion == $id) { echo "selected"; } ?>><?php for ($k = 0; $k < ($sub_level * 3 + 3); $k++) echo "&nbsp;"; ?><?php echo $row2->nombre; ?></option><?php
                        buscar_hijos_rec($id);
                        $sub_level = 0;
                    }

                ?></select></div>
                <div style="margin-top: 10px;"><input type="button" onclick="check_add()" value="Guardar" /> <input type="button" value="Cancelar" onclick="window.location='edit_producto.php'" /></div>
            </form>

            <div style="position: absolute; bottom:5px; right:5px; display:block;"><a href="javascript:alert(dump(array_fotos));">--</a></div>

            <?php
        } else {
            $sub_level = 0;
            function buscar_hijos_rec($id_cat) {
                global $sub_level;
                if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                    $sub_level++;
                    $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                    $exC = mysql_query($sqlC);
                    while ($rowC = mysql_fetch_object($exC)) {
                        $id = $rowC->id;
                        echo "<div style=\"padding-left:" . ($sub_level * 10) . "px; font-weight:bold;\">" . $rowC->nombre . "</div>";
                        if (mysql_num_rows(mysql_query("select * from jcms_productos where id_seccion='" . $id . "'")) > 0) {
                            $sqlP = "select * from jcms_productos where id_seccion='" . $id . "' order by orden asc";
                            $exP = mysql_query($sqlP);
                            while ($rowP = mysql_fetch_object($exP)) {
                                echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Editar producto\" href=\"edit_producto.php?id=" . $rowP->id . "\"><img src=\"images/gtk-edit.png\"></a></div>";
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
                if (mysql_num_rows(mysql_query("select * from jcms_productos where id_seccion='" . $id . "'")) > 0) {
                    $sqlP = "select * from jcms_productos where id_seccion='" . $id . "' order by orden asc";
                    $exP = mysql_query($sqlP);
                    while ($rowP = mysql_fetch_object($exP)) {
                        echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Editar producto\" href=\"edit_producto.php?id=" . $rowP->id . "\"><img src=\"images/gtk-edit.png\"></a></div>";
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
