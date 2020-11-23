<?php
include 'conector.php';
require("class.phpmailer.php");
require("class.smtp.php");

$result = mysqli_query($con,"select * from ordenes where ido='".$_GET['orden']."' ");
$r = mysqli_fetch_array($result);


$nombre = 'Dpto Compras Templado s.a.s';
$email = 'jamesnavarroblanco@gmail.com';
$telefono = '34324555';
$asunto = $r[6];
$mensaje = 'Testo del cuerpo del correo';
$destinatario = $r[4];
$e = explode(",", $destinatario);
$correo1 = $e[0];
$correo2 = $e[1];
$correo3 = $e[2];
$correo4 = $e[3];
$correo5 = $e[4];

// Datos de la cuenta de correo utilizada para enviar vía SMTP smtp.gmail.com
$smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "comprastempladosas@gmail.com";  // Mi cuenta de correo
$smtpClave = "Templado2013";  // Mi contraseña


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;


$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($correo1); // Esta es la dirección a donde enviamos los datos del formulario
if($correo2!=''){
    $mail->addCC($correo2);
}
if($correo3!=''){
    $mail->addCC($correo3);
}
if($correo4!=''){
    $mail->addCC($correo4);
}
if($correo5!=''){
    $mail->addCC($correo5);
}

$mail->Subject = $r[6]; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = '<b>Nota de compra:</b>'.$r[7].'<br><hr>'.$r[1]; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente a.".$core;
} else {
    echo "Ocurrio un error inesperado.".$core;
}

//echo '<script>window.close();</script>';





?>


