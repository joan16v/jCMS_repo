<? 

//variables idioma
$h1="Contacto";
$nombre="Nombre";
$email="Correo electronico";
$telefono="Telefono";
$consulta="Consulta";
$enviar="Enviar";
$cancelar="Cancelar";

if( $_SESSION["lang_session"]=="EN" ) {
    $h1="Contact";
    $nombre="Name";
    $email="E-mail";
    $telefono="Phone";
    $consulta="Message";    
    $enviar="Send";
    $cancelar="Cancel";    
}

?>

<script src="js/uniform/jquery.uniform.js" type="text/javascript"></script>
<link rel="stylesheet" href="js/uniform/css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript">
    $(document).ready(function() {
        $(".uniform_form").uniform();
    });
</script>

<h1><? echo strtoupper($h1); ?></h1>

<div style="font-size: 11px;">

    <form action="send.php" method="post">
    
        <div><? echo strtoupper($nombre); ?>:</div>
        <div><input class="uniform_form" type="text" name="nombre" style="width: 400px;" /></div>
        
        <div><? echo strtoupper($email); ?>:</div>
        <div><input class="uniform_form" type="text" name="email" style="width: 400px;" /></div>
        
        <div><? echo strtoupper($telefono); ?>:</div>
        <div><input class="uniform_form" type="text" name="telefono" style="width: 400px;" /></div>
        
        <div><? echo strtoupper($consulta); ?>:</div>
        <div><textarea class="uniform_form" name="consulta" style="width: 600px; height:100px;"></textarea></div>
        
        <div style="margin-top: 10px;">
            <?php
              require_once('recaptcha/recaptchalib.php');
              // you got this from the signup page
              // www.google.com/recaptcha
              // also in /send.php
              $publickey = "6LdU_ucSAAAAAP_jC-RAlla-yymu9goT4cbgRFsU"; 
              echo recaptcha_get_html($publickey);
            ?>        
        </div>
        
        <div style="margin-top: 10px;"><input class="uniform_form" type="submit" value="<? echo $enviar; ?>" /> <input class="uniform_form" type="button" onclick="window.location='index.php'" value="<? echo $cancelar; ?>" /></div>            
            
    </form>

</div>
