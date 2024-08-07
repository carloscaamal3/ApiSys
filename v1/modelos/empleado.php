<?PHP
class Empleado
{
    const NOMBRE_TABLA = "empleado";
    const EMP_ID = "emp_id";

    const EMP_CODIGO = "emp_codigo";
    const EMP_NOMBRE = "emp_nombre";
    const EMP_PUESTO = "emp_puesto";
    const EMP_DEPARTAMENTO = "emp_departamento";
    const EMP_CODIGO_DIRECTOR = "emp_codigo_director";
    const EMP_DIRECCION = "emp_direccion";
    const EMP_TITULO = "emp_titulo";
    const EMP_ACTIVO = "emp_activo";

    const EMP_CREADO_POR = "emp_creado_por";
    const EMP_CREADO_EL = "emp_creado_el";
    const EMP_MODIFICADO_POR = "emp_modificado_por";
    const EMP_MODIFICADO_EL = "emp_modificado_el";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::EMP_ID,
        self::EMP_CODIGO,
        self::EMP_NOMBRE,
        self::EMP_PUESTO,
        self::EMP_DEPARTAMENTO,
        self::EMP_CODIGO_DIRECTOR,
        self::EMP_DIRECCION,
        self::EMP_TITULO,
        self::EMP_ACTIVO
    );
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de retencion
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
     * Método PUT Actualiza una retencion en la base de datos
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
     * Método delete Inactiva una retencion en la base de datos
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
                    "mensaje" => "El empleado ha sido eliminado con exito"
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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::EMP_ID . "= :emp_id" : "";

            $comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId . " order by emp_direccion, emp_departamento";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":emp_id", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de retencion de acuerdo a criterios de filtrado
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

        $consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'] . " order by emp_direccion, emp_departamento";

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
     * Crea un retencion en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la retencion
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
            $empCodigo = htmlspecialchars(strip_tags($datos->emp_codigo));
            $empNombre = htmlspecialchars(strip_tags($datos->emp_nombre));
            $empPuesto = htmlspecialchars(strip_tags($datos->emp_puesto));
            $empDepartamento = htmlspecialchars(strip_tags($datos->emp_departamento));
            $empCodigoDirector = htmlspecialchars(strip_tags($datos->emp_codigo_director));
            $empDireccion = htmlspecialchars(strip_tags($datos->emp_direccion));
            $empTitulo = htmlspecialchars(strip_tags($datos->emp_titulo));
            //$empActivo = htmlspecialchars(strip_tags($datos->emp_activo));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::EMP_CODIGO . ", " .
                    self::EMP_NOMBRE . ", " .
                    self::EMP_PUESTO . ", " .
                    self::EMP_DEPARTAMENTO . ", " .
                    self::EMP_CODIGO_DIRECTOR . ", " .
                    self::EMP_DIRECCION . ", " .
                    self::EMP_TITULO . ", " .
                    self::EMP_CREADO_EL . ", " .
                    self::EMP_CREADO_POR . ")" .
                    " VALUES(:emp_codigo,:emp_nombre,:emp_puesto,:emp_departamento,:emp_codigo_director,:emp_direccion,:emp_titulo,CURRENT_TIMESTAMP(6),:emp_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":emp_codigo", $empCodigo, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_nombre", $empNombre, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_puesto", $empPuesto, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_departamento", $empDepartamento, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_codigo_director", $empCodigoDirector, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_direccion", $empDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_titulo", $empTitulo, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_creado_por", $CreadoPor, PDO::PARAM_INT);
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

            $empCodigo = htmlspecialchars(strip_tags($datos->emp_codigo));
            $empNombre = htmlspecialchars(strip_tags($datos->emp_nombre));
            $empPuesto = htmlspecialchars(strip_tags($datos->emp_puesto));
            $empDepartamento = htmlspecialchars(strip_tags($datos->emp_departamento));
            $empCodigoDirector = htmlspecialchars(strip_tags($datos->emp_codigo_director));
            $empDireccion = htmlspecialchars(strip_tags($datos->emp_direccion));
            $empTitulo = htmlspecialchars(strip_tags($datos->emp_titulo));
            $empActivo = htmlspecialchars(strip_tags($datos->emp_activo));
            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::EMP_CODIGO . "= :emp_codigo, " .
                    self::EMP_NOMBRE . "= :emp_nombre, " .
                    self::EMP_PUESTO . "= :emp_puesto, " .
                    self::EMP_DEPARTAMENTO . "= :emp_departamento, " .
                    self::EMP_CODIGO_DIRECTOR . "= :emp_codigo_director, " .
                    self::EMP_DIRECCION . "= :emp_direccion, " .
                    self::EMP_TITULO . "= :emp_titulo, " .
                    self::EMP_ACTIVO . "= :emp_activo, " .
                    self::EMP_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::EMP_MODIFICADO_POR . "= :emp_modificado_por " .
                    " WHERE " . self::EMP_ID . "= :emp_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":emp_codigo", $empCodigo, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_nombre", $empNombre, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_puesto", $empPuesto, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_departamento", $empDepartamento, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_codigo_director", $empCodigoDirector, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_direccion", $empDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_titulo", $empTitulo, PDO::PARAM_STR);
                $sentencia->bindParam(":emp_activo", $empActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":emp_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":emp_id", $id, PDO::PARAM_INT);
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
     * Cambia el valor del campo activo de una retencion a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::EMP_ACTIVO . " = 0, " .
            self::EMP_MODIFICADO_POR . "= :emp_modificado_por, " .
            self::EMP_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::EMP_ID . " = :emp_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":emp_id", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":emp_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
