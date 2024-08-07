<?php
include_once "datos/ConexionBD.php";

class Tipo
{
    const NOMBRE_TABLA = "tipo";
    const TIPO_ID = "tipo_id";
    
    const TIPO_DESCRIPCION = "tipo_descripcion";
    const TIPO_DESCRIPCION_C = "t.tipo_descripcion";
    
    const CLATIP_ID = "clatip_id";
    const CLATIP_ID_C = "t.clatip_id";
    
    const TIPO_ACTIVO = "tipo_activo";
    const TIPO_ACTIVO_C = "t.tipo_activo";

    const TIPO_CLAVE = "tipo_clave";
    const TIPO_CLAVE_C = "t.tipo_clave";

    const TIPO_ORDEN = "tipo_orden";
    const TIPO_ORDEN_C = "t.tipo_orden";
    
    const TIPO_RELACION1 = "tipo_relacion1";
    const TIPO_RELACION1_C = "t.tipo_relacion1";

    const TIPO_RELACION2 = "tipo_relacion2";
    const TIPO_RELACION2_C = "t.tipo_relacion2";
    
    const TIPO_CREADO_POR = "tipo_creado_por";
    const TIPO_CREADO_EL = "tipo_creado_el";
    const TIPO_MODIFICADO_POR = "tipo_modificado_por";
    const TIPO_MODIFICADO_EL = "tipo_modificado_el";

    const ID_SISTEMA = "id_sistema";
    const ID_SISTEMA_C = "t.id_sistema";
    

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const TIPO_CAMPOS = array(
        self::TIPO_ID,
        self::TIPO_DESCRIPCION,
        self::CLATIP_ID,
        self::TIPO_ACTIVO,
        self::TIPO_CLAVE,
        self::TIPO_ORDEN,
        self::TIPO_RELACION1,
        self::TIPO_RELACION2,
        self::TIPO_ACTIVO_C,
        self::TIPO_DESCRIPCION_C,
        self::CLATIP_ID_C,
        self::TIPO_CLAVE_C,
        self::TIPO_ORDEN_C,
        self::TIPO_RELACION1_C,
        self::TIPO_RELACION2_C,
        self::ID_SISTEMA_C,
        self::ID_SISTEMA,

    );


      /* const SELECT = "select t.tipo_id,t.tipo_descripcion, t.clatip_id, c.clatip_descripcion,
      t.tipo_activo,t.tipo_creado_por,t.tipo_creado_el,
      t.tipo_modificado_por,t.tipo_modificado_el FROM ";

      const INNER = " t inner join clasificacion_tipo c on t.clatip_id = c.clatip_id";
 */
     const SELECT = "select t.tipo_id,t.tipo_descripcion, t.clatip_id, c.clatip_descripcion,
      t.tipo_activo,t.tipo_creado_por,t.tipo_creado_el,
      t.tipo_modificado_por,t.tipo_modificado_el, 
      t.tipo_clave,t.tipo_orden,
      t.tipo_relacion1, r1.tipo_descripcion as desc_relacion1,
      t.tipo_relacion2, r2.tipo_descripcion as desc_relacion2,
      t.id_sistema, s.sis_siglas
      FROM "; 

      const INNER = " t inner join clasificacion_tipo c on t.clatip_id = c.clatip_id
      left join tipo r1 on t.tipo_relacion1 = r1.tipo_id
      left join tipo r2 on t.tipo_relacion2 = r2.tipo_id
      left join sistema s on t.id_sistema = s.id_sistema";
    /**
     * MÃ©todo GET Obtiene uno o varios registros de la tabla de Tipo
     *
     * @param [array] $peticion Contiene un array con la(s) peticiÃ³n(es) del cliente
     * @return object Devuelve un json con el resultado del mÃ©todo
     */
    public static function get($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        if (!empty($peticion[0])) {
            if (!is_numeric($peticion[0])) {
                return self::obtenerTiposFiltro($peticion[0]);
            }
        }

        return self::obtenerTipos($peticion[0]);
    }

    /**
     * Metodo POST Crea un tipo en la base de datos
     *
     * @return object Devuelve un json con el resultado del mÃ©todo
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

        $idTipo = self::crearTipo($idUsuario);

        http_response_code(201);
        return [
            "estado" => self::CODIGO_EXITO,
            "mensaje" => "Â¡Registro creado con Ã©xito!",
            "id" => $idTipo
        ];
    }

    /**
     * MÃ©todo PUT Actualiza un tipo en la base de datos
     *
     * @param [array] $peticion Contiene un array con la(s) peticiÃ³n(es) del cliente
     * @return array Devuelve un array con el resultado del mÃ©todo
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
            $tipo = json_decode($body);

            if (self::actualizarTipo($tipo, $peticion[0], $idUsuario) > 0) {
                http_response_code(200);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "Registro actualizado correctamente"
                ];
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Falta informaciÃ³n", 422);
    }

    /**
     * MÃ©todo delete Inactiva un tipo en la base de datos
     *
     * @param [array] $peticion Contiene un array con la(s) peticiÃ³n(es) del cliente
     * @return object Devuelve un json con el resultado del mÃ©todo
     */
    public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            if (self::eliminarTipo($peticion[0], $idUsuario) > 0) {
                http_response_code(200);
                return array(
                    "estado" => 1,
                    "mensaje" => "El tipo ha sido eliminado con exito"
                );
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Error en los parÃ¡metros o parÃ¡metro ausente", 400);
    }

    /**
     * Obtiene uno o varios registros de tipos de acuerdo a el parametro recibido
     *
     * @param [int] $idTipo Contiene el id del tipo que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la bÃºsqueda
     */
    private static function obtenerTipos($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE t." . self::TIPO_ID . "= :tipo_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by t.tipo_descripcion";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":tipo_id", $id, PDO::PARAM_INT);
            }

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($id) ? " con ese Id" : " en la tabla";

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Obtiene uno o varios registros de tipos de acuerdo a criterios de filtrado
     *
     * @param [string] $peticion Contiene la peticion a la API (filtro)
     * @return array Devuelve un array con los registros resultado del filtrado
     */
    private static function obtenerTiposFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::TIPO_CAMPOS, "t");

        //var_dump($filtro);

        //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'] . " order by tipo_descripcion";
        $consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER . $filtro['where'] . " order by tipo_descripcion";

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
     * Crea un Tipo en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea el tipo
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crearTipo($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::TIPO_CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $tipodescripcion = htmlspecialchars(strip_tags($datos->tipo_descripcion));
            $clatipid = htmlspecialchars(strip_tags($datos->clatip_id));
            
            $tipoClave = htmlspecialchars(strip_tags($datos->tipo_clave));
            $tipoOrden = htmlspecialchars(strip_tags($datos->tipo_orden));
            $tipoRelacion1 = htmlspecialchars(strip_tags($datos->tipo_relacion1));
            $tipoRelacion2 = htmlspecialchars(strip_tags($datos->tipo_relacion2));

            $idSistema = htmlspecialchars(strip_tags($datos->id_sistema));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::TIPO_DESCRIPCION . ", " .
                    self::CLATIP_ID . ", " .
                    self::TIPO_CLAVE . ", " .
                    self::TIPO_ORDEN . ", " .
                    self::TIPO_RELACION1 . ", " .
                    self::TIPO_RELACION2 . ", " .
                    self::ID_SISTEMA . ", " .
                    self::TIPO_CREADO_EL . ", " .
                    self::TIPO_CREADO_POR . ")" .
                    " VALUES(:tipo_descripcion,:clatip_id,
                    :tipo_clave,:tipo_orden,:tipo_relacion1,:tipo_relacion2,:id_sistema,
                    CURRENT_TIMESTAMP(6),:tipo_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":tipo_descripcion", $tipodescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":clatip_id", $clatipid, PDO::PARAM_STR);
                //$sentencia->bindParam(":tipo_activo", $tipoActivo, PDO::PARAM_STR);
                $sentencia->bindParam(":tipo_creado_por", $CreadoPor, PDO::PARAM_INT);

                $sentencia->bindParam(":tipo_clave", $tipoClave, PDO::PARAM_STR);
                $sentencia->bindParam(":tipo_orden", $tipoOrden, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_relacion1", $tipoRelacion1, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_relacion2", $tipoRelacion2, PDO::PARAM_INT);

                $sentencia->bindParam(":id_sistema", $idSistema, PDO::PARAM_STR);
                $sentencia->execute();
                // Retornar en el Ãºltimo id insertado
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
     * Actualiza la informaciÃ³n de un tipo
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el nÃºmero de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizarTipo($datos, $id, $idUsuario)
    {
        if ($datos) {
            $campos = self::TIPO_CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $tipoDescripcion = htmlspecialchars(strip_tags($datos->tipo_descripcion));
            $clatipId = htmlspecialchars(strip_tags($datos->clatip_id));
            $tipoActivo = htmlspecialchars(strip_tags($datos->tipo_activo));
            $ModificadPor = $idUsuario;

            $tipoClave = htmlspecialchars(strip_tags($datos->tipo_clave));
            $tipoOrden = htmlspecialchars(strip_tags($datos->tipo_orden));
            $tipoRelacion1 = htmlspecialchars(strip_tags($datos->tipo_relacion1));
            $tipoRelacion2 = htmlspecialchars(strip_tags($datos->tipo_relacion2));

            $idSistema = htmlspecialchars(strip_tags($datos->id_sistema));

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::TIPO_DESCRIPCION . "= :tipo_descripcion, " .
                    self::TIPO_ACTIVO . "= :tipo_activo, " .
                    self::CLATIP_ID . "= :clatip_id, " .
                    self::TIPO_CLAVE . "= :tipo_clave, " .
                    self::TIPO_ORDEN . "= :tipo_orden, " .
                    self::TIPO_RELACION1 . "= :tipo_relacion1, " .
                    self::TIPO_RELACION2 . "= :tipo_relacion2, " .
                    self::ID_SISTEMA . "= :id_sistema, " .
                    self::TIPO_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::TIPO_MODIFICADO_POR . "= :tipo_modificado_por " .
                    " WHERE " . self::TIPO_ID . "= :tipo_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":tipo_descripcion", $tipoDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":clatip_id", $clatipId, PDO::PARAM_STR);
                $sentencia->bindParam(":tipo_activo", $tipoActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_id", $id, PDO::PARAM_INT);

                $sentencia->bindParam(":tipo_clave", $tipoClave, PDO::PARAM_STR);
                $sentencia->bindParam(":tipo_orden", $tipoOrden, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_relacion1", $tipoRelacion1, PDO::PARAM_INT);
                $sentencia->bindParam(":tipo_relacion2", $tipoRelacion2, PDO::PARAM_INT);

                $sentencia->bindParam(":id_sistema", $idSistema, PDO::PARAM_STR);

                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
            }
        }
        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            "Error en existencia o sintaxis de parÃ¡metros"
        );
    }

    /**
     * Cambia el valor del campo activo de un Tipo a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el nÃºmero de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminarTipo($id, $idUsuario)
    {
        $TipoModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::TIPO_ACTIVO . " = 0, " .
            self::TIPO_MODIFICADO_POR . "= :tipo_modificado_por, " .
            self::TIPO_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::TIPO_ID . " = :tipo_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":tipo_id", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":tipo_modificado_por", $TipoModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
