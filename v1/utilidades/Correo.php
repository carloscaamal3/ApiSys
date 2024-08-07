<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'utilidades/ExcepcionApi.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/SMTP.php';

/**
 * Correo
 * 
 * Realiza todas las operaciones necesarias para el
 * envio de correos.
 * Permite Enviar correos para invitar usuarios a registrarse
 * Permite enviar correos para solicitar reinicios de contraseña
 * 
 * @author José Antonio Rodriguez Barceló <rbsistemas@hotmail.com>
 */
class Correo
{
    private static $email = null;
    public static $mail;

    final private function __construct()
    {
        self::$mail = new PHPMailer;
        self::$mail->CharSet = 'UTF-8';
        self::$mail->isSMTP();
        self::$mail->SMTPSecure = 'ssl';
        self::$mail->SMTPDebug = 0;
        self::$mail->Debugoutput = 'html';
        self::$mail->Host = "smtp.gmail.com";
        self::$mail->Port = 465;
        self::$mail->SMTPAuth = true;
        self::$mail->Username = "ivey.gob.serv@gmail.com";
        self::$mail->Password = "ygwmxigqsgzcllpm";
    }

    final protected function __clone()
    {
    }

    public static function obtenerInstancia()
    {
        if (self::$email === null) {
            self::$email = new self();
        }
        return self::$email;
    }

    /**
     * Envia una invitacion al correo del usuario para que se registre
     *
     * @param [string] $correo Correo electrónico del usuario a invitar
     * @param [string] $token Token para validar la invitacion
     * @return bool True si se envio el correo, False si no se pudo enviar.
     */
    public static function invitarUsuario($correo, $token)
    {
        $html = file_get_contents('../templates/template.html');
        $url = "https://test.shuttleexpressmexico.com.mx/registro?token=".$token;
        $htmlfinal = str_replace("urlregistro",$url,$html);
        $htmlfinal = str_replace("TituloMensajeInvita","Reigistro de Usuario", $htmlfinal);
        self::$mail->Subject = "Regístrate para usar la aplicacion";
        self::$mail->msgHTML($htmlfinal);
        self::$mail->addAddress($correo);
        if (self::$mail->send()) {
            return true;
        }
        return false;
    }
 public function enviarCorreoConAdjunto($correo, $correo2, $nombre, $correoRe, $asunto, $cuerpo, $comprobante, $attachmentPath) {
    require_once 'libs/PHPMailer/src/PHPMailer.php';
    $correoRes = 'carloscaamal3@gmail.com';
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP y credenciales
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'ivey.gob.serv@gmail.com'; //  correo de SMTP
        $mail->Password = 'ygwmxigqsgzcllpm'; //  contraseña de SMTP
        $mail->SMTPSecure = 'ssl'; // TLS o SSL, según la configuración de servidor SMTP
        $mail->Port = 465; // Puerto de SMTP
        $mail->setFrom($correoRe, 'IVEY ' . $nombre);// recibe el correo y nombre del usuario que envía
        $mail->addReplyTo($correoRe, $nombre, $correoRes, 'IVEY ');

        // Adjuntar el archivo
        $mail->addAttachment($attachmentPath);

        $html = file_get_contents('../templates/template.html');

        $htmlfinal = str_replace("descargarArchivo", $attachmentPath, $html);
        $htmlfinal = str_replace("DescripcionMensaje", $cuerpo, $htmlfinal);
        $htmlfinal = str_replace("TituloMensajeInvita", $asunto, $htmlfinal);
        $htmlfinal = str_replace("RemitenteNombre", $nombre, $htmlfinal);
        $htmlfinal = str_replace("CorreoRemitente", $correoRe, $htmlfinal);
		$htmlfinal = str_replace("tipoComprobante", $comprobante, $htmlfinal);

        $mail->Subject = $asunto;
        $mail->msgHTML($htmlfinal);

        // Envía el correo a ambos destinatarios si ambos están presentes
        if (!empty($correo) && !empty($correo2)) {
            $mail->addAddress($correo);
            $mail->addAddress($correo2);
            $mail->send();
        } elseif (!empty($correo)) {
            // Si solo $correo está presente, envía solo a $correo
            $mail->addAddress($correo);
            $mail->send();
        } elseif (!empty($correo2)) {
            // Si solo $correo2 está presente, envía solo a $correo2
            $mail->addAddress($correo2);
            $mail->send();
        } else {
            throw new Exception("No hay destinatarios válidos.");
        }

        return true;
    } catch (Exception $e) {
        return false;
    }
}
    /**
     * Envia correo electrónico
     * 
     * Envia un correo electrónico que contiene un enlace para reiniciar la contraseña
     *
     * @param string $correo Correo electrónico del usuario a invitar
     * @param string $token Token para validar la invitacion
     * @return bool True si se envio el correo, False si no se pudo enviar.
     */
    public static function enviarReinicio($correo,$token)
    {
        $url = "https://test.shuttleexpressmexico.com.mx/reinicio?token=".$token;
        $html = file_get_contents('../templates/template.html');
        $htmlfinal = str_replace("urlregistro",$url,$html);
        $htmlfinal = str_replace("TituloMensajeInvita","Reinicio de Contraseña", $htmlfinal);

        self::$mail->Subject = "Solicitud de reinicio de contraseña";

        self::$mail->msgHTML($htmlfinal);
        self::$mail->addAddress($correo);
        if (self::$mail->send()) {
            return true;
        }
        return false;
    }
}
