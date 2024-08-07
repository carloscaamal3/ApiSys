<?php
require_once 'libs/php-jwt/src/JWT.php';
include_once 'utilidades/Validador.php';
class Tokens
{
    const NOMBRE_TABLA_INVALID = "invalid_token";
    const NOMBRE_TABLA = "refresh_token";
    //const NOMBRE_VISTA = "vw_usr_refresh";
    const NOMBRE_VISTA = "vw_usuario_refresh";
    //const NOMBRE_VISTA = "usuario";
    const USR_ID = "usr_id";
    const TOKEN = "token";
    const EXPIRA = "expira";

    /**
     * Método post
     *
     * @param [array] $peticion Array con la petición
     * @return array Devuelve un array con resultados de la petición
     */
    public static function post($peticion)
    {
        if ($peticion[0] === "refresh") {
            return self::refrescaToken();
        } elseif ($peticion[0] === "invalida") {
            return self::invalidaToken();
        }
        throw new ExcepcionApi(2, "URL mal formada", 400);
    }

    /**
     * Genera un nuevo json web token a partir de un refresh token valido asignado al usuario
     *
     * @return array Devuelve un array con el resultado de la operación
     */
    private static function refrescaToken()
    {
        //$cabeceras = apache_request_headers();
        //$rft = isset($cabeceras["Authorization"]) ? $cabeceras["Authorization"] : "";

        $body = file_get_contents('php://input');
        $body_j = json_decode($body);
        $rft = htmlspecialchars(strip_tags($body_j->rft));

        //var_dump($rft);

        //die();
        if (!empty($rft)) {
            return self::validaRefreshToken($rft);
        }
        throw new ExcepcionApi(2, "Token ausente o no válido", 401);
    }

    /**
     * Invalida un json web token derivado del ciere de sesion.
     *
     * @return array Devuelve un array con el resultado de la operacion.
     */
    private static function invalidaToken()
    {
        $cabeceras = apache_request_headers();
        $jwt = isset($cabeceras["Authorization"]) ? $cabeceras["Authorization"] : "";

        if ($jwt) {
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
                $consulta = "INSERT INTO " . self::NOMBRE_TABLA_INVALID . " (jwt) VALUES ('" . $jwt . "')";
                $sentencia = $pdo->prepare($consulta);
                $sentencia->execute();
                http_response_code(200);
                return array(
                    "estado" => 1,
                    "mensaje" => "El token se invalido con éxito"
                );
            } catch (PDOException $e) {
                throw new ExcepcionApi(2, "No se pudo invalidar el token: " . $e->getMessage(), 400);
            }
        }
        throw new ExcepcionApi(2, "Token ausente, no se pudo invalidar el token", 400);
    }

    /**
     * Valida el estus del refresh token
     *
     * @param [string] $rft Contiene el valor del refresh token
     * @return array Devuelve un array con el resultado de la operacion <jwt> <expira>
     */
    private static function validaRefreshToken($rft)
    {
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            //$consulta = "SELECT * FROM " . self::NOMBRE_VISTA . " WHERE " . self::TOKEN . " = :token";
            $consulta = "SELECT * FROM " . self::NOMBRE_VISTA . " WHERE " . self::TOKEN . " = :token";

            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":token", $rft, PDO::PARAM_STR);
            $sentencia->execute();
            if ($sentencia->rowCount() > 0) {
                $resultado = $sentencia->fetch();
                $date = strtotime(date("Y-m-d H:i:s", time()));
                $expira = strtotime($resultado['expira']);

                if ($date < $expira) {
                    $jwt = Validador::obtenerInstancia()->generaJWT($resultado);
                    http_response_code(200);
                    return array(
                        "estado" => 1,
                        "jwt" => $jwt,
                        //"expira" => 1800
                        //"expira" => 3600
                        "expira" => 3600
                    );
                }
                http_response_code(401);
                return array(
                    "estado" => 2,
                    "mensaje" => "El token ha expirado"
                );
            }
            throw new ExcepcionApi(2, "Token invalido", 401);
        } catch (PDOException $e) {
            throw new ExcepcionApi(2, $e->getMessage(), 400);
        }
    }
}
