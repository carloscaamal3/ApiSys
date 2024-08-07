<?PHP
class sistema
{
    const NOMBRE_TABLA = "sistema";
    const ID_SISTEMA = "id_sistema";
    const SIS_NOMSISTEMA = "sis_nomsistema";
    const SIS_NOMSISTEMA2 = "sis_nomsistema2";
    const SIS_SIGLAS = "sis_siglas";
    const SIS_ACTIVO = "sis_activo";
    const SIS_CREADO_POR = "sis_creado_por";
    const SIS_CREADO_EL = "sis_creado_el";
    const SIS_MODIFICADO_POR = "sis_modificado_por";
    const SIS_MODIFICADO_EL = "sis_modificado_el";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::ID_SISTEMA,
        self::SIS_NOMSISTEMA,
        self::SIS_NOMSISTEMA2,
        self::SIS_SIGLAS,
        self::SIS_ACTIVO
    );
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de Sistema
     *
     * @param [array] $peticion Contiene un array con la(s) petición(es) del cliente
     * @return object Devuelve un json con el resultado del método
     */
    public static function get($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        if (!empty($peticion[0])) {
            if (!is_numeric($peticion[0])) {
                return self::obtenerFiltro($peticion[0]);
            }
        }

        return self::obtener($peticion[0]);
    }
    /**
     * Metodo POST Crea un tipo en la base de datos
     *
     * @return object Devuelve un json con el resultado del método
     */
    public static function post()
    {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        $id = self::crear($idUsuario);

        http_response_code(201);
        return [
            "estado" => self::CODIGO_EXITO,
            "mensaje" => "¡Registro creado con éxito!",
            "id" => $id
        ];
    }
    /**
     * Método PUT Actualiza un Sistema en la base de datos
     *
     * @param [array] $peticion Contiene un array con la(s) petición(es) del cliente
     * @return array Devuelve un array con el resultado del método
     */
    public static function put($peticion)
    {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            $body = file_get_contents('php://input');
            $datos = json_decode($body);

            if (self::actualizar($datos, $peticion[0], $idUsuario) > 0) {
                http_response_code(200);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "Registro actualizado correctamente"
                ];
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Falta información", 422);
    }

    /**
     * Método delete Inactiva un Sistema en la base de datos
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

        $idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            if (self::eliminar($peticion[0], $idUsuario) > 0) {
                http_response_code(200);
                return array(
                    "estado" => 1,
                    "mensaje" => "El sistema ha sido eliminado con exito"
                );
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Error en los parámetros o parámetro ausente", 400);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //FUNCIONES
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Obtiene uno o varios registros de sistema de tipo de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la sistema de tipo que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::ID_SISTEMA . "= :id_sistema" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = "select id_sistema,sis_nomsistema,sis_nomsistema2,
            concat(sis_nomsistema, ' ', sis_nomsistema2) as sistema,
            sis_siglas,sis_activo,sis_creado_por,sis_creado_el,
            sis_modificado_por,sis_modificado_el from " . self::NOMBRE_TABLA . $whereId;
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":id_sistema", $id, PDO::PARAM_INT);
            }

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($id) ? " con ese Id" : " en la tabla: " .  self::NOMBRE_TABLA;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Obtiene uno o varios registros de Sistema de acuerdo a criterios de filtrado
     *
     * @param [string] $peticion Contiene la peticion a la API (filtro)
     * @return array Devuelve un array con los registros resultado del filtrado
     */
    private static function obtenerFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        $consulta = "select id_sistema,sis_nomsistema,sis_nomsistema2,
        concat(sis_nomsistema, ' ', sis_nomsistema2) as sistema,
        sis_siglas,sis_activo,sis_creado_por,sis_creado_el,
        sis_modificado_por,sis_modificado_el from " . self::NOMBRE_TABLA . $filtro['where'];

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            return array(
                "estado" => 1,
                "mensaje" => "No se encontraron registros"

            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    /**
     * Crea un Sistema en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la Sistema
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $sisNomsistema = htmlspecialchars(strip_tags($datos->sis_nomsistema));
            $sisNomsistema2 = htmlspecialchars(strip_tags($datos->sis_nomsistema2));
            $sisSiglas = htmlspecialchars(strip_tags($datos->sis_siglas));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::SIS_NOMSISTEMA . ", " .
                    self::SIS_NOMSISTEMA2 . ", " .
                    self::SIS_SIGLAS . ", " .
                    self::SIS_CREADO_EL . ", " .
                    self::SIS_CREADO_POR . ")" .
                    " VALUES(:sis_nomsistema,:sis_nomsistema2,:sis_siglas,CURRENT_TIMESTAMP(6),:sis_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":sis_nomsistema", $sisNomsistema, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_nomsistema2", $sisNomsistema2, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_siglas", $sisSiglas, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_creado_por", $CreadoPor, PDO::PARAM_INT);
                $sentencia->execute();
                // Retornar en el último id insertado
                return $pdo->lastInsertId();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            "Error en el cuerpo de la solicitud",
            400
        );
    }

    /**
     * Actualiza la información de un tipo
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizar($datos, $id, $idUsuario)
    {
        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $sisNomsistema = htmlspecialchars(strip_tags($datos->sis_nomsistema));
            $sisNomsistema2 = htmlspecialchars(strip_tags($datos->sis_nomsistema2));
            $sisSiglas = htmlspecialchars(strip_tags($datos->sis_siglas));
            $sisActivo = htmlspecialchars(strip_tags($datos->sis_activo));
            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SIS_NOMSISTEMA . "= :sis_nomsistema, " .
                    self::SIS_NOMSISTEMA2 . "= :sis_nomsistema2, " .
                    self::SIS_SIGLAS . "= :sis_siglas, " .
                    self::SIS_ACTIVO . "= :sis_activo, " .
                    self::SIS_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::SIS_MODIFICADO_POR . "= :sis_modificado_por " .
                    " WHERE " . self::ID_SISTEMA . "= :id_sistema";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sis_nomsistema", $sisNomsistema, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_nomsistema2", $sisNomsistema2, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_siglas", $sisSiglas, PDO::PARAM_STR);
                $sentencia->bindParam(":sis_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sis_activo", $sisActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":id_sistema", $id, PDO::PARAM_STR);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
            }
        }
        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            "Error en existencia o sintaxis de parámetros"
        );
    }
    /**
     * Cambia el valor del campo activo de un Sistema a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::SIS_ACTIVO . " = 0, " .
            self::SIS_MODIFICADO_POR . "= :sis_modificado_por, " .
            self::SIS_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::ID_SISTEMA . " = :id_sistema";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":id_sistema", $id, PDO::PARAM_STR);
            $sentencia->bindParam(":sis_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
