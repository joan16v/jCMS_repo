<?php

include('../includes/config.php');

function file_extension($filename) {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

if ($_FILES['userfile']['name'] != "") {
    $uploaddir = "../images/";
    $foto_name = limpiar_nombre_foto(basename($_FILES['userfile']['name']));
    $uploadfile = $uploaddir . $foto_name;
    $extension = strtolower(file_extension(basename($_FILES['userfile']['name'])));
    $array_extensiones = array("jpg", "png", "jpeg", "gif");
    if (!in_array($extension, $array_extensiones)) {
        die("error");
    }

    $img_name = $_FILES['userfile']['tmp_name'];
    $new_name = $foto_name;
    $new_name_path = $uploadfile;
    $max_width = 800;
    $max_height = 600;
    $size = GetImageSize($_FILES['userfile']['tmp_name']);

    if (($size[0] > 800) || ($size[1] > 600)) {
        $width_ratio  = ($size[0] / $max_width);
        $height_ratio = ($size[1] / $max_height);
        if ($width_ratio >= $height_ratio) {
           $ratio = $width_ratio;
        } else {
           $ratio = $height_ratio;
        }
        $new_width = ($size[0] / $ratio);
        $new_height = ($size[1] / $ratio);
    } else {
        $new_width = $size[0];
        $new_height = $size[1];
    }

    if ($extension == "jpg" || $extension == "jpeg") {
        $src_img = ImageCreateFromJPEG($_FILES['userfile']['tmp_name']);
    }
    if ($extension == "gif") {
        $src_img = ImageCreateFromGIF($_FILES['userfile']['tmp_name']);
    }
    if ($extension == "png") {
        $src_img = ImageCreateFromPNG($_FILES['userfile']['tmp_name']);
    }

    if (!$src_img) {
        die("error");
    } else {
        $thumb = ImageCreateTrueColor($new_width, $new_height);
        ImageCopyResampled($thumb, $src_img, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
        ImageJPEG($thumb, $new_name_path);
        ImageDestroy($src_img);
        ImageDestroy($thumb);
        chmod($uploadfile, 0777);
        ?>
        <html>
            <head>
                <title>Subir fotos al servidor</title>
                <link rel="stylesheet" href="admin_style.css" type="text/css" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <script type='text/javascript' src='../js/jquery.min.js'></script>
                <link rel="stylesheet" href="jcrop/css/jquery.Jcrop.min.css" type="text/css" />
                <script src="jcrop/js/jquery.Jcrop.min.js"></script>
            </head>
            <body>

            <script type="text/javascript">
                jQuery(function() {
                    jQuery('#cropbox').Jcrop({
                        aspectRatio: 0,
                        onSelect: updateCoords
                    });
                });

                function updateCoords(c) {
                    jQuery('#x').val(c.x);
                    jQuery('#y').val(c.y);
                    jQuery('#w').val(c.w);
                    jQuery('#h').val(c.h);
                };

                function checkCoords() {
                    if (parseInt(jQuery('#w').val()) > 0) return true;
                    alert('Elige primero un trozo de imagen.');
                    return false;
                };

                jQuery(function () {
                    jQuery('#showcode').FieldsetToggle('Code for this demo');
                });
            </script>

            <div style="margin: 20px;">
                <h1>Subir fotos al servidor con jQuery CROP (beta)</h1>
                <div><img src="../images/<?php echo $foto_name; ?>" id="cropbox" /></div>
                <div style="margin-top:20px;">
                    Elige un el trozo de imagen que quieras y pulsa el boton Adelante.
                </div>
                <div>
                    <form action="add_images_jcrop.php" method="post" onsubmit="return checkCoords();">
                        <input type="hidden" name="fichero" value="<?php echo $uploadfile; ?>" />
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="submit" value="Adelante" style="float:left; width: 98px;" />
                    </form>
                </div>
            </div>
            </body>
        </html>
        <?php
    }

    exit(0);
}

?>
<html>
    <head>
        <title>Subir fotos al servidor</title>
        <link rel="stylesheet" href="admin_style.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type='text/javascript' src='../js/jquery.min.js'></script>
    </head>
    <body>
        <div style="margin: 20px;">
            <h1>Subir fotos al servidor con jQuery CROP (beta)</h1>
            <form action="" method="post" enctype="multipart/form-data" id="form_sub_jquery_crop">
                <script type="text/javascript">
                    function checkfichero() {
                        var archivo = document.getElementById('fichero_elegido').value;
                        var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
                        if (extension == ".jpg" || extension == ".gif" || extension == ".png" || extension == ".jpeg") {
                            document.getElementById('form_sub_jquery_crop').submit();
                        } else {
                            document.getElementById('fichero_elegido').value = "";
                            alert("error: no es un fichero de imagen.");
                        }
                    }
                </script>
                <div>Elegir imagen de tu PC</div>
                <div style="margin-top: 10px;"><input type="file" name="userfile" id="fichero_elegido" onchange="checkfichero()" /></div>
            </form>
        </div>
    </body>
</html>
