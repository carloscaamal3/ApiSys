<?php
class vehiculo{
    const NOMBRE_TABLA = "vehiculo";
    //Numero de serie
    const VEH_ID = "veh_id";
    const VEH_MODELO = "veh_modelo";
    const VEH_MARCA_ID = "veh_marca_id";
    const VEH_ANIO = "veh_anio";
    const VEH_PLACAS = "veh_placas";
    const VEH_TIPO_ID = "veh_tipo_id";
    const VEH_EMP_ID = "veh_emp_id";
    const VEH_ACTIVO = "veh_activo";
    const VEH_PROPIEDAD_DE = "veh_propiedad_de";
    const VEH_CREADO_POR = "veh_creado_por";
    const VEH_CREADO_EL = "veh_creado_el";
    const VEH_MODIFICADO_POR = "veh_modificado_por";
    const VEH_MODIFICADO_EL = "veh_modificado_el";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::VEH_ID,
        self::VEH_MODELO,
        self::VEH_MARCA_ID,
        self::VEH_ANIO,
        self::VEH_PLACAS,
        self::VEH_TIPO_ID,
        self::VEH_EMP_ID,
        self::VEH_ACTIVO,
        self::VEH_PROPIEDAD_DE
    );

    const SELECT = "select v.veh_id,v.veh_modelo,
    v.veh_marca_id, m.tipo_descripcion as marca,
    v.veh_anio,v.veh_placas,v.veh_propiedad_de,
    v.veh_tipo_id,tv.tipo_descripcion as tipoVehiculo,
    v.veh_emp_id,ifnull(e.emp_nombre,'Sin Empleado') as emp_nombre,
    ifnull(e.emp_puesto,'Sin Puesto') as emp_puesto,ifnull(e.emp_direccion,'Sin Direccion') as emp_direccion,
    v.veh_activo,v.veh_creado_por,v.veh_creado_el,
    v.veh_modificado_por,v.veh_modificado_el
    from ";

    const INNER = " v inner join tipo m on v.veh_marca_id = m.tipo_clave and m.clatip_id = 'MARCAVEH'
    inner join tipo tv on v.veh_tipo_id = tv.tipo_clave and tv.clatip_id = 'TIPVEH'
    left join empleado e on v.veh_emp_id = e.emp_codigo ";
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

        //var_dump('Entro a POST');

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
                    "mensaje" => "El vehiculo ha sido eliminado con exito"
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
            $whereId = !empty($id) ? " WHERE " . self::VEH_ID . "= :veh_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by veh_id";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":veh_id", $id, PDO::PARAM_INT);
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
        $consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER . $filtro['where'];

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
        //var_dump('Entro a Crear');
        
        

        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $vehId = htmlspecialchars(strip_tags($datos->veh_id));
            $vehModelo = htmlspecialchars(strip_tags($datos->veh_modelo));
            $vehMarcaId = htmlspecialchars(strip_tags($datos->veh_marca_id));
            $vehAnio = htmlspecialchars(strip_tags($datos->veh_anio));
            $vehPlacas = htmlspecialchars(strip_tags($datos->veh_placas));
            $vehTipoId = htmlspecialchars(strip_tags($datos->veh_tipo_id));
            $vehEmpId = htmlspecialchars(strip_tags($datos->veh_emp_id));
            $vehPropiedadDe = htmlspecialchars(strip_tags($datos->veh_propiedad_de));
            //$vehActivo = htmlspecialchars(strip_tags($datos->veh_activo));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::VEH_ID . ", " .
                    self::VEH_MODELO . ", " .
                    self::VEH_MARCA_ID . ", " .
                    self::VEH_ANIO . ", " .
                    self::VEH_PLACAS . ", " .
                    self::VEH_TIPO_ID . ", " .
                    self::VEH_EMP_ID . ", " .
                    self::VEH_PROPIEDAD_DE . ", " .
                    self::VEH_CREADO_EL . ", " .
                    self::VEH_CREADO_POR . ")" .
                    " VALUES(:veh_id,:veh_modelo,:veh_marca_id,:veh_anio,:veh_placas,
                    :veh_tipo_id,:veh_emp_id,:veh_propiedad_de,CURRENT_TIMESTAMP(6),:veh_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":veh_id", $vehId, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_modelo", $vehModelo, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_marca_id", $vehMarcaId, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_anio", $vehAnio, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_placas", $vehPlacas, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_tipo_id", $vehTipoId, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_emp_id", $vehEmpId, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_creado_por", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_propiedad_de", $vehPropiedadDe, PDO::PARAM_STR);
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

            $vehModelo = htmlspecialchars(strip_tags($datos->veh_modelo));
            $vehMarcaId = htmlspecialchars(strip_tags($datos->veh_marca_id));
            $vehAnio = htmlspecialchars(strip_tags($datos->veh_anio));
            $vehPlacas = htmlspecialchars(strip_tags($datos->veh_placas));
            $vehTipoId = htmlspecialchars(strip_tags($datos->veh_tipo_id));
            $vehEmpId = htmlspecialchars(strip_tags($datos->veh_emp_id));
            $vehActivo = htmlspecialchars(strip_tags($datos->veh_activo));
            $vehPropiedadDe = htmlspecialchars(strip_tags($datos->veh_propiedad_de));
            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::VEH_MODELO . "= :veh_modelo, " .
                    self::VEH_MARCA_ID . "= :veh_marca_id, " .
                    self::VEH_ANIO . "= :veh_anio, " .
                    self::VEH_PLACAS . "= :veh_placas, " .
                    self::VEH_TIPO_ID . "= :veh_tipo_id, " .
                    self::VEH_EMP_ID . "= :veh_emp_id, " .
                    self::VEH_ACTIVO . "= :veh_activo, " .
                    self::VEH_PROPIEDAD_DE . "= :veh_propiedad_de, " .
                    self::VEH_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::VEH_MODIFICADO_POR . "= :veh_modificado_por " .
                    " WHERE " . self::VEH_ID . "= :veh_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":veh_modelo", $vehModelo, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_marca_id", $vehMarcaId, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_anio", $vehAnio, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_placas", $vehPlacas, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_tipo_id", $vehTipoId, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_emp_id", $vehEmpId, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_activo", $vehActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":veh_id", $id, PDO::PARAM_STR);
                $sentencia->bindParam(":veh_propiedad_de", $vehPropiedadDe, PDO::PARAM_STR);
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
            " SET " . self::VEH_ACTIVO . " = 0, " .
            self::VEH_MODIFICADO_POR . "= :veh_modificado_por, " .
            self::VEH_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::VEH_ID . " = :veh_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":veh_id", $id, PDO::PARAM_STR);
            $sentencia->bindParam(":veh_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//fin de la clase