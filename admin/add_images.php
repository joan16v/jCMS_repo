<html>
    <head>
        <title>Subir fotos al servidor</title>
        <link rel="stylesheet" href="admin_style.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type='text/javascript' src='../js/jquery.min.js'></script>
    </head>
    <body>
        <div style="margin: 20px;">
            <h1>Subir fotos al servidor</h1>
            <script type="text/javascript" src="../js/AjaxUpload.2.0.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    var button = $('#upload_button'), interval;
                    new AjaxUpload('#upload_button', {
                        action: './ajax/subir_imagen.php',
                        onSubmit : function(file , ext){
                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
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

            <div style="margin-top: 20px; margin-bottom:20px;">[ <a style="color: #eee; font-weight:bold;" id="upload_button" href="">Subir imagen</a> ]</div>
            <div style="margin-top: 10px;"><input type="button" value="Volver" onclick="window.location='index.php'" /></div>
        </div>
    </body>
</html>
