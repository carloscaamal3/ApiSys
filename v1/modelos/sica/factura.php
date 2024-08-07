<?php
class factura{
	const NOMBRE_TABLA = "factura";

	# Field, Type, Null, Key, Default, Extra
	const UUID = "UUID";
	const VERSION = "Version";
	const SERIE = "Serie";
	const FOLIO = "Folio";
	const FECHA = "Fecha";
	const FORMAPAGO = "FormaPago";
	const NOCERTIFICADO = "NoCertificado";
	const SUBTOTAL = "Subtotal";
	const MONEDA = "Moneda";
	const TOTAL = "Total";
	const TOTALIMPUESTO = "TotalImpuestosTrasladados";
	const TIPOCOMPROBANTE = "TipoDeComprobante";
	const EXPORTACION = "Exportacion";
	const METODOPAGO = "MetodoPago";
	const LUGAREXPEDICION = "LugarExpedicion";
	const RFCEMISOR = "RfcEmisor";
	const NOMBREMISOR = "NombreEmisor";
	const REGIMENEMISOR = "RegimenFiscalEmisor";
	const RFCRECEPTOR = "RfcReceptor";
	const NOMBRERECEPTOR = "NombreReceptor";
	const DOMICILIORECEPTOR = "DomicilioFiscalReceptor";
	const REGIMENFISCALRECEPTOR = "RegimenFiscalReceptor";
	const USOCFDI = "UsoCFDI";
	const BASE = "Base";
	const IMPUESTO = "Impuesto";
	const TIPOFACTOR = "TipoFactor";
	const TASAOCUOTA = "TasaOCuota";
	const IMPORTE = "Importe";
	const BASE2 = "Base2";
	const IMPUESTO2 = "Impuesto2";
	const TIPOFACTOR2 = "TipoFactor2";
	const TASAOCUOTA2 = "TasaOCuota2";
	const IMPORTE2 = "Importe2";
	const OSTIPODOC = "osTipoDoc";
	const OSNUMDOC = "osNumDoc";
	const SPID = "sp_id";
	const SPEJERCICIO = "sp_ejercicio";
    const SALDO="saldoFac";
	const ACTIVO = "Activo";
	const CREADOEL = "CreadoEl";
	const CREADOPOR = "Creado_por";
	const MODIFICADOEL = "Modificado_el";
	const MODIFICADOPOR = "Modificado_por";

    // DETALLE
    const NOMBRE_TABLA_DET = "facturaDetalle";
    const UUID_DET = "UUID";
    const CONSECUTIVO = "Consecutivo";
    const CLAVEPRODSERV = "ClaveProdServ";
    const NOIDENTIFIACION = "NoIdentificacion";
    const CANTIDAD = "Cantidad";
    const CLAVEUNIDAD = "ClaveUnidad";
    const UNIDAD = "Unidad";
    const DESCRIPCION = "Descripcion";
    const VALORUNITARIO = "ValorUnitario";
    const IMPORTE_DET = "Importe"; 
    const OBJETOIMP = "ObjetoImp";
    const BASE_DET = "Base";
    const IMPUESTO_DET = "Impuesto";
    const TIPOFACTOR_DET = "TipoFactor";
    const TASAOCUOTA_DET = "TasaOCuota";
    const IMPORTEIMPUESTO = "ImporteImpuesto";

    const NOMBRE_TABLA_FACDOC = "facturaDocumento";
    const UUIDDOC ="UUID";
    const EJERCICIODOC ="ejercicio";
    const RFC = "RFC";
    const NUMDOC="numDoc";
    const TIPO ="tipo";
    const TIPODOC="tipoDoc";
    const IMPORTEFACTURA="importeFactura";
    const IMPORTEDOCUMENTO="importeDocumento";


    const CAMPOS_DET =  array (
        self::UUID,
        self::CONSECUTIVO,
        self::CLAVEPRODSERV,
        self::NOIDENTIFIACION,
        self::CANTIDAD,
        self::CLAVEUNIDAD,
        self::UNIDAD,
        self::DESCRIPCION,
        self::VALORUNITARIO,
        self::IMPORTE,
        self::OBJETOIMP,
        self::BASE,
        self::IMPUESTO,
        self::TIPOFACTOR,
        self::TASAOCUOTA,
        self::IMPORTEIMPUESTO,
    );
     const CAMPOS_FAC_DOC = array (
        self::UUIDDOC,
        self::EJERCICIODOC,
        self::RFC,
        self::NUMDOC,
        self::TIPO,
        self::TIPODOC,
        self::IMPORTEFACTURA,
        self::IMPORTEDOCUMENTO,
    );

    const CAMPOS_CAB = array (
      self::UUID,
      self::VERSION,
      self::SERIE,
      self::FOLIO,
      self::FECHA,
      self::FORMAPAGO,
      self::NOCERTIFICADO,
      self::SUBTOTAL,
      self::MONEDA,
      self::TOTAL,
      self::TOTALIMPUESTO,
      self::TIPOCOMPROBANTE,
      self::EXPORTACION,
      self::METODOPAGO,
      self::LUGAREXPEDICION,
      self::RFCEMISOR,
      self::NOMBREMISOR,
      self::REGIMENEMISOR,
      self::RFCRECEPTOR,
      self::NOMBRERECEPTOR,
      self::DOMICILIORECEPTOR,
      self::REGIMENFISCALRECEPTOR,
      self::USOCFDI,
      self::BASE,
      self::IMPUESTO,
      self::TIPOFACTOR,
      self::TASAOCUOTA,
      self::IMPORTE,
      self::BASE2,
      self::IMPUESTO2,
      self::TIPOFACTOR2,
      self::TASAOCUOTA2,
      self::IMPORTE2,
      self::OSTIPODOC,
      self::OSNUMDOC,
      self::SPID,
      self::SPEJERCICIO,
      self::SALDO,
      self::ACTIVO,
      self::CREADOEL,
      self::CREADOPOR,
      self::MODIFICADOEL,
      self::MODIFICADOPOR,
  );

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;
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
                return self::obtener($peticion[1]);
                break;
           case 'Det':
                if (!empty($peticion[1])) {
                   if (preg_match('/[a-zA-Z0-9-]/', $peticion[1])) {
                        return self::obtenerDetFiltro($peticion[1]);
                    }
                }
                return self::obtenerDet($peticion[1]);
                break;
            case 'FacDoc':
                if (!empty($peticion[1])) {
                   if (preg_match('/[a-zA-Z0-9-]/', $peticion[1])) {
                        return self::obtenerDetFiltroFacDoc($peticion[1]);
                    }
                }
                ///return self::obtenerDet($peticion[1]);
                break;    
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
    }
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
            case 'crea':
            $id = self::crear($idUsuario);
            http_response_code(201);
            return [
                "estado" => self::CODIGO_EXITO,
                "mensaje" => "¡Registro creado con éxito!",
                "id" => $id
            ];
            break;
        case 'creaDet':
            $id = self::crearDet($idUsuario);
            http_response_code(201);
            return [
                "estado" => self::CODIGO_EXITO,
                "mensaje" => "¡Registro creado con éxito!",
                "id" => $id
            ];
            break;
         case 'creaFacDoc':
                $id = self::crearFacDoc($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
          break;
        }
    }
     public static function put($peticion)
    {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        $idUsuario = $validaToken['data']->id;
        switch ($peticion[0]) {
            case 'saldo':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    if (self::actualizaSaldo($datos, $peticion[1], $idUsuario) > 0) {
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
    public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        $idUsuario = $validaToken['data']->id;
      switch ($peticion[0]) {
            case 'cab':
                if (self::eliminarCab($peticion[1]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "La factura se elimino correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;
            case 'det':
                if (self::eliminarDet($peticion[1]) > 0) {

                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro eliminado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;
             case 'delFacDoc':
                if (self::eliminarFacDoc($peticion[1], $peticion[2]) > 0) {

                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro eliminado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;                 
        }

    }
    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS_CAB;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
        // Sanitiza los campos recibidos

            $UUID = htmlspecialchars(strip_tags($datos->UUID));
            $Version = htmlspecialchars(strip_tags($datos->Version));
            $Serie = htmlspecialchars(strip_tags($datos->Serie));
            $Folio = htmlspecialchars(strip_tags($datos->Folio));
            $Fecha = htmlspecialchars(strip_tags($datos->Fecha));
            $FormaPago = htmlspecialchars(strip_tags($datos->FormaPago));
            $NoCertificado = htmlspecialchars(strip_tags($datos->NoCertificado));
            $Subtotal = htmlspecialchars(strip_tags($datos->Subtotal));
            $Moneda = htmlspecialchars(strip_tags($datos->Moneda));
            $Total = htmlspecialchars(strip_tags($datos->Total));
            $TotalImpuestosTrasladados = htmlspecialchars(strip_tags($datos->TotalImpuestosTrasladados));
            $TipoDeComprobante = htmlspecialchars(strip_tags($datos->TipoDeComprobante));
            $Exportacion = htmlspecialchars(strip_tags($datos->Exportacion));
            $MetodoPago = htmlspecialchars(strip_tags($datos->MetodoPago));
            $LugarExpedicion = htmlspecialchars(strip_tags($datos->LugarExpedicion));
            $RfcEmisor = htmlspecialchars(strip_tags($datos->RfcEmisor));
            $NombreEmisor = htmlspecialchars(strip_tags($datos->NombreEmisor));
            $RegimenFiscalEmisor = htmlspecialchars(strip_tags($datos->RegimenFiscalEmisor));
            $RfcReceptor = htmlspecialchars(strip_tags($datos->RfcReceptor));
            $NombreReceptor = htmlspecialchars(strip_tags($datos->NombreReceptor));
            $DomicilioFiscalReceptor = htmlspecialchars(strip_tags($datos->DomicilioFiscalReceptor));
            $RegimenFiscalReceptor = htmlspecialchars(strip_tags($datos->RegimenFiscalReceptor));
            $UsoCFDI = htmlspecialchars(strip_tags($datos->UsoCFDI));
            $Base = htmlspecialchars(strip_tags($datos->Base));
            $Impuesto = htmlspecialchars(strip_tags($datos->Impuesto));
            $TipoFactor = htmlspecialchars(strip_tags($datos->TipoFactor));
            $TasaOCuota = htmlspecialchars(strip_tags($datos->TasaOCuota));
            $Importe = htmlspecialchars(strip_tags($datos->Importe));
            $Base2 = htmlspecialchars(strip_tags($datos->Base2));
            $Impuesto2 = htmlspecialchars(strip_tags($datos->Impuesto2));
            $TipoFactor2 = htmlspecialchars(strip_tags($datos->TipoFactor2));
            $TasaOCuota2 = htmlspecialchars(strip_tags($datos->TasaOCuota2));
            $Importe2 = htmlspecialchars(strip_tags($datos->Importe2));
            $osTipoDoc = htmlspecialchars(strip_tags($datos->osTipoDoc));
            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $sp_id = htmlspecialchars(strip_tags($datos->sp_id));
            $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $saldoFac = htmlspecialchars(strip_tags($datos->saldoFac));
            $Activo = htmlspecialchars(strip_tags($datos->Activo));
        // $CreadoEl = htmlspecialchars(strip_tags($datos->CreadoEl));
        // $Creado_por = htmlspecialchars(strip_tags($datos->Creado_por));
        // $Modificado_el = htmlspecialchars(strip_tags($datos->Modificado_el));
        // $Modificado_por = htmlspecialchars(strip_tags($datos->Modificado_por));
            $CreadoPor = $idUsuario;

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::UUID . ", " .
                    self::VERSION . ", " .
                    self::SERIE . ", " .
                    self::FOLIO . ", " .
                    self::FECHA . ", " .
                    self::FORMAPAGO . ", " .
                    self::NOCERTIFICADO . ", " .
                    self::SUBTOTAL . ", " .
                    self::MONEDA . ", " .
                    self::TOTAL . ", " .
                    self::TOTALIMPUESTO . ", " .
                    self::TIPOCOMPROBANTE . ", " .
                    self::EXPORTACION . ", " .
                    self::METODOPAGO . ", " .
                    self::LUGAREXPEDICION . ", " .
                    self::RFCEMISOR . ", " .
                    self::NOMBREMISOR . ", " .
                    self::REGIMENEMISOR . ", " .
                    self::RFCRECEPTOR . ", " .
                    self::NOMBRERECEPTOR . ", " .
                    self::DOMICILIORECEPTOR . ", " .
                    self::REGIMENFISCALRECEPTOR . ", " .
                    self::USOCFDI . ", " .
                    self::BASE . ", " .
                    self::IMPUESTO . ", " .
                    self::TIPOFACTOR . ", " .
                    self::TASAOCUOTA . ", " .
                    self::IMPORTE . ", " .
                    self::BASE2 . ", " .
                    self::IMPUESTO2 . ", " .
                    self::TIPOFACTOR2 . ", " .
                    self::TASAOCUOTA2 . ", " .
                    self::IMPORTE2 . ", " .
                    self::OSTIPODOC . ", " .
                    self::OSNUMDOC . ", " .
                    self::SPID . ", " .
                    self::SPEJERCICIO . ", " .
                    self::SALDO . ", " .
                    self::ACTIVO . ", " .
                    self::CREADOPOR . ")" .
                "VALUES (:UUID, :Version, :Serie, :Folio, :Fecha, :FormaPago, :NoCertificado, :Subtotal, :Moneda, :Total, " .
                    ":TotalImpuestosTrasladados, :TipoDeComprobante, :Exportacion, :MetodoPago, :LugarExpedicion, " .
                    ":RfcEmisor, :NombreEmisor, :RegimenFiscalEmisor, :RfcReceptor, :NombreReceptor, " .
                    ":DomicilioFiscalReceptor, :RegimenFiscalReceptor, :UsoCFDI, :Base, :Impuesto, :TipoFactor, " .
                    ":TasaOCuota, :Importe, :Base2, :Impuesto2, :TipoFactor2, :TasaOCuota2, :Importe2, " .
                    ":osTipoDoc, :osNumDoc, :sp_id, :sp_ejercicio, :saldoFac, :Activo, :Creado_por)";


            // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":UUID", $UUID, PDO::PARAM_STR);
                $sentencia->bindParam(":Version", $Version, PDO::PARAM_STR);
                $sentencia->bindParam(":Serie", $Serie, PDO::PARAM_STR);
                $sentencia->bindParam(":Folio", $Folio, PDO::PARAM_INT);
                $sentencia->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
                $sentencia->bindParam(":FormaPago", $FormaPago, PDO::PARAM_STR);
                $sentencia->bindParam(":NoCertificado", $NoCertificado, PDO::PARAM_STR);
                $sentencia->bindParam(":Subtotal", $Subtotal, PDO::PARAM_STR);
                $sentencia->bindParam(":Moneda", $Moneda, PDO::PARAM_STR);
                $sentencia->bindParam(":Total", $Total, PDO::PARAM_STR);
                $sentencia->bindParam(":TotalImpuestosTrasladados", $TotalImpuestosTrasladados, PDO::PARAM_STR);
                $sentencia->bindParam(":TipoDeComprobante", $TipoDeComprobante, PDO::PARAM_STR);
                $sentencia->bindParam(":Exportacion", $Exportacion, PDO::PARAM_STR);
                $sentencia->bindParam(":MetodoPago", $MetodoPago, PDO::PARAM_STR);
                $sentencia->bindParam(":LugarExpedicion", $LugarExpedicion, PDO::PARAM_STR);
                $sentencia->bindParam(":RfcEmisor", $RfcEmisor, PDO::PARAM_STR);
                $sentencia->bindParam(":NombreEmisor", $NombreEmisor, PDO::PARAM_STR);
                $sentencia->bindParam(":RegimenFiscalEmisor", $RegimenFiscalEmisor, PDO::PARAM_STR);
                $sentencia->bindParam(":RfcReceptor", $RfcReceptor, PDO::PARAM_STR);
                $sentencia->bindParam(":NombreReceptor", $NombreReceptor, PDO::PARAM_STR);
                $sentencia->bindParam(":DomicilioFiscalReceptor", $DomicilioFiscalReceptor, PDO::PARAM_STR);
                $sentencia->bindParam(":RegimenFiscalReceptor", $RegimenFiscalReceptor, PDO::PARAM_STR);
                $sentencia->bindParam(":UsoCFDI", $UsoCFDI, PDO::PARAM_STR);
                $sentencia->bindParam(":Base", $Base, PDO::PARAM_STR);
                $sentencia->bindParam(":Impuesto", $Impuesto, PDO::PARAM_STR);
                $sentencia->bindParam(":TipoFactor", $TipoFactor, PDO::PARAM_STR);
                $sentencia->bindParam(":TasaOCuota", $TasaOCuota, PDO::PARAM_STR);
                $sentencia->bindParam(":Importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":Base2", $Base2, PDO::PARAM_STR);
                $sentencia->bindParam(":Impuesto2", $Impuesto2, PDO::PARAM_STR);
                $sentencia->bindParam(":TipoFactor2", $TipoFactor2, PDO::PARAM_STR);
                $sentencia->bindParam(":TasaOCuota2", $TasaOCuota2, PDO::PARAM_STR);
                $sentencia->bindParam(":Importe2", $Importe2, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":saldoFac", $saldoFac, PDO::PARAM_STR);
                $sentencia->bindParam(":Activo", $Activo, PDO::PARAM_STR);
                $sentencia->bindParam(":Creado_por", $CreadoPor, PDO::PARAM_INT);

            // var_dump($comando);
                $sentencia->execute();
            // Retornar en el último id insertado
            // return $pdo->lastInsertId();
                return $pdo;
            } catch (PDOException $e) {
            // VAR_DUMP($e);
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            "Error en el cuerpo de la solicitud",
            400
        );
    }
    private static function crearFacDoc($idUsuario)
{
    $body = file_get_contents('php://input');
    $datos = json_decode($body);

    if ($datos) {
        $campos = self::CAMPOS_FAC_DOC;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
        // Sanitiza los campos recibidos
       
        $UUID = htmlspecialchars(strip_tags($datos->UUID));
        $ejercicio = htmlspecialchars(strip_tags($datos->ejercicio));
        $RFC = htmlspecialchars(strip_tags($datos->RFC));
        $numDoc = htmlspecialchars(strip_tags($datos->numDoc));
        $tipo = htmlspecialchars(strip_tags($datos->tipo));
        $tipoDoc = htmlspecialchars(strip_tags($datos->tipoDoc));
        $importeFactura = htmlspecialchars(strip_tags($datos->importeFactura));
        $importeDocumento = htmlspecialchars(strip_tags($datos->importeDocumento));
        $CreadoPor = $idUsuario;

        try {
            $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

            $comando = "INSERT INTO " . self::NOMBRE_TABLA_FACDOC . " ( " .
                self::UUIDDOC . ", " .
                self::EJERCICIODOC . ", " .
                self::RFC. ", " .
                self::NUMDOC . ", " .
                self::TIPO . ", " .
                self::TIPODOC . ", " .
                self::IMPORTEFACTURA . ", " .
                self::IMPORTEDOCUMENTO . ")" .
                "VALUES (:UUID, :ejercicio, :RFC, :numDoc, :tipo, :tipoDoc, " .
                ":importeFactura, :importeDocumento)";

            // Preparar la sentencia
            $sentencia = $pdo->prepare($comando);
            $sentencia->bindParam(":UUID", $UUID, PDO::PARAM_STR);
            $sentencia->bindParam(":ejercicio", $ejercicio, PDO::PARAM_INT);
            $sentencia->bindParam(":RFC", $RFC, PDO::PARAM_STR);
            $sentencia->bindParam(":numDoc", $numDoc, PDO::PARAM_INT);
            $sentencia->bindParam(":tipo", $tipo, PDO::PARAM_STR);
            $sentencia->bindParam(":tipoDoc", $tipoDoc, PDO::PARAM_STR);
            $sentencia->bindParam(":importeFactura", $importeFactura, PDO::PARAM_STR);
            $sentencia->bindParam(":importeDocumento", $importeDocumento, PDO::PARAM_STR);
          //  $sentencia->bindParam(":CreadoPor", $CreadoPor, PDO::PARAM_INT);

            $sentencia->execute();
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
    private static function crearDet($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS_DET;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        // Sanitiza los campos recibidos
            var_dump($datos);
            $UUID = htmlspecialchars(strip_tags($datos->UUID));
            $Consecutivo = htmlspecialchars(strip_tags($datos->Consecutivo));
            $ClaveProdServ = htmlspecialchars(strip_tags($datos->ClaveProdServ));
            $NoIdentificacion = htmlspecialchars(strip_tags($datos->NoIdentificacion));
            $Cantidad = htmlspecialchars(strip_tags($datos->Cantidad));
            $ClaveUnidad = htmlspecialchars(strip_tags($datos->ClaveUnidad));
            $Unidad = htmlspecialchars(strip_tags($datos->Unidad));
            $Descripcion = htmlspecialchars(strip_tags($datos->Descripcion));
            $ValorUnitario = htmlspecialchars(strip_tags($datos->ValorUnitario));
            $Importe = htmlspecialchars(strip_tags($datos->Importe));
            $ObjetoImp = htmlspecialchars(strip_tags($datos->ObjetoImp));
            $Base = htmlspecialchars(strip_tags($datos->Base));
            $Impuesto = htmlspecialchars(strip_tags($datos->Impuesto));
            $TipoFactor = htmlspecialchars(strip_tags($datos->TipoFactor));
            $TasaOCuota = htmlspecialchars(strip_tags($datos->TasaOCuota));
            $ImporteImpuesto = htmlspecialchars(strip_tags($datos->ImporteImpuesto));
            $CreadoPor = $idUsuario;

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA_DET . " ( " .
                    self::UUID_DET . ", " .
                    self::CONSECUTIVO . ", " .
                    self::CLAVEPRODSERV . ", " .
                    self::NOIDENTIFIACION . ", " .
                    self::CANTIDAD . ", " .
                    self::CLAVEUNIDAD . ", " .
                    self::UNIDAD . ", " .
                    self::DESCRIPCION . ", " .
                    self::VALORUNITARIO . ", " .
                    self::IMPORTE_DET . ", " .
                    self::OBJETOIMP . ", " .
                    self::BASE . ", " .
                    self::IMPUESTO_DET . ", " .
                    self::TIPOFACTOR_DET . ", " .
                    self::TASAOCUOTA_DET . ", " .
                    self::IMPORTEIMPUESTO . ")" .
                "VALUES (:UUID, :Consecutivo, :ClaveProdServ, :NoIdentificacion, :Cantidad, :ClaveUnidad, " .
                    ":Unidad, :Descripcion, :ValorUnitario, :Importe, :ObjetoImp, " .
                ":Base, :Impuesto, :TipoFactor, :TasaOCuota, :ImporteImpuesto)"; // Agrega

            // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":UUID", $UUID, PDO::PARAM_STR);
                $sentencia->bindParam(":Consecutivo", $Consecutivo, PDO::PARAM_STR);
                $sentencia->bindParam(":ClaveProdServ", $ClaveProdServ, PDO::PARAM_STR);
                $sentencia->bindParam(":NoIdentificacion", $NoIdentificacion, PDO::PARAM_STR);
                $sentencia->bindParam(":Cantidad", $Cantidad, PDO::PARAM_STR);
                $sentencia->bindParam(":ClaveUnidad", $ClaveUnidad, PDO::PARAM_STR);
                $sentencia->bindParam(":Unidad", $Unidad, PDO::PARAM_STR);
                $sentencia->bindParam(":Descripcion", $Descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":ValorUnitario", $ValorUnitario, PDO::PARAM_STR);
                $sentencia->bindParam(":Importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":ObjetoImp", $ObjetoImp, PDO::PARAM_STR);
                $sentencia->bindParam(":Base", $Base, PDO::PARAM_STR);
                $sentencia->bindParam(":Impuesto", $Impuesto, PDO::PARAM_STR);
                $sentencia->bindParam(":TipoFactor", $TipoFactor, PDO::PARAM_STR);
                $sentencia->bindParam(":TasaOCuota", $TasaOCuota, PDO::PARAM_STR);
                $sentencia->bindParam(":ImporteImpuesto", $ImporteImpuesto, PDO::PARAM_STR);
          //  $sentencia->bindParam(":CreadoPor", $CreadoPor, PDO::PARAM_INT);

            // var_dump($comando);
                $sentencia->execute();
            // Retornar en el último id insertado
            // return $pdo->lastInsertId();
                return $pdo;
            } catch (PDOException $e) {
            // VAR_DUMP($e);
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            "Error en el cuerpo de la solicitud",
            400
        );
    }
    private static function obtener($id = null)
    {
        try {
           // $whereId = !empty($id && $ejercicio) ? " WHERE " . self::SP_ID . "= :UUID and " . self::SP_EJERCICIO . "= :sp_ejercicio" : "";
            $whereId = !empty($id) ? " WHERE " . self::UUID . "= :UUID " : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by UUID";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":UUID", $id, PDO::PARAM_INT);
                //$sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
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
    private static function obtenerFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_CAB);

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
    private static function obtenerDet($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::UUID . "= :UUID" : "";
            
            $comando = "SELECT * FROM " . self::NOMBRE_TABLA_DET . $whereId;
            //$comando = self::SELECT_DET . self::NOMBRE_TABLA_DET . self::INNER_DET . $whereId . " order by UUID desc ";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            if (!empty($id)) {
                $sentencia->bindParam(":UUID", $id, PDO::PARAM_INT);
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
    private static function obtenerDetFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_DET);

        $consulta = "SELECT * FROM " . self::NOMBRE_TABLA_DET . $filtro['where'];
        // $consulta = self::SELECT_DET . self::NOMBRE_TABLA_DET . self::INNER_DET . $filtro['where'] . " order by UUID desc ";

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
    private static function obtenerDetFiltroFacDoc($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_FAC_DOC);

        $consulta = "SELECT * FROM " . self::NOMBRE_TABLA_FACDOC . $filtro['where'];
        // $consulta = self::SELECT_DET . self::NOMBRE_TABLA_DET . self::INNER_DET . $filtro['where'] . " order by UUID desc ";

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
    private static function eliminarCab($peticion)
    {

    $consulta = "DELETE FROM " . self::NOMBRE_TABLA .
        " WHERE " . self::UUID . " = :UUID";
    try {
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":UUID",$peticion, PDO::PARAM_STR);
        $sentencia->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
}
  private static function eliminarDet($peticion)
{
    $consulta = "DELETE FROM " . self::NOMBRE_TABLA_DET .
        " WHERE " . self::UUID_DET . " = :UUID_DET";
    try {
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":UUID_DET", $peticion, PDO::PARAM_STR);
        $sentencia->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
}
/*private static function eliminarFacDoc($uuid2)
{
    $consulta = "DELETE FROM " . self::NOMBRE_TABLA_FACDOC .
        " WHERE " . self::UUIDDOC . " = :UUIDDOC";
    try {
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":UUIDDOC", $uuid2, PDO::PARAM_STR);
        $sentencia->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
}*/
private static function eliminarFacDoc($id, $UUID)
{
   /* $consulta = "DELETE FROM " . self::NOMBRE_TABLA_FACDOC .
        " WHERE " . self::UUIDDOC . " = :UUIDDOC AND "
        . self::IDLICITACION_DET . " = :idLicitacion";*/
  
        $consulta = "DELETE FROM " . self::NOMBRE_TABLA_FACDOC .
        " WHERE " . self::NUMDOC . " = :numDoc" . " AND " . self::UUIDDOC . " = :UUID" ;

    try {
        $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

        $comandoPubTotal = "SELECT importeFactura FROM facturaDocumento WHERE numDoc = :numDoc AND UUID = :UUID";
        $sentenciaPubTotal = $pdo->prepare($comandoPubTotal);
        $sentenciaPubTotal->bindParam(":numDoc", $id, PDO::PARAM_STR);
        $sentenciaPubTotal->bindParam(":UUID", $UUID, PDO::PARAM_STR);
        $sentenciaPubTotal->execute();
        $resultadoPubTotal = $sentenciaPubTotal->fetch(PDO::FETCH_ASSOC);
        $pubTotalActual = $resultadoPubTotal['importeFactura'];
         //var_dump($comandoPubTotal);
        
        $comandoMonto = "SELECT osTotalFact FROM ordenes_sica WHERE osNumDoc = :numDoc";
        $sentenciaMonto = $pdo->prepare($comandoMonto);
        $sentenciaMonto->bindParam(":numDoc", $id, PDO::PARAM_STR);
        $sentenciaMonto->execute();
        $resultadoMonto = $sentenciaMonto->fetch(PDO::FETCH_ASSOC);
        $montoEliminado = $resultadoMonto['osTotalFact'];


        $pubTotalFinal = $montoEliminado - $pubTotalActual;
        $comandoActualizar = "UPDATE ordenes_sica SET osTotalFact = :pubTotalFinal WHERE osNumDoc = :osNumDoc";
        $sentenciaActualizar = $pdo->prepare($comandoActualizar);
        $sentenciaActualizar->bindParam(":pubTotalFinal", $pubTotalFinal, PDO::PARAM_INT);
        $sentenciaActualizar->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
        $sentenciaActualizar->execute();

     
        $sentencia = $pdo->prepare($consulta);
        $sentencia->bindParam(":numDoc", $id, PDO::PARAM_STR);
        $sentencia->bindParam(":UUID", $UUID, PDO::PARAM_STR);
        //$sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
        $sentencia->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
}
  private static function actualizaSaldo($datos, $id, $idUsuario)
    {

        if ($datos) {
            $campos = self::CAMPOS_CAB;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $saldoFac = htmlspecialchars(strip_tags($datos->saldoFac));
            $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::SALDO . " = :saldoFac, " .
            self::MODIFICADOEL . " = CURRENT_TIMESTAMP(6), " .
            self::MODIFICADOPOR . " =  :modificado_por" .
            " WHERE " . self::UUID . " = :UUID";
            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":saldoFac", $saldoFac, PDO::PARAM_STR);
                $sentencia->bindParam(":modificado_por", $ModificadPor, PDO::PARAM_INT);

                $sentencia->bindParam(":UUID", $id, PDO::PARAM_STR);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }



}