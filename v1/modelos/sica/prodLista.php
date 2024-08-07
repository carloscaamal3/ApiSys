<?php
class productoLista{
	
    const NOMBRE_TABLA = "cabListaPrecio";
    const NOMBRE_TABLA_2 = "detListaPrecio";

    // CABECERO
    const ID_CABLISTA = "idLista";
    const ID_PROVEEDOR = "idProveedor";
    const FECHA_CREADO = "fechaCreado";
    const FEHCA_MODIFICA= "fechaModifica";
    const CREADO_POR = "creadoPor";
    const MODIFICADO_POR ="modificadoPor";
    const ACTIVO = "activo";




    // DETALLE
    const ID_DETLISTA = "idLista";
    const ID_PRODUCTO = "idProducto";
    const ID_MARCA = "idMarca";
    const PRECIO = "precio";
    const IVA_DET = "Iva";
    const SUBTOTAL = "subtotal";
    const DESCUENTO = "descuento";
    const TOTAL = "total";
    const ACTIVO_DET = "activo";
    const FECHA_CREADO_DET = "fechaCreado";
    const CREADO_POR_DET = "creadoPor";
    const MODIFICADO_POR_DET="modificadoPor";
    const MODIFICADO_EL_DET ="modificadoEl";
    
 
    const CAMPOS = array(
        self::ID_CABLISTA,
        self::ID_PROVEEDOR,
        self::FECHA_CREADO,
        self::FEHCA_MODIFICA,
        self::CREADO_POR,
        self::MODIFICADO_POR,
        self::ACTIVO,
    );

    const CAMPOS_DET = array(
        self::ID_DETLISTA,
        self::ID_PRODUCTO,
        self::ID_MARCA,
        self::PRECIO,
        self::IVA_DET,
        self::SUBTOTAL,
        self::DESCUENTO,
        self::TOTAL,
        self::ACTIVO_DET,
        self::FECHA_CREADO_DET,
        self::CREADO_POR_DET,
        self::MODIFICADO_POR_DET,
        self::MODIFICADO_EL_DET,

    );

    //CODIGOS 
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    CONST SELECT = "select 
    li.idLista,
    li.idProveedor, po.prov_razon_social as nombre_prov, po.prov_RFC as prov_RFC,
    li.fechaCreado,
    li.fechaModifica,
    li.creadoPor, usr_nombres as creado_nombre,
    li.modificadoPor, usr_nombres as modifica_nombre,
    li.activo
    from cabListaPrecio li
    left join proveedor po on li.idProveedor = po.prov_id
    left join usuario u on li.creadoPor = usr_id and li.modificadoPor = usr_id";

    CONST SELECT_DET = "select 
    li.idLista,
    li.precio,
    li.Iva,
    li.subtotal,
    li.descuento,
    li.total,
    li.activo,
    li.idProducto, p.prod_descripcion as nombre_producto, p.unidad_id as unidad_id, p.familia_id as familia, p.prod_numparte as numParte,
    li.idMarca, t.tipo_descripcion as nombre_marca, t.clatip_id as clatip_id,
    li.creadoPor, usr_nombres as creado_nombre,
    li.modificadoPor, usr_nombres as modifica_nombre
    from  detListaPrecio li
    left join producto p on li.idProducto = p.prod_id
    left join tipo t on li.idMarca = t.tipo_clave
    left join usuario u on li.creadoPor = usr_id and li.modificadoPor = usr_id";
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////

    
    public static function get($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        switch ($peticion[0]) {
            case 'obtCab':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltroCab($peticion[1]);
                    }
                }
                return self::obtenerTodosCab($peticion[1]);
                break; 
             case 'obtDet':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltroDet($peticion[1]);
                    }
                }
                return self::obtenerTodosDet($peticion[1]);
                break; 
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
    }

        /**
     * Metodo POST Crea un registro en la base de datos
     *
     * @return object Devuelve un json con el resultado del método
     */
    public static function post($peticion)
    {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        switch ($peticion[0]) {
            case 'creaCab':
            $id = self::crear($idUsuario);
            http_response_code(201);
            return [
                "estado" => self::CODIGO_EXITO,
                "mensaje" => "¡Registro creado con éxito!",
                "id" => $id
            ];
            break;
             case 'creaDetalle':
            $id = self::crearDetalle($idUsuario);
            http_response_code(201);
            return [
                "estado" => self::CODIGO_EXITO,
                "mensaje" => "¡Registro creado con éxito!",
                "id" => $id
            ];
            break;
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
    }

    public static function put($peticion)
     {
        $validaToken = Validador::obtenerInstancia()->validaToken();
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            $body = file_get_contents('php://input');
            $datos = json_decode($body);
            

            switch ($peticion[0]) {
                case 'actualizaCab':
                if (self::actualizar($datos, $peticion[1]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambió", 200);
                break;
                     case 'actulizaDet':
                if (self::actualizarDet($datos, $peticion[1]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambió", 200);
                break;
            }
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Falta información", 422);
        }
    }
    public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        if (!empty($peticion[0])) {
            switch ($peticion[0]) {

                case 'DelLicDet':
                    if (self::eliminarProdList($peticion[1], $peticion[2]) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "El registro ha sido eliminado con exito"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
            }
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Error en los parámetros o parámetro ausente", 400);
    }
    private static function obtenerFiltroCab($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        $consulta = self::SELECT.$filtro['where'] . " order by li.idLista desc";
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
    private static function obtenerTodosCab($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::ID_CABLISTA . "= :idLista" : "";

            
            $comando = self::SELECT. $whereId . " order by idLista";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":idLista", $id, PDO::PARAM_INT);
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
    private static function obtenerFiltroDet($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_DET);

        $consulta = self::SELECT_DET.$filtro['where'] . " order by li.idLista desc";
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
    private static function obtenerTodosDet($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::ID_DETLISTA . "= :idLista" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_DET. $whereId . " order by idLista";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":idLista", $id, PDO::PARAM_INT);
            }

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($id) ? " con ese Id" : " en la tabla: " .  self::NOMBRE_TABLA_2;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }


    private static function crear($idUsuario)
    {
    $body = file_get_contents('php://input');
    $datos = json_decode($body);

    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        // Define los campos permitidos y sus valores predeterminados
        $camposPermitidos = [

           // self::ID_CABLISTA => null,
            self::ID_PROVEEDOR => null,
            self::FECHA_CREADO => null,
            self::FEHCA_MODIFICA => null,
            self::CREADO_POR => null,
            self::MODIFICADO_POR => null,
            self::ACTIVO => null
        ];

        // Filtra solo los campos presentes en la solicitud y sus valores
        $datosInsert = array_intersect_key((array)$datos, $camposPermitidos);

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            // Construye la consulta dinámicamente con los campos presentes
            $comando = "INSERT INTO " . self::NOMBRE_TABLA . " (" . implode(", ", array_keys($datosInsert)) . ") VALUES (:" . implode(", :", array_keys($datosInsert)) . ")";
            
            $sentencia = $pdo->prepare($comando);

            foreach ($datosInsert as $campo => &$valor) {
                $sentencia->bindParam(":$campo", $valor, PDO::PARAM_STR);
            }

            // Ejecutar la sentencia
            $sentencia->execute();

            // Retornar en el último id insertado
            // return $pdo->lastInsertId();
            return $pdo;
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

private static function crearDetalle($idUsuario){
$body = file_get_contents('php://input');
$datos = json_decode($body);

if ($datos) {
    $campos = self::CAMPOS_DET;
    UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
    var_dump("usaurio", $idUsuario);
    
    // Define los campos permitidos y sus valores predeterminados
    $camposPermitidos = [

        self::ID_DETLISTA => null,
        self::ID_PRODUCTO => null,
        self::ID_MARCA => null,
        self::PRECIO => null,
        self::IVA_DET => null,
        self::SUBTOTAL => null,
        self::DESCUENTO => null,
        self::TOTAL => null,
        self::ACTIVO_DET => null,
        self::FECHA_CREADO_DET => null,
        self::CREADO_POR_DET => null,
        self::MODIFICADO_POR_DET => null,
        self::MODIFICADO_EL_DET => null,

    ];

    // Filtra solo los campos presentes en la solicitud y sus valores
    $datosInsert = array_intersect_key((array)$datos, $camposPermitidos);

    try {
        $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

        // Construye la consulta dinámicamente con los campos presentes
        $comando = "INSERT INTO " . self::NOMBRE_TABLA_2 . " (" . implode(", ", array_keys($datosInsert)) . ") VALUES (:" . implode(", :", array_keys($datosInsert)) . ")";
        
        $sentencia = $pdo->prepare($comando);

        foreach ($datosInsert as $campo => &$valor) {
            $sentencia->bindParam(":$campo", $valor, PDO::PARAM_STR);
        }

        // Ejecutar la sentencia
        $sentencia->execute();

        // Retornar en el último id insertado
        // return $pdo->lastInsertId();
        return $pdo;
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
public static function actualizar($datos, $peticion)
{
    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        $idLista = htmlspecialchars(strip_tags($datos->idLista));

        $setClause = '';
        $bindParams = [];

        foreach ($campos as $campo) {
            if (isset($datos->{$campo})) {
                $setClause .= "$campo = :$campo, ";
                $bindParams[":$campo"] = htmlspecialchars(strip_tags($datos->{$campo}));
            }
        }

        // Elimina la coma adicional al final de la cadena de la cláusula SET
        $setClause = rtrim($setClause, ', ');

        try {
            //$consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE " . self::OSNUMDOC . " = :osNumDoc AND " . self::OSEJERCICIO . " = :osEjercicio";
            $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::ID_CABLISTA . " = :idLista AND " . self::ID_PROVEEDOR . " = :idProveedor )";


            // Preparar la sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

            // Bind de los parámetros
            foreach ($bindParams as $param => &$value) {
                $sentencia->bindParam($param, $value, PDO::PARAM_STR);
            }

            $sentencia->bindParam(":idLista", $idLista, PDO::PARAM_INT);

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

public static function actualizarDet($datos, $peticion)
{
    if ($datos) {
        $campos = self::CAMPOS_DET;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        $idLista = htmlspecialchars(strip_tags($datos->idLista));
        $idProducto = htmlspecialchars(strip_tags($datos->idProducto));

        $setClause = '';
        $bindParams = [];

        foreach ($campos as $campo) {
            if (isset($datos->{$campo})) {
                $setClause .= "$campo = :$campo, ";
                $bindParams[":$campo"] = htmlspecialchars(strip_tags($datos->{$campo}));
            }
        }

        // Elimina la coma adicional al final de la cadena de la cláusula SET
        $setClause = rtrim($setClause, ', ');

        try {
            
            $consulta = "UPDATE " . self::NOMBRE_TABLA_2 . " SET $setClause WHERE (" . self::ID_DETLISTA . " = :idLista AND " . self::ID_PRODUCTO . " = :idProducto )" ;


            // Preparar la sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

            // Bind de los parámetros
            foreach ($bindParams as $param => &$value) {
                $sentencia->bindParam($param, $value, PDO::PARAM_STR);
            }

            $sentencia->bindParam(":idLista", $idLista, PDO::PARAM_INT);
            $sentencia->bindParam(":idProducto", $idProducto, PDO::PARAM_STR);

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
private static function eliminarProdList($idLista, $idProducto)
{
    $consulta = "DELETE FROM detListaPrecio WHERE idLista = :idLista AND idProducto = :idProducto";

    try {
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":idLista", $idLista, PDO::PARAM_INT);
        $sentencia->bindParam(":idProducto", $idProducto, PDO::PARAM_STR);
        $sentencia->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }

}
}