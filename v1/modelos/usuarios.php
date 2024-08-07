<?php

include_once 'utilidades/Validador.php';
include_once 'utilidades/Request.php';
include_once 'utilidades/Correo.php';
class Usuarios
{
    // Datos de la tabla "usuario"
    const NOMBRE_TABLA = "usuario";
    const USR_ID = "usr_id";
    const USR_LOGIN = "usr_login";
    const USR_NOMBRES = "usr_nombres";
    const USR_PWD = "usr_pwd";
    const USR_CORREO = "usr_correo";
    const USR_ACTIVO = "usr_activo";
    
    const USR_AVATAR = "usr_avatar";
    const URL_AVATAR = "https://api.shuttleexpressmexico.com.mx/imagenes/";

    const USR_CREADO = "usr_creado";
    const USR_MODIFICADO = "usr_modificado";
    const USR_ROL = "usr_rol";
    const ID_SISTEMA = "id_sistema";



    //const CLAVE_API = "claveApi";
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
     * Método get: Obtener usuarios
     *
     * @param [array] $peticion Contiene las peticiones de la solicitud
     * @return array Devuelve un array con el resultado de la solicitud
     */
    public static function get($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        if (!empty($peticion[0])) {
            if (is_numeric($peticion[0])) {
                return self::obtenerUsuarios($peticion[0]);
            } elseif ($peticion[0] === "filtro") {
                return self::obtenerUsuariosFiltro();
            }
            throw new ExcepcionApi(2, "No existe el recurso: " . $peticion[0], 400);
        }

        return self::obtenerUsuarios($peticion[0]);
    }


    /**
     * Método POST
     *
     * @param [array] $peticion Contiene un arreglo con la petición de la solicitud
     * @return array Devuelve un array con el resultado de la solicitud
     */
    public static function  post($peticion)
    {
        switch ($peticion[0]) {
            case 'registro':
                return self::registrar();
                break;
            case 'login':
                return self::loguear();
                break;
                // case 'cambiopass':
                //     return self::cambiarPaswd();
                //     break;
            case 'avatar':
                return self::actualizaAvatar();
                break;
            case 'invitacion':
                return self::invitarUsuario();
                break;
                // case 'reinicio':
                //     return self::reiniciarPasw();
                //     break;
                // case 'nueva':
                //     return self::reiniciarPasw();
                //     break;
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
    }

    public static function put($peticion)
    {
        Validador::obtenerInstancia()->validaToken();

        if (!empty($peticion[0])) {
            if (self::actualizarUsuario($peticion[0]) > 0) {
                return array(
                    "estado" => 1,
                    "mensaje" => "Registro actualizado correctamente"
                );
            }
            throw new ExcepcionApi(2, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(2, "Falta información", 422);
    }

    /**
     * Método delete Inactiva un usuario en la base de datos
     *
     * @param [array] $peticion Contiene un array con la(s) petición(es) del cliente
     * @return object Devuelve un json con el resultado del método
     */
    public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        //$idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            if (self::eliminarUsuario($peticion[0]) > 0) {
                http_response_code(200);
                return array(
                    "estado" => 1,
                    "mensaje" => "El usuario ha sido eliminado con exito"
                );
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Error en los parámetros o parámetro ausente", 400);
    }

    /**
     * Obtiene usuario(s)
     *
     * Obtiene todos los usuarios o un usuario solamente por su id
     *
     * @param integer $idUsuario Contiene el id del usuario que se desea buscar (null si son todos)
     * @return array Devuelve un array con el resultado de la operación
     */
    private static function obtenerUsuarios($idUsuario = null)
    {
        try {

            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            $whereId = !empty($idUsuario) ? " WHERE " . self::USR_ID . "= :usr_id" : "";

            //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $consulta = "select usr_id, u.usr_login, u.usr_nombres, u.usr_correo,
            u.usr_activo,u.usr_creado,u.usr_modificado,u.login_times,u.last_login,
            u.usr_rol, rol.tipo_descripcion as nom_rol,
            u.id_sistema, s.sis_nomsistema,s.sis_nomsistema2, 
            s.sis_siglas, concat(s.sis_nomsistema, ' ', s.sis_nomsistema2) as sistema
            from usuario u
            left join tipo rol on u.usr_rol = rol.tipo_clave 
            left join sistema s on u.id_sistema = s.id_sistema " . $whereId;;
            $sentencia = $pdo->prepare($consulta);

            if (!empty($idUsuario)) {
                $sentencia->bindParam(":usr_id", $idUsuario, PDO::PARAM_INT);
            }
            // Ejecutar sentencia preparada
            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            //$mensaje .= !empty($idUsuario) ? " con ese Id" : " en la tabla";
            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"

            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    /**
     * Obtiene usuario(s)
     *
     * Obtiene uno o varios usurios segun el filtro aplicado
     *
     * @return array Devuelve un array con el resultado de la operación
     */
    private static function obtenerUsuariosFiltro()
    {
        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::USR_CAMPOS);

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'];
            //$consulta = "select usr_id, u.usr_login, u.usr_nombres, u.usr_correo,u.usr_pwd,
            $consulta = "select usr_id, u.usr_login, u.usr_nombres, u.usr_correo,
            u.usr_activo,u.usr_creado,u.usr_modificado,u.login_times,u.last_login,
            u.usr_rol, rol.tipo_descripcion as nom_rol,
            u.id_sistema, s.sis_nomsistema,s.sis_nomsistema2,
            s.sis_siglas, concat(s.sis_nomsistema, ' ', s.sis_nomsistema2) as sistema
            from usuario u
            left join tipo rol on u.usr_rol = rol.tipo_clave 
            left join sistema s on u.id_sistema = s.id_sistema " . $filtro['where'];
            $sentencia = $pdo->prepare($consulta);
            $sentencia->execute();

            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Registra usuario
     *
     * Crea un usuario en la base de datos para que pueda hacer uso de la aplicacion
     *
     * @param mixed body
     *
     * @return array Devuelve un array con el resultado de la solicitud.
     */
    private static function registrar()
    {
        $cuerpo = file_get_contents('php://input');
        $usuario = json_decode($cuerpo);

        if ($usuario) {
            $campos = self::USR_CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($usuario, $campos);

            $resultado = self::crear($usuario);
            http_response_code(201);
            return $resultado;
        }
        throw new ExcepcionApi(2, "Error en el cuerpo de la solicitud", 400);
    }

    /**
     * crear: Crea un usuario en la base de datos
     *
     * @param [array] $usuario Contiene un arreglo con toda la información necesaria para crear un usuario en la base de datos
     * @return integer Devuelve un entero con el estado del resultado de la solicitud
     */
    private static function crear($usuario)
    {
        $isEmailValid = UtilidadesApi::obtenerInstancia()->validaCorreoElectronico($usuario->usr_correo, $mensaje);
        $isValidPassword = UtilidadesApi::obtenerInstancia()->validaPwdStrong($usuario->usr_pwd, $mensaje);

        if (!$isEmailValid || !$isValidPassword) {
            throw new ExcepcionApi(self::ESTADO_PARAMETROS_INCORRECTOS, $mensaje, 200);
        }

        $usrLogin = htmlspecialchars(strip_tags($usuario->usr_login));
        $usrCorreo = htmlspecialchars(strip_tags($usuario->usr_correo));
        $usrNombres = htmlspecialchars(strip_tags($usuario->usr_nombres));
        $usrRol = htmlspecialchars(strip_tags($usuario->usr_rol));
        $usrPwd = password_hash($usuario->usr_pwd, PASSWORD_BCRYPT);
        $idSistema = htmlspecialchars(strip_tags($usuario->id_sistema));

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            $consulta = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                self::USR_LOGIN . "," .
                self::USR_NOMBRES . "," .
                self::USR_PWD . "," .
                self::USR_CORREO . "," .
                self::USR_ROL . "," .
                self::ID_SISTEMA . "," .
                self::USR_CREADO . ")" .
                " VALUES(:usr_login,:usr_nombres,:usr_pwd,:usr_correo,:usr_rol,:id_sistema,NOW())";

            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":usr_login", $usrLogin);
            $sentencia->bindParam(":usr_nombres", $usrNombres);
            $sentencia->bindParam(":usr_pwd", $usrPwd);
            $sentencia->bindParam(":usr_correo", $usrCorreo);
            $sentencia->bindParam(":usr_rol", $usrRol);
            $sentencia->bindParam(":id_sistema", $idSistema);
            //var_dump($sentencia);
            $sentencia->execute();
            $sentencia->closeCursor();
            return array(
                "estado" => 1,
                "mensaje" => "¡Registro creado con éxito!"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    /**
     * Actualiza usuario
     *
     * Actualiza la información del usuario
     *
     * @param integer $idUsr Contiene el id del usuario del que se desean actualizar los datos
     * @return array Devuelve un array con los resultados de la operación
     */
    private static function actualizarUsuario($idUsr)
    {
        $body = file_get_contents('php://input');
        $usuario = json_decode($body);

        if ($usuario) {
            $campos = self::USR_CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($usuario, $campos);

            $usrNombres = htmlspecialchars(strip_tags($usuario->usr_nombres));
            $usrCorreo = htmlspecialchars(strip_tags($usuario->usr_correo));
            $usrActivo = htmlspecialchars(strip_tags($usuario->usr_activo));
            $usrRol = htmlspecialchars(strip_tags($usuario->usr_rol));
            $idSistema = htmlspecialchars(strip_tags($usuario->id_sistema));

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET " .
                    self::USR_NOMBRES . " = :usr_nombres, " .
                    self::USR_CORREO . " = :usr_correo, " .
                    self::USR_MODIFICADO . " = NOW(), " .
                    self::USR_ROL . " = :usr_rol, " .
                    self::ID_SISTEMA . " = :id_sistema, " .
                    self::USR_ACTIVO . " = :usr_activo WHERE " .
                    self::USR_ID . " = :usr_id";

                $sentencia = $pdo->prepare($consulta);
                $sentencia->bindParam(":usr_nombres", $usrNombres, PDO::PARAM_STR);
                $sentencia->bindParam(":usr_correo", $usrCorreo, PDO::PARAM_STR);
                $sentencia->bindParam(":usr_id", $idUsr, PDO::PARAM_INT);
                $sentencia->bindParam(":usr_activo", $usrActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":usr_rol", $usrRol, PDO::PARAM_STR);
                $sentencia->bindParam(":id_sistema", $idSistema, PDO::PARAM_INT);
                $sentencia->execute();
                $resultado = $sentencia->rowCount();
                $sentencia->closeCursor();
                return $resultado;
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
        throw new ExcepcionApi(2, "Error en existencia o sintaxis de parámetros", 400);
    }

    /**
     * Inicio de sesión
     *
     * Inicio de sesión del usuario, comprueba el correo electrónico y la contraseña del usuario
     *
     * @return array Devuelve un array con informacion del resultado de la solicitud
     */
    private static function loguear()
    {
        $respuesta = array();
        $body = file_get_contents('php://input');
        $usuario = json_decode($body);

        if ($usuario) {
            //$campos = array('usr_correo', 'usr_pwd');
            $campos = array('usr_login', 'usr_pwd');
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($usuario, $campos);

            //$correo = $usuario->usr_correo;
            $login = $usuario->usr_login;
            $contrasena = $usuario->usr_pwd;

            if (self::autenticar($login, $contrasena, $resultado)) {
                $tokens = Validador::obtenerInstancia()->generaTokens($resultado);

                $respuesta["usr_id"] = $resultado["usr_id"];
                $respuesta["usr_nombres"] = $resultado["usr_nombres"];
                $respuesta["usr_correo"] = $resultado["usr_correo"];
                $respuesta["usr_login"] = $resultado["usr_login"];
                //$respuesta["usr_avatar"] = $resultado["usr_avatar"];
                $respuesta["jwt"] = $tokens['jwt'];
                $respuesta["expira"] = $tokens['expira'];
                $respuesta["rft"] = $tokens['rft'];
                $respuesta["usr_rol"] = $resultado["usr_rol"];
                $respuesta["nom_rol"] = $resultado["nom_rol"];

                $respuesta["id_sistema"] = $resultado["id_sistema"];
                $respuesta["sis_nomsistema"] = $resultado["sis_nomsistema"];
                $respuesta["sis_nomsistema2"] = $resultado["sis_nomsistema2"];
                $respuesta["sis_siglas"] = $resultado["sis_siglas"];

                http_response_code(200);
                return array(
                    "estado" => self::ESTADO_CREACION_EXITOSA,
                    "usuario" => $respuesta
                );
            }
            throw new ExcepcionApi(self::ESTADO_PARAMETROS_INCORRECTOS, "Inicio de sesión no valido");
        }
        throw new ExcepcionApi(2, "Error en el cuerpo de la solicitud", 400);
    }

    /**
     * Actualiza avatar
     *
     * Carga una imagen del avatar del usuario, la copia en un directorio y actualiza la información en la
     * base de datos
     *
     * @param mixed El id del usuario a actualizar viene incluido en el jwt y la imagen en el $_FILES
     * @return array Devuelve un array con el resultado de la operación
     */
    private static function actualizaAvatar()
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();
        $usr = (array) $validaToken['data'];
        $usrId = $usr['id'];

        $ruta = "../imagenes";
        $request = new Request();

        // $original = $request->files['imagen']['name'];
        $temporal = $request->files['imagen']['tmp_name'];
        $tipo = $request->files['imagen']['type'];
        // $size = $request->files['imagen']['size'];
        $uuid = UtilidadesApi::obtenerInstancia()->uuid();
        $split = explode("/", $tipo);
        $nombre = $uuid . "." . $split[1];

        if (!move_uploaded_file($temporal, $ruta . "/" .  $nombre)) {
            throw new ExcepcionApi(2, "No pudo cargar la imagen", 500);
        }

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            $url = self::URL_AVATAR . $nombre;

            $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET " . self::USR_AVATAR . " = :usr_avatar WHERE " . self::USR_ID . " = :usr_id";
            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":usr_avatar", $url);
            $sentencia->bindParam(":usr_id", $usrId);
            $sentencia->execute();
            $resultado = $sentencia->rowCount();
            $sentencia->closeCursor();
            if ($resultado <= 0) {
                throw new ExcepcionApi(2, "No se actualizo la imagen", 500);
            }
            return array(
                "estado" => 1,
                "mensaje" => "La imagen se actualizo con éxito",
                "url" => $url
            );
        } catch (PDOException $e) {
        }



        return array(
            "estado" => 1,
            "mensaje" => "Todo bien"
        );
    }

    /**
     * autenticar.- Verifica que exista el correo y verifica que la contraseñasean correcta
     *
     * @param [string] $correo Contiene el correo que se desea verificar que exista
     * @param [stri] $contrasena Contiene la contraseña a verificar
     * @return bool
     */
    private static function autenticar($login, $contrasena, &$resultado = null)
    {

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
            //$consulta = "SELECT " . self::USR_ID . ", " . self::USR_NOMBRES . ", " . self::USR_LOGIN . ", " . self::USR_CORREO .  ", " . self::USR_ROL .  ", " . self::USR_PWD .  " FROM " . self::NOMBRE_TABLA . " WHERE " . self::USR_LOGIN . "=:usr_login";
            $consulta = "select u.usr_id, u.usr_login, u.usr_nombres, u.usr_correo,u.usr_pwd,
            u.usr_activo,u.usr_creado,u.usr_modificado,u.login_times,u.last_login,
            u.usr_rol, rol.tipo_descripcion as nom_rol,
            u.id_sistema, s.sis_nomsistema,s.sis_nomsistema2, s.sis_siglas
            from usuario u
            left join tipo rol on u.usr_rol = rol.tipo_clave 
            left join sistema s on u.id_sistema = s.id_sistema " . " WHERE u.usr_login ". "=:usr_login";

            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(':usr_login', $login, PDO::PARAM_STR);
            $sentencia->execute();

            $rows = $sentencia->rowCount();
            if ($rows == 0) {
                throw new ExcepcionApi(8, "No existe el usuario", 401);
            }
            $resultado['usr_login'] = $login;
            $resultado = $sentencia->fetch();
            $sentencia->closeCursor();

            $isValidPassword = self::validarContrasena($contrasena, $resultado['usr_pwd']);
            if ($isValidPassword) {
                return true;
            }
            throw new ExcepcionApi(2, "Contraseña Incorrecta!", 401);
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    /**
     * Invita a un usuario
     *
     * Invita a un usuario para registrarse a traves de su correo electrónico
     *
     * @param mixed usr_correo en el body de la petición
     *
     * @return array Devuelve un arreglo con el resultado de la operación
     */
    private static function invitarUsuario()
    {
        Validador::obtenerInstancia()->validaToken();
        $body = file_get_contents('php://input');
        $json = json_decode($body);
        $correo = $json->usr_correo;
        $isEmailValid = UtilidadesApi::obtenerInstancia()->validaCorreoElectronico($correo);
        if ($isEmailValid) {
            $isEmailExist = self::verificaExistencia($correo);
            if (!$isEmailExist) {
                $token = UtilidadesApi::obtenerInstancia()->uuid();
                $invitacion = Correo::obtenerInstancia()->invitarUsuario($correo, $token);
                if ($invitacion) {
                    $isSave = self::guardaInvitacion($correo, $token);
                    http_response_code(200);
                    if ($isSave) {
                        return array(
                            "estado" => 1,
                            "mensaje" => "Se envio la invitacion a " . $correo
                        );
                    }
                    return array(
                        "estado" => 1,
                        "mensaje" => "Se envió la invitación a " . $correo . " pero no pudo guardarse, consulte al administrador"
                    );
                }
                throw new ExcepcionApi(2, "No se pudo enviar la invitacion a " . $correo);
            }
            throw new ExcepcionApi(2, "Este correo a esta en uso", 200);
        }
        throw new ExcepcionApi(2, "Correo electrónico invalido", 400);
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

    /**
     * Guarda la invitación
     *
     * Guarla la información de la invitación para registrarse enviada al usuario
     *
     * @param string $correo Contiene el correo electrónico del usuario que fue invitado a registrarse
     * @param string $token Contiene el token que se genero para validar la invitación
     * @return bool True si se pudo guardar, False si no se pudo guardar
     */
    private static function guardaInvitacion($correo, $token)
    {
        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            $consulta = "INSERT INTO invitacion_registro (usr_correo, token) VALUES (:usr_correo,:token) ON DUPLICATE KEY UPDATE token = :token";
            $sentencia = $pdo->prepare($consulta);
            $sentencia->bindParam(":usr_correo", $correo);
            $sentencia->bindParam(":token", $token);
            $sentencia->execute();
            $sentencia->closeCursor();
            return true;
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    /**
     * Valida contraseña
     *
     * Valida que la contraseña proporcionada por el usuario sea su contraseña
     *
     * @param [string] $contrasena Contiene la contraseña proporcionada por el usuario
     * @param [string] $resultado Contiene la contraseña guardada en la base de datos
     * @return bool
     */
    private static function validarContrasena($contrasena, $resultado)
    {
        return password_verify($contrasena, $resultado);
    }
    /**
     * Cambia el valor del campo activo de un Tipo a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminarUsuario($idUsuario)
    {
        //$TipoModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::USR_ACTIVO . " = 0 , " .
            self::USR_MODIFICADO . " = NOW() " .
            " WHERE " . self::USR_ID . " = :usr_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":usr_id", $idUsuario, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//FIN DE LA CLASE
