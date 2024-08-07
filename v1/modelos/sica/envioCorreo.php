<?php
include_once 'utilidades/Validador.php';
include_once 'utilidades/Request.php';
include_once 'utilidades/Correo.php';

class envioCorreo{
    const NOMBRE_TABLA = "usuario";
    const USR_ID = "usr_id";
    const USR_LOGIN = "usr_login";
    const USR_NOMBRES = "usr_nombres";
    const USR_PWD = "usr_pwd";
    const USR_CORREO = "usr_correo";
    const USR_ACTIVO = "usr_activo";
    
    const USR_AVATAR = "usr_avatar";

    const USR_CREADO = "usr_creado";
    const USR_MODIFICADO = "usr_modificado";
    const USR_ROL = "usr_rol";
    const ID_SISTEMA = "id_sistema";


    const ESTADO_CREACION_EXITOSA = 1;
    const ESTADO_CREACION_FALLIDA = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_AUSENCIA_CLAVE_API = 4;
    const ESTADO_CLAVE_NO_AUTORIZADA = 5;
    const ESTADO_URL_INCORRECTA = 6;
    const ESTADO_FALLA_DESCONOCIDA = 7;
    const ESTADO_PARAMETROS_INCORRECTOS = 8;
    const ESTADO_NO_ENCONTRADO = 9;
    const ESTADO_ERROR_PARAMETROS = 10;

    const USR_CAMPOS = array(
        self::USR_LOGIN,
        self::USR_NOMBRES,
        self::USR_PWD,
        self::USR_CORREO,
        self::USR_ACTIVO,
        self::USR_ROL,
        self::ID_SISTEMA,
    );

	/**
     * Método POST
     *
     * @param [array] $peticion Contiene un arreglo con la petición de la solicitud y envio del correo
     * @return array Devuelve un array con el resultado de la solicitud
     */
	public static function  post($peticion)
	{
		switch ($peticion[0]) {
			case 'enviarCo':
			return self::enviarCorreo();
			break;
			default:
			throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
			break;
		}
	}
	private static function enviarCorreo()
{
    Validador::obtenerInstancia()->validaToken();
    $correo = $_POST['usr_correo']; // Accede al correo desde el formulario.
    $correo2 = $_POST['usr_correo2']; // Accede al segundo correo
    $nombre = $_POST['nombre_remitente']; // Accede al nombre del remitente
    $correoRe = $_POST['remitente_correo']; // Accede al correo del remitente
    $asunto = $_POST['asunto_correo']; // Asunto principal del correo
    $cuerpo = $_POST['descripcion_correo']; // Accede a la descripción del correo
    $comprobante = $_POST['comprobante'];
	
    $isEmailValid1 = UtilidadesApi::obtenerInstancia()->validaCorreoElectronico($correo);
    $isEmailValid2 = UtilidadesApi::obtenerInstancia()->validaCorreoElectronico($correo2);

    if ($isEmailValid1 || $isEmailValid2) {
        // Procesa el archivo adjunto
        if (isset($_FILES['archivo_adjunto'])) {
            $uploadedFile = $_FILES['archivo_adjunto'];
            $fileName = $uploadedFile['name'];
            $tmpName = $uploadedFile['tmp_name'];

            // Genera un nombre único para el archivo adjunto
            $nombreAdjunto = uniqid() . '_' . $fileName;

            // Mueve el archivo temporal a una ubicación deseada con el nombre único
            $destinationPath = 'vendor/' . $nombreAdjunto; // Ajusta la ruta según tu estructura de directorios
            move_uploaded_file($tmpName, $destinationPath);

            // Envía el correo con el archivo adjunto y la descripción
            Correo::obtenerInstancia()->enviarCorreoConAdjunto($correo, $correo2, $nombre, $correoRe, $asunto, $cuerpo, $comprobante, $destinationPath, $nombreAdjunto);

            return array(
                "estado" => 1,
                "mensaje" => "Correo enviado con éxito"
            );
        }

        return array(
            "estado" => 1,
            "mensaje" => "Correo enviado con éxito, pero no se adjuntó ningún archivo"
        );
    }

    throw new ExcepcionApi(2, "Ninguno de los correos es válido", 400);
}

    /**
     * Verifica la existencia de un correo
     *
     * Verifica si un usuario existe en la base de datos a traves de su correo electronico
     *
     * @param string $correo Contiene el correo que del cual se desea comprobar su existencia
     *
     * @return bool True si se ecuentra el correo, False si no se encuentra el correo
     */
    private static function verificaExistencia($login)
    {
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            //$consulta = "SELECT " . self::USR_ID  . " FROM " . self::NOMBRE_TABLA . " WHERE " . self::USR_CORREO . "=:usr_correo";
            $consulta = "SELECT " . self::USR_ID  . " FROM " . self::NOMBRE_TABLA . " WHERE " . self::USR_LOGIN . "=:usr_login";
            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(':usr_login', $login, PDO::PARAM_STR);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }


}