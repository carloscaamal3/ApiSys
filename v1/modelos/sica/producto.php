<?php
class producto{

    const NOMBRE_TABLA = "producto";
    //Numero de serie
    const PROD_ID = "prod_id";
    const PROD_DESCRIPCION = "prod_descripcion";
    const UNIDAD_ID = "unidad_id";
    const PROD_NUMPARTE = "prod_numparte";
    const FAMILIA_ID = "familia_id";

    const PROD_ULTMARCA = "prod_ultMarca";
    const PROD_ULTPROV = "prod_ultProv";
    const PROD_ULTPRECIO = "prod_ultPrecio";

    const PROD_ACTIVO = "prod_activo";
    const PROD_CREADO_POR = "prod_creado_por";
    const PROD_CREADO_EL = "prod_creado_el";
    const PROD_MODIFICADO_POR = "prod_modificado_por";
    const PROD_MODIFICADO_EL = "prod_modificado_el";

    const PRECIO = "precio";
    const IVA_DET = "Iva";
    const SUBTOTAL = "subtotal";
    const DESCUENTO = "descuento";
    const TOTAL = "total";
    const CANTIDAD = "cantidad";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::PROD_ID,
        self::PROD_DESCRIPCION,
        self::UNIDAD_ID,
        self::PROD_NUMPARTE,
        self::FAMILIA_ID,
         self::PRECIO,
        self::IVA_DET,
        self::SUBTOTAL,
        self::DESCUENTO,
        self::TOTAL,
        self::PROD_ACTIVO,
    );

    const CAMPOS_ULT_ACTUALIZA = array(
        self::PROD_ULTMARCA,
        self::PROD_ULTPROV,
        self::PROD_ULTPRECIO
    );

    const SELECT = "select 
    p.prod_id,
    p.prod_descripcion,
    p.prod_numparte, 
    p.unidad_id, 
    u.tipo_descripcion as Unidad,
    p.familia_id, 
    f.tipo_descripcion as Familia,
    p.prod_ultMarca, 
    m.tipo_descripcion as UltimaMarca,
    p.prod_ultProv, 
    pv.prov_razon_social as Proveedor,
    p.prod_ultPrecio, 
    p.prod_activo,
    p.prod_creado_por, 
    p.prod_creado_el,
    p.prod_modificado_por, 
    p.prod_modificado_el,
    p.precio,
    p.Iva,
    p.subtota,
    p.descuento,
    p.total,
    p.cantidad
    from ";

//cambiar a INNER    
    const INNER = " p left join tipo u on p.unidad_id = u.tipo_clave and u.clatip_id = 'UNIPROD'
    left join tipo f on p.familia_id = f.tipo_clave and f.clatip_id = 'FAMPROD'
    left join tipo m on p.prod_ultMarca = m.tipo_clave and m.clatip_id = 'MARCAPROD'
    left join proveedor pv on pv.prov_id = p.prod_ultProv";

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

        //var_dump($peticion[0]);
        //var_dump($peticion[1]);

        switch ($peticion[0]) {
            case 'Actualizar':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    if (self::actualizar($datos, $peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
                case 'ActualizarUltimo':
                    if (!empty($peticion[0])) {
                        $body = file_get_contents('php://input');
                        $datos = json_decode($body);
            
                        if (self::actualizarUltimo($datos, $peticion[1], $idUsuario) > 0) {
                            http_response_code(200);
                            return [
                                "estado" => self::CODIGO_EXITO,
                                "mensaje" => "Registro actualizado correctamente"
                            ];
                        }
                        throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                    }
                    break;
    
            default:
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
            break;
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
                    "mensaje" => "El producto ha sido eliminado con exito"
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
            $whereId = !empty($id) ? " WHERE " . self::PROD_ID . "= :prod_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by prod_id";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":prod_id", $id, PDO::PARAM_INT);
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
            $prodId = htmlspecialchars(strip_tags($datos->prod_id));
            $prodDescripcion = htmlspecialchars(strip_tags($datos->prod_descripcion));
            $unidadId = htmlspecialchars(strip_tags($datos->unidad_id));
            $prodNumparte = htmlspecialchars(strip_tags($datos->prod_numparte));
            $familiaId = htmlspecialchars(strip_tags($datos->familia_id));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::PROD_ID . ", " .
                    self::PROD_DESCRIPCION . ", " .
                    self::UNIDAD_ID . ", " .
                    self::PROD_NUMPARTE . ", " .
                    self::FAMILIA_ID . ", " .
                    self::PROD_CREADO_EL . ", " .
                    self::PROD_CREADO_POR . ")" .
                    " VALUES(:prod_id,:prod_descripcion,:unidad_id,:prod_numparte,:familia_id,
                    CURRENT_TIMESTAMP(6),:prod_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":prod_id", $prodId, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_descripcion", $prodDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":unidad_id", $unidadId, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_numparte", $prodNumparte, PDO::PARAM_STR);
                $sentencia->bindParam(":familia_id", $familiaId, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_creado_por", $CreadoPor, PDO::PARAM_INT);
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

            $prodDescripcion = htmlspecialchars(strip_tags($datos->prod_descripcion));
            $unidadId = htmlspecialchars(strip_tags($datos->unidad_id));
            $prodNumparte = htmlspecialchars(strip_tags($datos->prod_numparte));
            $familiaId = htmlspecialchars(strip_tags($datos->familia_id));
            $prodActivo = htmlspecialchars(strip_tags($datos->prod_activo));
            
            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::PROD_DESCRIPCION . "= :prod_descripcion, " .
                    self::PROD_ACTIVO . "= :prod_activo, " .
                    self::UNIDAD_ID . "= :unidad_id, " .
                    self::PROD_NUMPARTE . "= :prod_numparte, " .
                    self::FAMILIA_ID . "= :familia_id, " .
                    self::PROD_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::PROD_MODIFICADO_POR . "= :prod_modificado_por " .
                    " WHERE " . self::PROD_ID . "= :prod_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":prod_descripcion", $prodDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":unidad_id", $unidadId, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_numparte", $prodNumparte, PDO::PARAM_STR);
                $sentencia->bindParam(":familia_id", $familiaId, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_activo", $prodActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":prod_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":prod_id", $id, PDO::PARAM_STR);
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
            " SET " . self::PROD_ACTIVO . " = 0, " .
            self::PROD_MODIFICADO_POR . "= :prod_modificado_por, " .
            self::PROD_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::PROD_ID . " = :prod_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":prod_id", $id, PDO::PARAM_STR);
            $sentencia->bindParam(":prod_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
    /**
     * Actualiza de Ultima Orden de Compra
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizarUltimo($datos, $id, $idUsuario)
    {
        if ($datos) {
            $campos = self::CAMPOS_ULT_ACTUALIZA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            //var_dump($datos);
            $prodUltMarca = htmlspecialchars(strip_tags($datos->prod_ultMarca));
            $prodUltProv = htmlspecialchars(strip_tags($datos->prod_ultProv));
            $prodUltPrecio = htmlspecialchars(strip_tags($datos->prod_ultPrecio));
            
            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::PROD_ULTMARCA . "= :prod_ultMarca, " .
                    self::PROD_ULTPROV . "= :prod_ultProv, " .
                    self::PROD_ULTPRECIO . "= :prod_ultPrecio, " .
                    self::PROD_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::PROD_MODIFICADO_POR . "= :prod_modificado_por " .
                    " WHERE " . self::PROD_ID . "= :prod_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":prod_ultMarca", $prodUltMarca, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_ultProv", $prodUltProv, PDO::PARAM_INT);
                $sentencia->bindParam(":prod_ultPrecio", $prodUltPrecio, PDO::PARAM_STR);
                $sentencia->bindParam(":prod_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":prod_id", $id, PDO::PARAM_STR);
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

}//fin de la clase