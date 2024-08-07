<?PHP
class cuentas
{
    const NOMBRE_TABLA = "cuenta_contable";
    const CUECON_CUENTA = "cuecon_cuenta";
    const PROV_ID = "c.prov_id";
    const TIPO_ID = "c.tipo_id";
    //const TIPO2_ID = "c.tipo2_id";
    const CUECON_ACTIVO = "cuecon_activo";
    const ES_MULTI_CONCEPTO = "es_multi_concepto";

    const CUECON_CREADO_POR = "cuecon_creado_por";
    const CUECON_CREADO_EL = "cuecon_creado_el";
    const CUECON_MODIFICADO_POR = "cuecon_modificado_por";
    const CUECON_MODIFICADO_EL = "cuecon_modificado_el";
    

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const PROV_ID_C = "prov_id";
    const TIPO_ID_C = "tipo_id";


    const CAMPOS = array(
        self::CUECON_CUENTA,
        self::PROV_ID,
        self::TIPO_ID,
        //self::TIPO2_ID,
        self::CUECON_ACTIVO,
        self::ES_MULTI_CONCEPTO
    );

    const CAMPOS_CREA = array(
        self::CUECON_CUENTA,
        self::PROV_ID_C,
        self::TIPO_ID_C,
        self::CUECON_ACTIVO,
        self::ES_MULTI_CONCEPTO
    );


    //c.tipo2_id,t2.tipo_descripcion as tipo2_descripcion,
    const SELECT = "select c.cuecon_cuenta,c.prov_id,p.prov_razon_social,c.tipo_id,t.tipo_descripcion,
    c.tipo2_id,t2.tipo_descripcion as tipo2_descripcion,c.es_multi_concepto, 
    c.cuecon_activo,c.cuecon_creado_por,c.cuecon_creado_el,c.cuecon_modificado_por,
    c.cuecon_modificado_el from ";

    const INNER = " c inner join proveedor p on c.prov_id = p.prov_id
    inner join tipo t on c.tipo_id = t.tipo_id
    left join tipo t2 on c.tipo2_id = t2.tipo_id";
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de cuenta contable
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
     * Método PUT Actualiza una cuenta contable en la base de datos
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
     * Método delete Inactiva una cuenta contable en la base de datos
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
                    "mensaje" => "La cuenta ha sido eliminado con exito"
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
     * Obtiene uno o varios registros de cuenta contable de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la cuenta contable que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::CUECON_CUENTA . "= :cuecon_cuenta" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":cuecon_cuenta", $id, PDO::PARAM_STR);
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
     * Obtiene uno o varios registros de cuenta contable de acuerdo a criterios de filtrado
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
        $consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER . $filtro['where'] . ' and c.cuecon_activo = 1';

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
     * Crea un cuenta contable en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la cuenta contable
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS_CREA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $tipoId = htmlspecialchars(strip_tags($datos->tipo_id));
            $esMultiConcepto= htmlspecialchars(strip_tags($datos->es_multi_concepto));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::CUECON_CUENTA . ", " .
                    self::PROV_ID_C . ", " .
                    self::TIPO_ID_C . ", " .
                    self::ES_MULTI_CONCEPTO . ", " .
                    self::CUECON_CREADO_EL . ", " .
                    self::CUECON_CREADO_POR . ")" .
                    " VALUES(:cuecon_cuenta,:prov_id,:tipo_id,:es_multi_concepto,CURRENT_TIMESTAMP(6),:cuecon_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_id", $tipoId, PDO::PARAM_INT);
                $sentencia->bindParam(":es_multi_concepto", $esMultiConcepto, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_creado_por", $CreadoPor, PDO::PARAM_INT);
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
            $campos = self::CAMPOS_CREA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            //VAR_DUMP($datos);
            //$cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $tipoId = htmlspecialchars(strip_tags($datos->tipo_id));
            $cueconActivo = htmlspecialchars(strip_tags($datos->cuecon_activo));
            $esMultiConcepto= htmlspecialchars(strip_tags($datos->es_multi_concepto));
            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::PROV_ID_C . "= :prov_id, " .
                    self::TIPO_ID_C . "= :tipo_id, " .
                    self::CUECON_ACTIVO . "= :cuecon_activo, " .
                    self::ES_MULTI_CONCEPTO . "= :es_multi_concepto, " .
                    self::CUECON_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::CUECON_MODIFICADO_POR . "= :cuecon_modificado_por " .
                    " WHERE " . self::CUECON_CUENTA . "= :cuecon_cuenta";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_id", $tipoId, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_activo", $cueconActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_cuenta", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":es_multi_concepto", $esMultiConcepto, PDO::PARAM_INT);
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
     * Cambia el valor del campo activo de una cuenta contable a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::CUECON_ACTIVO . " = 0, " .
            self::CUECON_MODIFICADO_POR . "= :cuecon_modificado_por, " .
            self::CUECON_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::CUECON_CUENTA . " = :cuecon_cuenta";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":cuecon_cuenta", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":cuecon_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
