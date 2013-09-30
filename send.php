<?php
  
  require_once('includes/recaptcha/recaptchalib.php');
  //change this with your recaptcha key
  // get it: http://www.google.com/recaptcha
  $privatekey = "6LdU_ucSAAAAAF-OkKq5l9Sr8uP85-HvACks194P"; 
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    
    //KO    
    header("Location: index.php?contact=error");
    exit(0);    
    
  } else {
    
    //OK    
    $mail=$_POST['email'];
    $mymail="joan16v@gmail.com"; //your mail here
    $subject="Formulario de contacto";
    
    $header = "From:$mail\nReply-To:$mail\n";
    $header .= "X-Mailer:PHP/".phpversion()."\n";
    $header .= "Mime-Version: 1.0\n";
    $header .= "Content-Type: text/html";    
    
    //montamos el cuerpo del mensaje
    $contenido.="<table>";
    foreach($_POST as $k => $v) {
     if($k != "recaptcha_challenge_field" && $k != "recaptcha_response_field") {    		
   		if($k == 'email') $v="<a href=\"mailto:$v\">$v</a>";
        $contenido .= "<tr><td align=\"right\" style=\"font-family:Arial\"><b>".str_replace("_"," ",ucfirst($k))."</b>:</td><td align=\"left\" style=\"font-family:Arial\">$v</td></tr>\n";
      }
    }
    $contenido.="</table>";
    mail($mymail, $subject, $contenido ,$header);
    
    header("Location: index.php?contact=send");
    exit(0);
    
  }
  
?>
