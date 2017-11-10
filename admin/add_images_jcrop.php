<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targ_w = $_POST['w'];
    $targ_h = $_POST['h'];
    $jpeg_quality = 90;
    $src = $_POST['fichero'];
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);
    imagejpeg($dst_r,$src,$jpeg_quality);

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
                <div>Foto subida correctamente.</div>
                <div style="margin-top: 5px;">
                    <img src="<? echo $src; ?>" />
                </div>
                <div style="margin-top: 5px;">
                    <input type="button" value="OK" onclick="window.location='index.php'" />
                </div>
            </div>
        </body>
    </html>
    <?php
}
