<?PHP
class facturas
{
    const NOMBRE_TABLA = "facturas";

    const UUID = "UUID";
    const FECHAFACTURA = "fechaFactura";
    const SUBTOTAL = "subtotal";
    const TOTAL = "total";
    const IMPUESTOS = "impuestos";
    const LUGAREXPEDICION = "lugarExpedicion";
    const METODOPAGO = "metodoPago";
    const MONEDAFACTURA = "monedaFactura";
    const RFCEMISOR = "rfcEmisor";
    const NOMBREEMISOR = "nombreEmisor";
    const REGIMENFISCALEMISOR = "regimenFiscalEmisor";
    const RFCRECEPTOR = "rfcReceptor";
    const NOMBRERECEPTOR = "nombreReceptor";
    const USOCFDI = "usoCfdi";
    const OSTIPODOC = "osTipoDoc";
    const OSNUMDOC = "osNumDoc";
    const SP_ID = "sp_id";
    const SP_EJERCICIO = "sp_ejercicio";

    const FACTACTIVO = "factActivo";
    const FACT_CREADO_EL = "fact_creado_el";
    const FACT_CREADO_POR = "fact_creado_por";
    const FACT_MODIFICADO_EL = "fact_modificado_el";
    const FACT_MODIFICADO_POR = "fact_modificado_por";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::FACTURAID,
        self::FACTSUBTOTAL,
        self::FACTDESCUENTO,
        self::FACTIVA,
        self::OSNUMDOC,
        self::SP_ID,
        self::SP_EJERCICIO,
    );


    const SELECT = "select f.UUID,
    f.fechaFactura,
    f.subtotal,
    f.total,
    f.impuestos,
    f.lugarExpedicion,
    f.metodoPago,
    f.monedaFactura,
    f.rfcEmisor,
    f.nombreEmisor,
    f.regimenFiscalEmisor,
    f.rfcReceptor,
    f.nombreReceptor,
    f.usoCfdi,
    f.osTipoDoc,
    f.osNumDoc,
    f.sp_id,
    f.sp_ejercicio,
    f.factActivo,
    f.fact_creado_el,
    f.fact_creado_por,
    u.usr_nombres as userCreaNombre,
    f.fact_modificado_el,
    f.fact_modificado_por,
    um.usr_nombres as userModNombre 
    from ";

    const INNER = " f inner join usuario u on f.fact_creado_por = u.usr_id
    inner join usuario um on f.fact_modificado_por = um.usr_id";

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
        switch ($peticion[0]) {
            case 'todos':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltro($peticion[1]);
                    }
                }
                return self::obtener($peticion[1],$peticion[2]);
                break;
            case 'provxtipo':
                return self::obtenerProvxTipo($peticion[1]);
                break;
                          
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
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
    private static function obtener($id = null,$ejercicio = null)
    {
        try {
            $whereId = !empty($id && $ejercicio) ? " WHERE " . self::SP_ID . "= :sp_id and " . self::SP_EJERCICIO . "= :sp_ejercicio" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by sp_id desc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
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

        $consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'];

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

}