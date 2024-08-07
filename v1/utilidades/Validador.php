<?php
require_once 'libs/php-jwt/src/JWT.php';

class Validador
{
    const NOMBRE_TABLA_USR = "usuario";
    private static $validador = null;


    final private function __construct()
    {
        //error_log("Construyo un" . __CLASS__ . "nuevo");
    }

    public static function obtenerInstancia()
    {
        if (self::$validador === null) {
            self::$validador = new self();
        }
        return self::$validador;
    }

    /**
     * Valida la autenticidad y la validez del json web token
     * @category Validación
     *
     * @return array 
     * Si el token no es valido o la caduco devuelve falso
     */
    public function validaToken()
    {
        $cabeceras = apache_request_headers();
        // foreach ($cabeceras as $header => $value) {
        //     error_log("$header: $value <br />\n") ;
        // }
        $jwt = isset($cabeceras["Authorization"]) ? $cabeceras["Authorization"] : "";

        // Elimna el estandar Bearer
        $jwt = str_replace("Bearer ", "", $jwt);

        if ($jwt) {
            try {
                $decodeJWT = new JWT();
                $decoded = $decodeJWT->decode($jwt, "example_key", array('HS256'));

                if ($decoded->aud !== self::obtenerAud()) {
                    throw new ExcepcionApi(2, "Acceso denegado.", 401);
                }

                return array(
                    "valido" => true,
                    "mensaje" => "Acceso autorizado.",
                    "exp" => $decoded->exp,
                    "data" => $decoded->data
                );
            } catch (Exception $e) {
                throw new ExcepcionApi(2, $e->getMessage(), 401);
            }
        }
        throw new ExcepcionApi(2, "Token ausente o no válido.", 401);
    }

    public function generaTokens($usuario)
    {
        $jwt = $this->generaJWT($usuario);
        $rft = uniqid('', true);

        $this->guardaRefreshToken($usuario["usr_id"], $rft);

        return array(
            "jwt" => $jwt,
            "rft" => $rft,
            //"expira" => (60 * 30)
            "expira" => (60 * 60)
        );
    }

    /**
     * Undocumented function
     *
     * @param [type] $usuario
     * @return void
     */
    public function generaJWT($usuario)
    {
        $hora = time();
        $codeJWT = new JWT();
        $token = array(
            "iss" => "http://shuttleexpressmexico.com",
            "aud" => self::obtenerAud(),
            "iat" => $hora,
            "nbf" => $hora,
            //"exp" => $hora + (60 * 30),
            "exp" => $hora + (60 * 60),
            "data" => array(
                "id" => $usuario["usr_id"],
                "name" => $usuario["usr_nombres"],
                //"lastname" => $usuario["usr_apellidos"],
                "email" => $usuario['usr_correo'],
                "rol" => $usuario["usr_rol"],
            )
        );
        $jwt = $codeJWT->encode($token, "example_key");
        return $jwt;
    }

    public function obtenerAud()
    {
        $aud = '';
        $serverIp = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP', FILTER_SANITIZE_STRING);
        $serverForwarded = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', FILTER_SANITIZE_STRING);
        $serverRemote = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
        $serverUser = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);

        $aud = $serverRemote;

        if (!empty($serverIp)) {
            $aud = $serverIp;
        } elseif (!empty($serverForwarded)) {
            $aud = $serverForwarded;
        }

        $aud .= @$serverUser;
        $aud .= gethostname();

        return sha1($aud);
    }

    public function guardaRefreshToken($usrId, $rft)
    {
        $date = new DateTime();
        $date->modify('+1 day');
        $expira = $date->format('Y-m-d H:i:s');;
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            // Aumenta el contador de logins y la fecha del ultimo logueo
            //usuario.login.loginTimes += 1
            //usuario.login.lastLogin = new Date()

            $consulta = "INSERT INTO refresh_token (usr_id, token, expira) 
                        VALUES (:usr_id, :rft, :expira) 
                        ON DUPLICATE KEY UPDATE token = :rft, expira = :expira";

            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":usr_id", $usrId);
            $sentencia->bindParam(":rft", $rft);
            $sentencia->bindParam(":expira", $expira);
            $sentencia->execute();
            $sentencia->closeCursor();

            // Aumenta el contador de logins y la fecha del ultimo logueo
            //$consultaUsr = "UPDATE . self::NOMBRE_TABLA_USR . set login_times = login_times + 1, last_login = CURRENT_TIMESTAMP(6) where usr_id = :usr_id";
            $consultaUsr = "UPDATE " . self::NOMBRE_TABLA_USR . " set login_times = login_times + 1, last_login = CURRENT_TIMESTAMP(6) where usr_id = :usr_id";
            $sentencia = $pdo->prepare($consultaUsr);
            $sentencia->bindParam(":usr_id", $usrId);
            $sentencia->execute();
            $sentencia->closeCursor();


            //usuario.login.loginTimes += 1
            //usuario.login.lastLogin = new Date()

            return;
        } catch (PDOException $e) {
            throw new ExcepcionApi(2, $e->getMessage(), 400);
        }
    }

    final protected function __clone()
    {
    }
}
