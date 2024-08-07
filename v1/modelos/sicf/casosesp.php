<?PHP
class casosEsp
{
    const NOMBRE_TABLA = "casos_especiales";
    
    const CE_CONCEPTO_NP = "ce_concepto_NP";
    const CE_CONCEPTO_P = "ce_concepto_P";
    const CE_FALTANTE = "ce_faltante";
    const CE_EXCEDENTE = "ce_excedente";
    const CE_CONCEPTO_EXCEDENTE = "ce_concepto_excedente";
    const CE_ACTIVO = "ce_activo";
    const CE_CREADO_EL = "ce_creado_el";
    const CE_CREADO_POR = "ce_creado_por";
    const CE_MODIFICADO_EL = "ce_modificado_el";
    const CE_MODIFICADO_POR = "ce_modificado_por";


    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::CE_CONCEPTO_NP,
        self::CE_CONCEPTO_P,
        self::CE_FALTANTE,
        self::CE_EXCEDENTE,
        self::CE_CONCEPTO_EXCEDENTE,
        self::CE_ACTIVO
    );
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de clasificacion de tipo
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
     * Método PUT Actualiza una clasificacion de tipo en la base de datos
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
     * Método delete Inactiva una clasificacion de tipo en la base de datos
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
                    "mensaje" => "La clasificación de tipo ha sido eliminado con exito"
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
     * Obtiene uno o varios registros de clasificacion de tipo de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la clasificacion de tipo que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::CE_CONCEPTO_NP . "= :ce_concepto_NP" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = "select ce.ce_concepto_NP, ce.ce_concepto_P, ce.ce_faltante, ce.ce_excedente,
            ce.ce_concepto_excedente, ifnull(coex.tipo_descripcion, 'SIN DATO') as desc_concepto_excedente,
            case when coex.clatip_id = 'SOLP' then 1 else 2 end as tipo_sol_excedente,
            coex.clatip_id, ce.ce_activo, ce.ce_creado_el, ce.ce_creado_por
            from casos_especiales ce
            left join tipo coex on ce.ce_concepto_excedente = coex.tipo_id " . $whereId;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":ce_concepto_NP", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de clasificacion de tipo de acuerdo a criterios de filtrado
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

        //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'];
        $consulta = "select ce.ce_concepto_NP, ce.ce_concepto_P, ce.ce_faltante, ce.ce_excedente,
        ce.ce_concepto_excedente, ifnull(coex.tipo_descripcion, 'SIN DATO') as desc_concepto_excedente,
        case when coex.clatip_id = 'SOLP' then 1 else 2 end as tipo_sol_excedente,
        coex.clatip_id, ce.ce_activo, ce.ce_creado_el, ce.ce_creado_por
        from casos_especiales ce
        left join tipo coex on ce.ce_concepto_excedente = coex.tipo_id " . $filtro['where'];


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
     * Crea un clasificacion de tipo en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la clasificacion de tipo
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
            $conceptoNP = htmlspecialchars(strip_tags($datos->ce_concepto_NP));
            $conceptoP = htmlspecialchars(strip_tags($datos->ce_concepto_P));
            $faltante = htmlspecialchars(strip_tags($datos->ce_faltante));
            $excedente = htmlspecialchars(strip_tags($datos->ce_excedente));
            $conceptoExcedente = htmlspecialchars(strip_tags($datos->ce_concepto_excedente));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::CE_CONCEPTO_NP . ", " .
                    self::CE_CONCEPTO_P . ", " .
                    self::CE_FALTANTE . ", " .
                    self::CE_EXCEDENTE . ", " .
                    self::CE_CREADO_EL . ", " .
                    self::CE_CREADO_POR . ")" .
                    " VALUES(:ce_concepto_NP,:ce_concepto_P,:ce_faltante,:ce_excedente,:ce_concepto_excedente,CURRENT_TIMESTAMP(6),:ce_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":ce_concepto_NP", $conceptoNP, PDO::PARAM_STR);
                $sentencia->bindParam(":ce_concepto_P", $conceptoP, PDO::PARAM_STR);
                $sentencia->bindParam(":ce_faltante", $faltante, PDO::PARAM_STR);
                $sentencia->bindParam(":ce_excedente", $excedente, PDO::PARAM_STR);
                $sentencia->bindParam(":ce_concepto_excedente", $conceptoExcedente, PDO::PARAM_STR);
                $sentencia->bindParam(":ce_creado_por", $CreadoPor, PDO::PARAM_INT);
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

            $clatipDescripcion = htmlspecialchars(strip_tags($datos->clatip_descripcion));
            $clatipActivo = htmlspecialchars(strip_tags($datos->clatip_activo));
            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::CLATIP_DESCRIPCION . "= :clatip_descripcion, " .
                    self::CLATIP_ACTIVO . "= :clatip_activo, " .
                    self::CLATIP_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::CLATIP_MODIFICADO_POR . "= :clatip_modificado_por " .
                    " WHERE " . self::CLATIP_ID . "= :clatip_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":clatip_descripcion", $clatipDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":clatip_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":clatip_activo", $clatipActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":clatip_id", $id, PDO::PARAM_STR);
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
     * Cambia el valor del campo activo de una clasificacion de tipo a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::CLATIP_ACTIVO . " = 0, " .
            self::CLATIP_MODIFICADO_POR . "= :clatip_modificado_por, " .
            self::CLATIP_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::CLATIP_ID . " = :clatip_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":clatip_id", $id, PDO::PARAM_STR);
            $sentencia->bindParam(":clatip_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
