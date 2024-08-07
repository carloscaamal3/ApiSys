<?php

include_once 'utilidades/Correo.php';

/**
 * Password
 * 
 * Realiza todas las operaciones necesarias para el
 * manejo de contraseñas.
 * Permite cambiar la contraseña, enviar correos para 
 * reinicios de contraseñas, reinciar las contraseñas
 * Todo a traves de un jwt válido
 * 
 * @author Roger Gala 
 */
class Password
{
    const NOMBRE_TABLA = "usuario";
    const USR_ID = "usr_id";
    const USR_NOMBRES = "usr_nombres";
    //const USR_APELLIDOS = "usr_apellidos";
    const USR_CORREO = "usr_correo";
    const USR_PWD = "usr_pwd";
    const USR_TELEFONO = "usr_telefono";
    const USR_ACTIVO = "usr_activo";
    const USR_AVATAR = "usr_avatar";
    const URL_AVATAR = "https://api.shuttleexpressmexico.com.mx/imagenes/";
    const ESTADO_CREACION_EXITOSA = 1;
    const ESTADO_CREACION_FALLIDA = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_AUSENCIA_CLAVE_API = 4;
    const ESTADO_CLAVE_NO_AUTORIZADA = 5;
    const ESTADO_URL_INCORRECTA = 6;
    const ESTADO_FALLA_DESCONOCIDA = 7;
    const ESTADO_PARAMETROS_INCORRECTOS = 8;

    public static function get()
    {
    }

    /**
     * POST
     * 
     * Manejador de todas las peticiones POST de la API
     *
     * @param array $peticion Contiene un array con la(s) petición(es) realizada(s) a la API
     * @return array Arreglo con el resultado de la peticion solicitada
     */
    public static function post($peticion)
    {

        switch ($peticion[0]) {
            case 'correo':
                return self::enviarCorreoReinicio();
                break;
            case 'cambio':
                return self::cambiarPassword();
                break;
            case 'reinicio':
                return self::reiniciarPassword();
                break;
            default:
                throw new ExcepcionApi(2, "No existe la peticion, 404");
                break;
        }
    }

    public static function put()
    {
    }

    public static function delete()
    {
    }

    /**
     * Envia correo electrónico
     * 
     * Envia un correo electrónico con un link a una url segura para que el usuario pueda reiniciar su contraseña
     *
     * @return void
     */
    private static function enviarCorreoReinicio()
    {
        //$isValidToken = Validador::obtenerInstancia()->validaToken();
        $body =  file_get_contents('php://input');
        $usuario = json_decode($body);
        if ($usuario) {
            $correo = $usuario->usr_correo;

            $isValidEmail = UtilidadesApi::obtenerInstancia()->validaCorreoElectronico($correo);
            if ($isValidEmail) {
                $isEmailExist = self::verificaExistenciaCorreo($correo);
                if ($isEmailExist) {
                    $token = UtilidadesApi::obtenerInstancia()->uuid();
                    $ifEnviado = Correo::obtenerInstancia()->enviarReinicio($correo, $token);
                    if ($ifEnviado) {
                        return array(
                            "estado" => 1,
                            "mensaje" => "El correo se envió con éxito"
                        );
                    }
                    throw new ExcepcionApi(2, "No pudo enviarse el correo, consulte al administrador", 400);
                }
                throw new ExcepcionApi(2, "Este usuario no existe", 400);
            }
            throw new ExcepcionApi(2, "Correo electrónico no válido");
        }
        throw new ExcepcionApi(2, "La petición no contiene cuerpo", 401);
    }

    /**
     * cambiarPassword: Cambia la contraseña actual por una contraseña nueva
     *
     * @return array Devuelve un array con el resultado de la solicitud
     */
    private static function cambiarPassword()
    {
        $isValidRequest = self::validaPeticionAuthBody($body, $info);
        if ($isValidRequest) {
            $usuario = json_decode($body);
            //$info = (array) $isValidToken['data'];
            $correo = $info['email'];
            $actual = $usuario->contrasena_actual;
            $nueva = $usuario->contrasena_nueva;

            if ($actual === $nueva) {
                throw new ExcepcionApi(2, "La contraseña nueva no puede ser igual a la anterior", 400);
            }

            $isValid = self::autenticar($correo, $actual);
            if ($isValid) {
                $isSaved = self::guardaPWD($correo, $nueva, $mensaje);
                if ($isSaved) {
                    return array(
                        "estado" => 1,
                        "mensaje" => $mensaje
                    );
                }
                throw new ExcepcionApi(2, $mensaje, 400);
            }
            throw new ExcepcionApi(2, "Error al autenticar usuario", 401);
        }
    }


    /**
     * Reinicia contraseña
     * 
     * Reinicia la contraseña de un usuario de acuerdo a su correo electrónico.
     *
     * @return array Array con el resultado de la operación
     */
    private static function reiniciarPassword()
    {
        $isValidRequest = self::validaPeticionAuthBody($body);
        if ($isValidRequest) {
            $usuario = json_decode($body);
            $campos = array('usr_correo', 'usr_pwd');
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($usuario, $campos);
            $correo = $usuario->usr_correo;
            $password = $usuario->usr_pwd;

            $isPasswordChanged = self::guardaPWD($correo, $password, $mensaje);
            if ($isPasswordChanged) {
                http_response_code(200);
                return
                    [
                        "estado" => self::ESTADO_CREACION_EXITOSA,
                        "mensaje" => $mensaje,
                    ];
            }
            throw new ExcepcionApi(2, $mensaje, 200);
        }
    }

    /**
     * Verifica que el correo electrónico exista en la base de datos
     *
     * @param [string] $correo Contiene el correo electrónico que se desea verificar
     * @return bool Devuelve True si el correo existe y false si el correo no existe
     */
    private static function verificaExistenciaCorreo($correo)
    {
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            $consulta = "SELECT " . self::USR_ID  . " FROM " . self::NOMBRE_TABLA . " WHERE " . self::USR_CORREO . "=:usr_correo";
            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(':usr_correo', $correo, PDO::PARAM_STR);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    /**
     * Guarda contraseña
     * 
     * Guarda la nueva contraseña en la base de datos
     *
     * @param string $correo Contiene el correo del usuario al que se le cambiara la contraseña
     * @param string $nueva Contiene la nueva contraseña del usuario
     * @param string $mensaje Sirve para enviar el mensaje de respuesta a la funcion que llame esta funcion
     * @return bool True si se guardo la contraseña, False si no se guardo la contraseña
     */
    private static function guardaPWD($correo, $nueva, &$mensaje)
    {
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            if (!UtilidadesApi::obtenerInstancia()->validaPwdStrong($nueva, $mensaje)) {
                return false;
            }

            $passwd = password_hash($nueva, PASSWORD_BCRYPT);
            $consulta = "UPDATE self::NOMBRE_TABLA SET usr_pwd = :usr_pwd WHERE usr_correo = :usr_correo";

            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":usr_pwd", $passwd);
            $sentencia->bindParam(":usr_correo", $correo);
            $sentencia->execute();
            $rows = $sentencia->rowCount();
            $sentencia->closeCursor();
            if ($rows == 0) {
                $mensaje = "¡El usuario no existe!";
                return false;
            }
            $mensaje = "¡La contraseña se actualizo con éxito!";
            return true;
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Autentica con correo y contraseña
     * 
     * Verifica que exista el correo y  en caso de existir verifica que la contraseña sea correcta
     *
     * @param [string] $correo Contiene el correo que se desea verificar que exista
     * @param [stri] $contrasena Contiene la contraseña a verificar
     * @return bool Devuelve true si el correo existe y la contraseña es correcta
     */
    private static function autenticar($correo, $contrasena, &$resultado = null)
    {
        $comando = "SELECT " . self::USR_ID . ", " . self::USR_NOMBRES . ", " . self::USR_CORREO .  ", " . self::USR_PWD . ", " . self::USR_AVATAR . " FROM " . self::NOMBRE_TABLA . " WHERE " . self::USR_CORREO . "=:usr_correo";
        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            $sentencia->bindParam(':usr_correo', $correo, PDO::PARAM_STR);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                throw new ExcepcionApi(8, "No existe el usuario", 401);
            }
            $resultado['usr_correo'] = $correo;
            $resultado = $sentencia->fetch();
            $sentencia->closeCursor();

            $isValidPassword = password_verify($contrasena, $resultado['usr_pwd']);

            if ($isValidPassword) {
                return true;
            }
            throw new ExcepcionApi(2, "Contraseña Incorrecta!", 401);
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    /**
     * Valida la petición
     * 
     * Valída la petición para ver si contiene en los headers un <b>jwt</b> válido
     * así como el cuerpo de la petición
     *
     * @access private
     * @param string $body Variable referenciada para obtener el body en caso de estar en la petición
     * @param string $info Variable referenciada para obtener la información del usuario contenida en el jwt
     * @return bool True si la petición es valida, si no es válida dispara una excepción
     */
    private static function validaPeticionAuthBody(&$body, &$info = null)
    {
        $isValidToken = Validador::obtenerInstancia()->validaToken();
        if ($isValidToken) {
            $info = (array) $isValidToken['data'];
            $body = file_get_contents("php://input");
            if ($body) {
                return true;
            }
            throw new ExcepcionApi(2, "La solicitud no contiene cuerpo", 400);
        }
        throw new ExcepcionApi(2, "Token inválido o ausente", 401);
    }
}
