<?php
class ordensica{

    const NOMBRE_TABLA = "ordenes_sica";
    //const OSID = "osID";

    const OSNUMDOC = "osNumDoc";
    const OSTIPODOC = "osTipoDoc";
    const OSTIPOOS = "osTipoOs";
    const OSFECHA = "osFecha";
    const OSEMPSOLICITA = "osEmpSolicita";
    const OSDESCRIPCION = "osDescripcion";
    const OSOBSERVACION = "osObservacion";
    const SPTIPOSERV = "sp_tipoServicio";
    const OSOLICITUDSERV="osSolicitudServicio";
    const VEID ="osVeh_id";

    const OSUSERCREA = "osUserCrea";
    const OSFECHAELABORA = "osFechaElabora";

    const OSUSERMOD = "osUserMod";
    const OSFECHAMOD = "osFechaMod";
    
    const OSDIRSOLICITA = "osDirSolicita";
    const OSDEPTOSOLICITA = "osDeptoSolicita";
    const OSDIRDESTINO = "osDirDestino";
    const OSDEPTODESTINO = "osDeptoDestino";
    const OSSUBTOTAL = "osSubTotal";
    const OSDESCUENTO = "osDescuento";
    const OSIVA = "osIva";
    const OSTOTAL = "osTotal";
    const OSTIPOADJUDICACION = "osTipoAdjudicacion";
    const OSGENADJUDICACION = "osgenAdjudicacion";
    const OSCRFF = "osCRFF";
    const SP_ID = "sp_id";
    const SP_EJERCICIO = "sp_ejercicio";
    const PROV_ID = "prov_id";
    const PROV_EMAIL = "prov_email";
    const PROV_EMAIL2 = "prov_email2";

    const SP_TIPO_SOL = "sp_tipo_sol";
    const SP_CONCEPTO = "sp_concepto";
    const CUECON_CUENTA = "cuecon_cuenta";

    const OSFECHALIMENTREGA = "osFechaLimEntrega";
    const OSLUGARENTREGA = "osLugarEntrega";
    const OSDIASCREDITO = "osDiasCredito";
    const PROV_DIRECCION = "prov_direccion";
    const PROV_CIUDAD = "prov_ciudad";

    const OSESTATUS = "osEstatus";

    const OSEMPSOLFIR = "osEmpSolFir";
    const OSEMPAUT = "osEmpAut";

    const SP_FECHA_PROB_PAGO = "sp_fecha_prob_pago";
    const CONTRARECIBO = "contrarecibo";
    const SP_COMPROMETIDO = "sp_comprometido";

    //D  E  T  A  L  L  E
    const NOMBRE_TABLA_DET = "ordenes_sica_det";
    const OSNUMDOCDET = "osNumDoc";
    const OSDETPOSICION = "osDetPosicion";
    const PROD_ID = "prod_id";
    const UNIDAD_ID = "unidad_id";
    const MARCA_ID = "marca_id";
    const DESCRIPCION = "osDescripcion";

    const OSDETCANTIDAD = "osDetCantidad";
    const OSDETPRECIO = "osDetPrecio";
    const OSPORCDCTO = "osPorcDcto";
    const OSDETDESCUENTO = "osDetDescuento";
    const OSDETSUBTOTAL = "osDetSubtotal";
    const OSDETTASAIVA = "osDetTasaIVA";
    const OSDETIVA = "osDetIVA";
    const OSDETTOTAL = "osDetTotal";
    const TOTALFACT = "osTotalFact";

    const OSDETACTIVO = "osDetActivo";
    const MODIFICADO_EL ="modificado_el";
    const MODIFICADO_POR="modificado_por";

    const CAMPOS_OS_COMPRAS_DET = array(
        self::OSNUMDOC,
        self::OSDETPOSICION,
        self::PROD_ID,
        self::DESCRIPCION,
        self::UNIDAD_ID,
        self::MARCA_ID,
        self::OSDETCANTIDAD,
        self::OSDETPRECIO,
        self::OSPORCDCTO,
        self::OSDETDESCUENTO,
        self::OSDETSUBTOTAL,
        self::OSDETTASAIVA,
        self::OSDETIVA,
        self::OSDETTOTAL,
        self::OSDETACTIVO,
    );

    const CAMPOS_OS_COMPRAS_DET_ACT = array(
        self::PROD_ID,
        self::UNIDAD_ID,
        self::MARCA_ID,
        self::DESCRIPCION,
        self::OSDETCANTIDAD,
        self::OSDETPRECIO,
        self::OSPORCDCTO,
        self::OSDETDESCUENTO,
        self::OSDETSUBTOTAL,
        self::OSDETTASAIVA,
        self::OSDETIVA,
        self::OSDETTOTAL,
        self::OSDETACTIVO,
    );

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    //29
    const CAMPOS_OS_COMPRAS = array(
        self::OSNUMDOC,
        self::OSTIPODOC,
        self::OSTIPOOS,
        self::OSOLICITUDSERV,
        self::OSFECHA,
        self::VEID,
        self::SPTIPOSERV,
        self::OSEMPSOLICITA,
        self::OSDESCRIPCION,
        self::OSOBSERVACION,
        self::OSDIRSOLICITA,
        self::OSDEPTOSOLICITA,
        self::OSDIRDESTINO,
        self::OSDEPTODESTINO,
        self::OSSUBTOTAL,
        self::OSDESCUENTO,
        self::OSIVA,
        self::OSTOTAL,
        self::OSTIPOADJUDICACION,
        self::OSGENADJUDICACION,
        self::PROV_ID,
        self::CUECON_CUENTA,
        self::OSESTATUS,
        self::SP_TIPO_SOL,
        self::SP_CONCEPTO,
        self::OSFECHALIMENTREGA,
        self::OSLUGARENTREGA,
        self::OSDIASCREDITO,
        self::PROV_DIRECCION,
        self::PROV_CIUDAD,
        self::OSEMPSOLFIR,
        self::TOTALFACT,
        self::SP_EJERCICIO,
        self::SP_ID,
        self::OSEMPAUT,
        self::SP_FECHA_PROB_PAGO,
        self::CONTRARECIBO,
        self::SP_COMPROMETIDO,
    );
    const SELECT_STRING = "select os.osNumDoc,
    os.osTipoDoc, TipoDoc.tipo_descripcion as TipoDocDescripcion,
    os.osTipoOs, tipoOs.tipo_descripcion as TipoOsDescripcion,
    os.osFecha,os.osTotalFact,
    os.sp_tipoServicio,
    os.osSolicitudServicio,
    os.osEmpSolicita, es.emp_nombre as osEmpSolicitaNombre,
    os.osUserCrea, u.usr_nombres as userCreaNombre,
    os.osDescripcion,os.osObservacion,
    os.osDirSolicita,os.osDeptoSolicita,
    os.osDirDestino,os.osDeptoDestino,
    os.osSubTotal,os.osDescuento,os.osIva,os.osTotal,
    os.osTipoAdjudicacion,tipoAd.tipo_descripcion as TipoAdjudicacion,
    os.osgenAdjudicacion,tipoGen.tipo_descripcion as genAdjudicacion,
    os.osCRFF,
    os.sp_id, os.sp_ejercicio, os.sp_tipo_sol, tipoSol.tipo_descripcion as sp_tipo_sol_desc,
    os.sp_concepto, tipoCon.tipo_descripcion as sp_concepto_desc,
    os.prov_id, p.prov_razon_social,p.prov_RFC,os.prov_email,os.prov_email2,
    os.cuecon_cuenta,
    os.contrarecibo,
    os.sp_comprometido,
    os.sp_fecha_prob_pago,
    os.osFechaLimEntrega,os.osLugarEntrega,os.osDiasCredito,
    os.prov_direccion,os.prov_ciudad,
    os.osEstatus, est.tipo_descripcion as estatus_nombre, est.tipo_orden as estatus_orden,
    os.osEmpSolFir,esf.emp_nombre as nombre_sol,
    esf.emp_puesto as puesto_sol, esf.emp_titulo as titulo_sol, esf.emp_direccion as direccion_sol,
    os.osEmpAut,ea.emp_nombre as nombre_aut,
    ea.emp_puesto as puesto_aut, ea.emp_titulo as titulo_aut, ea.emp_direccion as direccion_aut
    from ";

    const INNER_STRING = " os INNER JOIN tipo TipoDoc ON os.osTipoDoc = TipoDoc.tipo_clave AND TipoDoc.clatip_id = 'TIPDOC'
    INNER JOIN tipo tipoOs ON os.osTipoOs = tipoOs.tipo_clave AND tipoOs.clatip_id = 'TIPSER'
    INNER JOIN tipo tipoAd ON os.osTipoAdjudicacion = tipoAd.tipo_clave AND tipoAd.clatip_id = 'ADJUDICA'
    INNER JOIN tipo tipoGen ON os.osgenAdjudicacion = tipoGen.tipo_clave AND tipoGen.clatip_id = 'GENADJ'
    INNER JOIN tipo tipoSol ON os.sp_tipo_sol = tipoSol.tipo_clave AND tipoSol.clatip_id = 'TIPSOL'
    INNER JOIN tipo tipoCon ON os.sp_concepto = tipoCon.tipo_clave 
    INNER JOIN empleado es ON os.osEmpSolicita = es.emp_id
    INNER JOIN usuario u ON os.osUserCrea = u.usr_id
    INNER JOIN proveedor p ON os.prov_id = p.prov_id
    INNER JOIN tipo est ON os.osEstatus = est.tipo_clave AND est.clatip_id = 'ESTATUSOS'
    INNER JOIN empleado ea ON os.osEmpAut = ea.emp_id
    INNER JOIN empleado esf ON os.osEmpSolFir = esf.emp_id";


    const SELECT_STRING_SERVICIO = "select os.osNumDoc,
    os.osTipoDoc, TipoDoc.tipo_descripcion as TipoDocDescripcion,
    os.osTipoOs, tipoOs.tipo_descripcion as TipoOsDescripcion,
    os.osFecha,os.osTotalFact,
    IFNULL(os.osVeh_id, '') as osVeh_id,
    IFNULL(vh.veh_anio, '') as vh_anio,
    IFNULL(vh.veh_modelo, '') as vh_modelo, 
    IFNULL(vh.veh_placas, '') as vh_placas,
    IFNULL(esf.emp_nombre, '') as esf_emp_nombre,
    IFNULL(vh.veh_marca_id, '') as vh_veh_marca_id, m.tipo_descripcion as marca,
    os.sp_tipoServicio,
    os.osSolicitudServicio,
    os.osEmpSolicita, es.emp_nombre as osEmpSolicitaNombre,
    os.osUserCrea, u.usr_nombres as userCreaNombre,
    os.osDescripcion,os.osObservacion,
    os.osDirSolicita,os.osDeptoSolicita,
    os.osDirDestino,os.osDeptoDestino,
    os.osSubTotal,os.osDescuento,os.osIva,os.osTotal,
    os.osTipoAdjudicacion,tipoAd.tipo_descripcion as TipoAdjudicacion,
    os.osgenAdjudicacion,tipoGen.tipo_descripcion as genAdjudicacion,
    os.osCRFF,
    os.sp_id, os.sp_ejercicio, os.sp_tipo_sol, tipoSol.tipo_descripcion as sp_tipo_sol_desc,
    os.sp_concepto, tipoCon.tipo_descripcion as sp_concepto_desc,
    os.prov_id, p.prov_razon_social,p.prov_RFC,os.prov_email,os.prov_email2,
    os.cuecon_cuenta,
    os.contrarecibo,
    os.sp_comprometido,
    os.sp_fecha_prob_pago,
    os.osFechaLimEntrega,os.osLugarEntrega,os.osDiasCredito,
    os.prov_direccion,os.prov_ciudad,
    os.osEstatus, est.tipo_descripcion as estatus_nombre, est.tipo_orden as estatus_orden,
    os.osEmpSolFir,esf.emp_nombre as nombre_sol,
    esf.emp_puesto as puesto_sol, esf.emp_titulo as titulo_sol, esf.emp_direccion as direccion_sol,
    os.osEmpAut,ea.emp_nombre as nombre_aut,
    ea.emp_puesto as puesto_aut, ea.emp_titulo as titulo_aut, ea.emp_direccion as direccion_aut
    from ";


    const INNER_STRING_SERVICIO = " os INNER JOIN tipo TipoDoc ON os.osTipoDoc = TipoDoc.tipo_clave AND TipoDoc.clatip_id = 'TIPDOC'
    INNER JOIN tipo tipoOs ON os.osTipoOs = tipoOs.tipo_clave AND tipoOs.clatip_id = 'TIPSER'
    INNER JOIN tipo tipoAd ON os.osTipoAdjudicacion = tipoAd.tipo_clave AND tipoAd.clatip_id = 'ADJUDICA'
    INNER JOIN tipo tipoGen ON os.osgenAdjudicacion = tipoGen.tipo_clave AND tipoGen.clatip_id = 'GENADJ'
    INNER JOIN tipo tipoSol ON os.sp_tipo_sol = tipoSol.tipo_clave AND tipoSol.clatip_id = 'TIPSOL'
    INNER JOIN tipo tipoCon ON os.sp_concepto = tipoCon.tipo_clave 
    INNER JOIN empleado es ON os.osEmpSolicita = es.emp_id
    INNER JOIN usuario u ON os.osUserCrea = u.usr_id
    INNER JOIN proveedor p ON os.prov_id = p.prov_id
    INNER JOIN tipo est ON os.osEstatus = est.tipo_clave AND est.clatip_id = 'ESTATUSOS'
    LEFT JOIN empleado ea ON os.osEmpAut = ea.emp_id
    LEFT JOIN empleado esf ON os.osEmpSolFir = esf.emp_id
    LEFT JOIN vehiculo vh ON os.osVeh_id = vh.Veh_id
    LEFT JOIN tipo m on vh.veh_marca_id = m.tipo_clave and m.clatip_id = 'MARCAVEH'";


    const SELECT_STRING_DET = "select d.osNumDoc,
    d.osDetPosicion,
    d.prod_id, p.prod_descripcion,
    p.unidad_id as unidad_id_prod, up.tipo_descripcion as unidad_id_prod_desc,
    ifnull(p.prod_numparte,'') as prod_numparte,
    p.familia_id, fp.tipo_descripcion as familia_desc,
    d.unidad_id as unidad_id_det,ud.tipo_descripcion as unidad_id_det_desc,
    d.marca_id, md.tipo_descripcion as marca_desc,
    d.osDetCantidad,
    d.osDescripcion,
    d.osDetPrecio,
    d.osPorcDcto,d.osDetDescuento,
    d.osDetSubtotal,
    d.osDetTasaIVA, d.osDetIVA,
    d.osDetTotal,    
    d.osDetActivo
    from ";
    const INNER_STRING_DET = " d inner join producto p on d.prod_id = p.prod_id
    inner join tipo up on p.unidad_id = up.tipo_clave and up.clatip_id = 'UNIPROD'
    inner join tipo fp on p.familia_id = fp.tipo_clave and fp.clatip_id = 'FAMPROD'
    inner join tipo ud on d.unidad_id = ud.tipo_clave and ud.clatip_id = 'UNIPROD'
    left join tipo md on d.marca_id = md.tipo_clave and md.clatip_id = 'MARCAPROD'";

    const INNER_STRING_DET_SERV = " d inner join producto p on d.prod_id = p.prod_id
    inner join tipo up on p.unidad_id = up.tipo_clave and up.clatip_id = 'UNISERV'
    inner join tipo fp on p.familia_id = fp.tipo_clave and fp.clatip_id = 'FAMSERV'
    inner join tipo ud on d.unidad_id = ud.tipo_clave and ud.clatip_id = 'UNISERV'
    left join tipo md on d.marca_id = md.tipo_clave and md.clatip_id = 'MARCAPROD'";
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
        switch ($peticion[0]) {
             case 'todos':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltroTodos($peticion[1]);
                    }
                }
                return self::obtenerTodos($peticion[1]);
                break; 

            case 'ordenesCompra':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerOrdenFiltroCompra($peticion[1]);
                    }
                }
                return self::obtenerOrdenCompra($peticion[1]);
                break;
            case 'ordenesServicio':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerOrdenFiltroServicio($peticion[1]);
                    }
                }
                return self::obtenerOrdenServ($peticion[1]);
                break;
            case 'ordenesDet':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerDetOrdenFiltro($peticion[1]);
                    }
                }
                return self::obtenerDetOrden($peticion[1]);
                break;
            case 'orDetSer':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerDetOrdenFiltroServ($peticion[1]);
                    }
                }
                return self::obtenerDetOrdenServ($peticion[1]);
                break;
            case 'ultimapos':
                
                if (!empty($peticion[1])) {
                    if (is_numeric($peticion[1])) {
                        return self::obtenerUltimaPosicion($peticion[1]);
                    }
                }
                
                //return self::obtenerUltimaPosicion($peticion[1]);
                //return self::obtenerDetOrden($peticion[1]);
                break;
            case 'ultimaposdoc':
                
                if (!empty($peticion[1])) {
                    if (is_numeric($peticion[1])) {
                        return self::obtenerUltimaPosicionDoc($peticion[1]);
                    }
                }
                
                //return self::obtenerUltimaPosicion($peticion[1]);
                //return self::obtenerDetOrden($peticion[1]);
                break;
            case 'ordenFac':
                    if(isset($peticion[1])) {
                        return self::obtenerParaCargarFac($peticion[1]);
                    }
                break;
            /* case 'sgteSolPag':
                return self::siguienteFolio($peticion[0],$peticion[1]);
                break;
            case 'sgteGpoFirmaSol':
                    return self::siguienteGrupo($peticion[0]);
                    break;
            case 'sgteGpoFirmaAut':
                return self::siguienteGrupo($peticion[0]);
                break;
                //sp_id_gpo_firma_aut_vuelta                
                //sp_id_gpo_firma_aut_vuelta_gxc
            case 'sgteGpoPagos':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoGastosxComp':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoFolios':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoGxcEntCont':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoEjercidos':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoContaNp':
                return self::siguienteGrupo($peticion[0]);
                break;
            case 'sgteGpoFoliosCompPre':
                return self::siguienteGrupo($peticion[0]);
                break;           */      
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
    }
    /**
     * Metodo POST Crea un tipo en la base de datos
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
            case 'crea':
                $id = self::crear($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
                break;
            case 'creaCabDet':
                $id = self::crearCabDet($idUsuario);
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
                //CARLOS 18/08/2023
            case 'crearOrdenServ':
                $id = self::crearOrdenServicio($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
                break;              
            /* case 'crearpre':
                $id = self::crearPreCaptura($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
                break;                
            case 'gposolida':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoFirmaSolicitudIda($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break; */
            /* case 'gposolvta':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoFirmaSolicitudVta($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'gpoautida':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoFirmaAutorizaIda($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'gpoenviapago':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaPagos($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'gpoenviagastoxc':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaGastos($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'pagos':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::Pagos($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'ejercido':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::ejercido($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'xcancelar':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::xcancelar($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'cancelado':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::cancelado($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'cambiaestatus':
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
                    if (self::cambiaestatus($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                        //if (self::eliminar($datos, $peticion[0]) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    break;
            case 'actualizafolios':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::actualizafolios($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;                    
            case 'gpoenviafolio':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaFolios($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'gpoenviacontagxc':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaContaGxC($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;
            case 'actualizaSaldo':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::actualizaSaldo($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;    
            case 'actualizafolcomp':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::actualizafolcomp($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;    
            case 'gpoenviaejercido':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaEjercido($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;                             
            case 'gpoEnviaContaNp':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaContaNp($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;                             
            case 'GpoAutorizaVta':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoAutorizaVta($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;                             
            case 'actualizaPreCap':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::actualizaPreCap($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;   
            case 'gpoenviafolioComPre':
                $body = file_get_contents('php://input');
                $datos = json_decode($body);
                if (self::GpoEnviaFoliosCompPre($datos, $peticion[1], $idUsuario,$peticion[2]) > 0) {
                    //if (self::eliminar($datos, $peticion[0]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                break;     */                           
    
        }
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

        //var_dump($peticion[0]);
        //var_dump($peticion[1]);

        switch ($peticion[0]) {
            case 'actualiza':
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
            case 'actualizaCabTot':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    if (self::actualizarTotalesCabecero($peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
            case 'actualizaDet':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    //if (self::actualizarDetalle($datos,$peticion[1],$peticion[2], $idUsuario) > 0) {
                        if (self::actualizarDetalle($datos,$peticion[1],$peticion[2]) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
                //carlos 21/08/2023
                case 'actualizaOrdenServ':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    //if (self::actualizarDetalle($datos,$peticion[1],$peticion[2], $idUsuario) > 0) {
                        if (self::actualizaOrdenServicio($datos,$peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
            case 'acMonto':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    //if (self::actualizarDetalle($datos,$peticion[1],$peticion[2], $idUsuario) > 0) {
                        if (self::actualizarMonto($datos,$peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
                case 'EstOrd':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    //if (self::actualizarDetalle($datos,$peticion[1],$peticion[2], $idUsuario) > 0) {
                        if (self::actualizarEstatusOrden($datos,$peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                }
                break;
                case 'EstOrdSp':
                    if (!empty($peticion[0])) {
                        $body = file_get_contents('php://input');
                        $datos = json_decode($body);
                            if (self::actualizarEstatusConSolicitud($datos, $idUsuario) > 0) {
                            http_response_code(200);
                            return [
                                "estado" => self::CODIGO_EXITO,
                                "mensaje" => "Registro actualizado correctamente"
                            ];
                        }
                        throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                    }
                    break;

                case 'actCampoOrden':
                    if (!empty($peticion[0])) {
                        $body = file_get_contents('php://input');
                        $datos = json_decode($body);
            
                        //if (self::actualizarDetalle($datos,$peticion[1],$peticion[2], $idUsuario) > 0) {
                            if (self::actualizarCamposOrden($datos, $idUsuario) > 0) {
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
     * Método delete Inactiva un Sistema en la base de datos
     *
     * @param [array] $peticion Contiene un array con la(s) petición(es) del cliente
     * @return object Devuelve un json con el resultado del método
     */ //carlos 14/08/2023
   public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        $idUsuario = $validaToken['data']->id;
      switch ($peticion[0]) {
            case 'cab':
                if (self::eliminarCab($peticion[1], $idUsuario) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;
            case 'ordenesDet':
             //var_dump("peticioe", $peticion[1], $peticion[2]);
                if (self::eliminarDet($peticion[1], $peticion[2], $idUsuario) > 0) {

                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;
            case 'ordenesDetRec':
                if (self::eliminarDetRec($peticion[1], $peticion[2], $idUsuario) > 0) {

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
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //FUNCIONES
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Obtiene uno o varios registros de Ordenes de compra o servicios de acuerdo a criterios de filtrado
     *
     * @param [string] $peticion Contiene la peticion a la API (filtro)
     * @return array Devuelve un array con los registros resultado del filtrado
     */
  private static function obtenerOrdenFiltroServ($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS);

        $consulta = self::SELECT_STRING_SERVICIO. self::NOMBRE_TABLA . self::INNER_STRING_SERVICIO. $filtro['where'] . " order by os.osNumDoc desc";

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
    private static function obtenerOrdenFiltroCompra($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS);

        $consulta = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING. $filtro['where'] . " order by os.osNumDoc desc";

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
     private static function obtenerFiltroTodos($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS);

        $consulta = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING. $filtro['where'] . " order by os.osNumDoc desc";

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
    private static function obtenerTodos($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING . $whereId . " order by osNumDoc desc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de Ordenes de compra o servicios de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la Ordenes de compra o servicios que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerOrdenCompra($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_STRING . self::NOMBRE_TABLA . self::INNER_STRING . $whereId . " order by osNumDoc desc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
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
    private static function obtenerOrdenServ($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_STRING_SERVICIO. self::NOMBRE_TABLA . self::INNER_STRING_SERVICIO . $whereId . " order by osNumDoc desc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
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
    private static function obtenerOrdenFiltroServicio($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS);

        $consulta = self::SELECT_STRING_SERVICIO. self::NOMBRE_TABLA . self::INNER_STRING_SERVICIO. $filtro['where'] . " order by os.osNumDoc desc";

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
     * Crea una orden de compra en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la orden de compra
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        //VAR_DUMP($datos);
        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $osTipoDoc = htmlspecialchars(strip_tags($datos->osTipoDoc));
            $osTipoOs = htmlspecialchars(strip_tags($datos->osTipoOs));
            $osFecha = htmlspecialchars(strip_tags($datos->osFecha));
            $osEmpSolicita = htmlspecialchars(strip_tags($datos->osEmpSolicita));
            $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
            $osObservacion = htmlspecialchars(strip_tags($datos->osObservacion));
            $osDirSolicita = htmlspecialchars(strip_tags($datos->osDirSolicita));
            $osDeptoSolicita = htmlspecialchars(strip_tags($datos->osDeptoSolicita));
            $osDirDestino = htmlspecialchars(strip_tags($datos->osDirDestino));
            $osDeptoDestino = htmlspecialchars(strip_tags($datos->osDeptoDestino));
            $osSubTotal = htmlspecialchars(strip_tags($datos->osSubTotal));
            $osDescuento = htmlspecialchars(strip_tags($datos->osDescuento));
            $osIva = htmlspecialchars(strip_tags($datos->osIva));
            $osTotal = htmlspecialchars(strip_tags($datos->osTotal));
            $osTotal = $osSubTotal -$osDescuento + $osIva;
            $osTipoAdjudicacion = htmlspecialchars(strip_tags($datos->osTipoAdjudicacion));
            $osgenAdjudicacion = htmlspecialchars(strip_tags($datos->osgenAdjudicacion));
            $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $FechaLimEntrega = htmlspecialchars(strip_tags($datos->osFechaLimEntrega));
            $LugarEntrega = htmlspecialchars(strip_tags($datos->osLugarEntrega));
            $DiasCredito = htmlspecialchars(strip_tags($datos->osDiasCredito));
            $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
            $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));
            $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));
            $osEmpSolFir = htmlspecialchars(strip_tags($datos->osEmpSolFir));
            $osEmpAut = htmlspecialchars(strip_tags($datos->osEmpAut));


            $CreadoPor = $idUsuario;

                        //$osCRFF = htmlspecialchars(strip_tags($datos->osCRFF));
            //$provEmail = htmlspecialchars(strip_tags($datos->prov_email));
            //$provEmail2 = htmlspecialchars(strip_tags($datos->prov_email2));

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::OSNUMDOC . ", " .
                    self::OSTIPODOC . ", " .
                    self::OSTIPOOS . ", " .
                    self::OSFECHA . ", " .
                    self::OSEMPSOLICITA . ", " .
                    self::OSUSERCREA . ", " .
                    self::OSFECHAELABORA . ", " .
                    self::OSDESCRIPCION . ", " .
                    self::OSOBSERVACION . ", " .
                    self::OSDIRSOLICITA . ", " .
                    self::OSDEPTOSOLICITA . ", " .
                    self::OSDIRDESTINO . ", " .
                    self::OSDEPTODESTINO . ", " .
                    self::OSSUBTOTAL . ", " .
                    self::OSDESCUENTO . ", " .
                    self::OSIVA . ", " .
                    self::OSTOTAL . ", " .
                    self::OSTIPOADJUDICACION . ", " .
                    self::OSGENADJUDICACION . ", " .
                    self::SP_EJERCICIO . ", " .
                    self::PROV_ID . ", " .
                    self::CUECON_CUENTA . ", " .
                    self::SP_TIPO_SOL . ", " .
                    self::SP_CONCEPTO . ", " .
                    self::OSFECHALIMENTREGA . ", " .
                    self::OSLUGARENTREGA . ", " .
                    self::OSDIASCREDITO . ", " .
                    self::PROV_DIRECCION . ", " .
                    self::PROV_CIUDAD . ", " .
                    self::OSEMPSOLFIR . ", " .
                    self::OSEMPAUT . ", " .
                    self::OSESTATUS . ")" .
                    " VALUES(:osNumDoc,:osTipoDoc,:osTipoOs,:osFecha,:osEmpSolicita,:osUserCrea,CURRENT_TIMESTAMP(6), " .
                    ":osDescripcion,:osObservacion,:osDirSolicita,:osDeptoSolicita,:osDirDestino,:osDeptoDestino, " .
                    ":osSubTotal,:osDescuento,:osIva,:osTotal,:osTipoAdjudicacion,:osgenAdjudicacion,:sp_ejercicio,:prov_id,:cuecon_cuenta, " . 
                    ":sp_tipo_sol,:sp_concepto,:osFechaLimEntrega,:osLugarEntrega,:osDiasCredito,:prov_direccion,:prov_ciudad, " .
                    ":osEmpSolFir,:osEmpAut,:osEstatus) ";
                    

                    

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoOs", $osTipoOs, PDO::PARAM_STR);
                $sentencia->bindParam(":osFecha", $osFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolicita", $osEmpSolicita, PDO::PARAM_INT);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":osObservacion", $osObservacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osUserCrea", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osDirSolicita", $osDirSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoSolicita", $osDeptoSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirDestino", $osDirDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoDestino", $osDeptoDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osSubTotal", $osSubTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDescuento", $osDescuento, PDO::PARAM_STR);
                $sentencia->bindParam(":osIva", $osIva, PDO::PARAM_STR);
                $sentencia->bindParam(":osTotal", $osTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoAdjudicacion", $osTipoAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osgenAdjudicacion", $osgenAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_concepto", $concepto, PDO::PARAM_STR);
                $sentencia->bindParam(":osFechaLimEntrega", $FechaLimEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osLugarEntrega", $LugarEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osDiasCredito", $DiasCredito, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolFir", $osEmpSolFir, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpAut", $osEmpAut, PDO::PARAM_STR);

                //$sentencia->bindParam(":osCRFF", $osCRFF, PDO::PARAM_STR);
                //$sentencia->bindParam(":prov_email", $provEmail, PDO::PARAM_STR);
                //$sentencia->bindParam(":prov_email2", $provEmail2, PDO::PARAM_STR);

                
                //var_dump($comando);
                $sentencia->execute();
                // Retornar en el último id insertado
                //return $pdo->lastInsertId();
                return $pdo;
            } catch (PDOException $e) {
                //VAR_DUMP($e);
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
     * Crea una orden de compra en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la orden de compra
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crearCabDet($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);
        //VAR_DUMP($datos->detalle);
        
        if ($datos->cabecero) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos->cabecero, $campos);
            //Sanitiza los campos recibidos
            $osNumDoc = htmlspecialchars(strip_tags($datos->cabecero->osNumDoc));
            $osTipoDoc = htmlspecialchars(strip_tags($datos->cabecero->osTipoDoc));
            $osTipoOs = htmlspecialchars(strip_tags($datos->cabecero->osTipoOs));
            $osFecha = htmlspecialchars(strip_tags($datos->cabecero->osFecha));
            $osEmpSolicita = htmlspecialchars(strip_tags($datos->cabecero->osEmpSolicita));
            $osDescripcion = htmlspecialchars(strip_tags($datos->cabecero->osDescripcion));
            $osObservacion = htmlspecialchars(strip_tags($datos->cabecero->osObservacion));

            $osDirSolicita = htmlspecialchars(strip_tags($datos->cabecero->osDirSolicita));
            $osDeptoSolicita = htmlspecialchars(strip_tags($datos->cabecero->osDeptoSolicita));
            $osDirDestino = htmlspecialchars(strip_tags($datos->cabecero->osDirDestino));
            $osDeptoDestino = htmlspecialchars(strip_tags($datos->cabecero->osDeptoDestino));
            $osSubTotal = htmlspecialchars(strip_tags($datos->cabecero->osSubTotal));
            $osDescuento = htmlspecialchars(strip_tags($datos->cabecero->osDescuento));
            $osIva = htmlspecialchars(strip_tags($datos->cabecero->osIva));
            $osTotal = $osSubTotal -$osDescuento +$osIva;

            $osTipoAdjudicacion = htmlspecialchars(strip_tags($datos->cabecero->osTipoAdjudicacion));
            $osgenAdjudicacion = htmlspecialchars(strip_tags($datos->cabecero->osgenAdjudicacion));
            $osCRFF = htmlspecialchars(strip_tags($datos->cabecero->osCRFF));
            
            $provId = htmlspecialchars(strip_tags($datos->cabecero->prov_id));
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cabecero->cuecon_cuenta));
            //$provEmail = htmlspecialchars(strip_tags($datos->cabecero->prov_email));
            //$provEmail2 = htmlspecialchars(strip_tags($datos->cabecero->prov_email2));

            $tipoSol = htmlspecialchars(strip_tags($datos->cabecero->sp_tipo_sol));
            $concepto = htmlspecialchars(strip_tags($datos->cabecero->sp_concepto));

            $FechaLimEntrega = htmlspecialchars(strip_tags($datos->cabecero->osFechaLimEntrega));
            $LugarEntrega = htmlspecialchars(strip_tags($datos->cabecero->osLugarEntrega));
            $DiasCredito = htmlspecialchars(strip_tags($datos->cabecero->osDiasCredito));
            $provDireccion = htmlspecialchars(strip_tags($datos->cabecero->prov_direccion));
            $provCiudad = htmlspecialchars(strip_tags($datos->cabecero->prov_ciudad));

            $osEstatus = htmlspecialchars(strip_tags($datos->cabecero->osEstatus));

            $osEmpSolFir = htmlspecialchars(strip_tags($datos->cabecero->osEmpSolFir));
            $osEmpAut = htmlspecialchars(strip_tags($datos->cabecero->osEmpAut));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::OSNUMDOC . ", " .
                    self::OSTIPODOC . ", " .
                    self::OSTIPOOS . ", " .
                    self::OSFECHA . ", " .
                    self::OSEMPSOLICITA . ", " .
                    self::OSUSERCREA . ", " .
                    self::OSFECHAELABORA . ", " .
                    self::OSDESCRIPCION . ", " .
                    self::OSOBSERVACION . ", " .
                    self::OSDIRSOLICITA . ", " .
                    self::OSDEPTOSOLICITA . ", " .
                    self::OSDIRDESTINO . ", " .
                    self::OSDEPTODESTINO . ", " .
                    self::OSSUBTOTAL . ", " .
                    self::OSDESCUENTO . ", " .
                    self::OSIVA . ", " .
                    self::OSTOTAL . ", " .
                    self::OSTIPOADJUDICACION . ", " .
                    self::OSGENADJUDICACION . ", " .
                    self::OSCRFF . ", " .
                    self::PROV_ID . ", " .
                    self::CUECON_CUENTA . ", " .
                    self::SP_TIPO_SOL . ", " .
                    self::SP_CONCEPTO . ", " .
                    self::OSFECHALIMENTREGA . ", " .
                    self::OSLUGARENTREGA . ", " .
                    self::OSDIASCREDITO . ", " .
                    self::PROV_DIRECCION . ", " .
                    self::PROV_CIUDAD . ", " .
                    self::OSEMPSOLFIR . ", " .
                    self::OSEMPAUT . ", " .
                    self::OSESTATUS . ")" .
                    " VALUES(:osNumDoc,:osTipoDoc,:osTipoOs,:osFecha,:osEmpSolicita,:osUserCrea,CURRENT_TIMESTAMP(6), " .
                    ":osDescripcion,:osObservacion,:osDirSolicita,:osDeptoSolicita,:osDirDestino,:osDeptoDestino, " .
                    ":osSubTotal,:osDescuento,:osIva,:osTotal,:osTipoAdjudicacion,:osgenAdjudicacion,:osCRFF, " . 
                    ":prov_id,:cuecon_cuenta,:sp_tipo_sol,:sp_concepto,:osFechaLimEntrega, " . 
                    ":osLugarEntrega,:osDiasCredito,:prov_direccion,:prov_ciudad,:osEmpcSolFir,:osEmpAut,:osEstatus) ";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoOs", $osTipoOs, PDO::PARAM_STR);
                $sentencia->bindParam(":osFecha", $osFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolicita", $osEmpSolicita, PDO::PARAM_INT);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":osObservacion", $osObservacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osUserCrea", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osDirSolicita", $osDirSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoSolicita", $osDeptoSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirDestino", $osDirDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoDestino", $osDeptoDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osSubTotal", $osSubTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDescuento", $osDescuento, PDO::PARAM_STR);
                $sentencia->bindParam(":osIva", $osIva, PDO::PARAM_STR);
                $sentencia->bindParam(":osTotal", $osTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoAdjudicacion", $osTipoAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osgenAdjudicacion", $osgenAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osCRFF", $osCRFF, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                //$sentencia->bindParam(":prov_email", $provEmail, PDO::PARAM_STR);
                //$sentencia->bindParam(":prov_email2", $provEmail2, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_concepto", $concepto, PDO::PARAM_STR);

                $sentencia->bindParam(":osFechaLimEntrega", $FechaLimEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osLugarEntrega", $LugarEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osDiasCredito", $DiasCredito, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);

                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);

                $sentencia->bindParam(":osEmpSolFir", $osEmpSolFir, PDO::PARAM_INT);
                $sentencia->bindParam(":osEmpAut", $osEmpAut, PDO::PARAM_INT);

                
                $sentencia->execute();
                // Retornar en el último id insertado
                //return $pdo->lastInsertId();
                $pdo->lastInsertId();

                //Borrar el Detalle 
                $comando = "DELETE FROM " . self::NOMBRE_TABLA_DET . " WHERE " . self::OSNUMDOC . "= :osNumDoc";
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->execute();

                //Recorrer el Detalle
                foreach($datos->detalle as $valor){
                    
                    $campos = self::CAMPOS_OS_COMPRAS_DET;
                    //UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos->detalle, $campos);
                    UtilidadesApi::obtenerInstancia()->compruebaPropiedades($valor, $campos);
        
                    //Sanitiza los campos recibidos
                    $osNumDoc = htmlspecialchars(strip_tags($valor->osNumDoc));
                    $osDetPosicion = htmlspecialchars(strip_tags($valor->osDetPosicion));
                    $prodId = htmlspecialchars(strip_tags($valor->prod_id));
                    $unidadId = htmlspecialchars(strip_tags($valor->unidad_id));
                    $marcaId = htmlspecialchars(strip_tags($valor->marca_id));
                    $osDetCantidad = htmlspecialchars(strip_tags($valor->osDetCantidad));
                    $osDetPrecio = htmlspecialchars(strip_tags($valor->osDetPrecio));
                    $osDetDescuento = htmlspecialchars(strip_tags($valor->osDetDescuento));
                    $osDetIVA = htmlspecialchars(strip_tags($valor->osDetIVA));
                    $osDetActivo = htmlspecialchars(strip_tags($valor->osDetActivo));

                    //VAR_DUMP($valor->osDetPosicion);
                    $comando = "INSERT INTO " . self::NOMBRE_TABLA_DET . " ( " .
                    self::OSNUMDOC . ", " .
                    self::OSDETPOSICION . ", " .
                    self::PROD_ID . ", " .
                    self::UNIDAD_ID . ", " .
                    self::MARCA_ID . ", " .
                    self::OSDETCANTIDAD . ", " .
                    self::OSDETPRECIO . ", " .
                    self::OSDETDESCUENTO . ", " .
                    self::OSDETIVA . ", " .
                    self::OSDETACTIVO . ")" .
                    " VALUES(:osNumDoc,:osDetPosicion,:prod_id,:unidad_id,:marca_id,:osDetCantidad, " .
                    ":osDetPrecio,:osDetDescuento,:osDetIVA,:osDetActivo) ";

                    $sentencia = $pdo->prepare($comando);
                    $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                    $sentencia->bindParam(":osDetPosicion", $osDetPosicion, PDO::PARAM_INT);
                    $sentencia->bindParam(":prod_id", $prodId, PDO::PARAM_STR);
                    $sentencia->bindParam(":unidad_id", $unidadId, PDO::PARAM_STR);
                    $sentencia->bindParam(":marca_id", $marcaId, PDO::PARAM_STR);
                    $sentencia->bindParam(":osDetCantidad", $osDetCantidad, PDO::PARAM_STR);
                    $sentencia->bindParam(":osDetPrecio", $osDetPrecio, PDO::PARAM_STR);
                    $sentencia->bindParam(":osDetDescuento", $osDetDescuento, PDO::PARAM_STR);
                    $sentencia->bindParam(":osDetIVA", $osDetIVA, PDO::PARAM_STR);
                    $sentencia->bindParam(":osDetActivo", $osDetActivo, PDO::PARAM_INT);

                    $sentencia->execute();
    
                }
                return $pdo->lastInsertId();
                //return $pdo;
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
     * Crea un Detalle de orden de compra
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la orden de compra
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crearDet($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);
        //VAR_DUMP($datos);
        
        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS_DET;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $osDetPosicion = htmlspecialchars(strip_tags($datos->osDetPosicion));
            $prodId = htmlspecialchars(strip_tags($datos->prod_id));
            $unidadId = htmlspecialchars(strip_tags($datos->unidad_id));
            $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
            $marcaId = htmlspecialchars(strip_tags($datos->marca_id));

            $osDetCantidad = htmlspecialchars(strip_tags($datos->osDetCantidad));
            $osDetPrecio = htmlspecialchars(strip_tags($datos->osDetPrecio));            
            $osPorcDcto = htmlspecialchars(strip_tags($datos->osPorcDcto));
            $osDetDescuento = htmlspecialchars(strip_tags($datos->osDetDescuento));
            $osDetSubtotal = htmlspecialchars(strip_tags($datos->osDetSubtotal));
            $osDetTasaIVA = htmlspecialchars(strip_tags($datos->osDetTasaIVA));
            $osDetIVA = htmlspecialchars(strip_tags($datos->osDetIVA));
            $osDetTotal = htmlspecialchars(strip_tags($datos->osDetTotal));
            $osDetActivo = htmlspecialchars(strip_tags($datos->osDetActivo));            
            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
                    
                $campos = self::CAMPOS_OS_COMPRAS_DET;
                //UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos->detalle, $campos);
                UtilidadesApi::obtenerInstancia()->compruebaPropiedades($valor, $campos);

                //VAR_DUMP($valor->osDetPosicion);
                $comando = "INSERT INTO " . self::NOMBRE_TABLA_DET . " ( " .
                self::OSNUMDOC . ", " .
                self::OSDETPOSICION . ", " .
                self::PROD_ID . ", " .
                self::DESCRIPCION . ", " .
                self::UNIDAD_ID . ", " .
                self::MARCA_ID . ", " .
                self::OSDETCANTIDAD . ", " .
                self::OSDETPRECIO . ", " .
                self::OSPORCDCTO . ", " .
                self::OSDETDESCUENTO . ", " .
                self::OSDETSUBTOTAL . ", " .
                self::OSDETTASAIVA . ", " .
                self::OSDETIVA . ", " .
                self::OSDETTOTAL . ", " .
                self::OSDETACTIVO . ")" .
                " VALUES(:osNumDoc,:osDetPosicion,:prod_id,:osDescripcion, :unidad_id,:marca_id,:osDetCantidad, " .
                ":osDetPrecio,:osPorcDcto,:osDetDescuento,:osDetSubtotal,:osDetTasaIVA,:osDetIVA,:osDetTotal,:osDetActivo) ";

                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osDetPosicion", $osDetPosicion, PDO::PARAM_INT);
                $sentencia->bindParam(":prod_id", $prodId, PDO::PARAM_STR);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":unidad_id", $unidadId, PDO::PARAM_STR);
                $sentencia->bindParam(":marca_id", $marcaId, PDO::PARAM_STR);
                
                $sentencia->bindParam(":osDetCantidad", $osDetCantidad, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetPrecio", $osDetPrecio, PDO::PARAM_STR);
                $sentencia->bindParam(":osPorcDcto", $osPorcDcto, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetDescuento", $osDetDescuento, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetSubtotal", $osDetSubtotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetTasaIVA", $osDetTasaIVA, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetIVA", $osDetIVA, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetTotal", $osDetTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetActivo", $osDetActivo, PDO::PARAM_INT);
                //$sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);

                $sentencia->execute();
                // Retornar en el último id insertado
                //return $pdo->lastInsertId();
                //return $pdo;

                //Actualizar TOTALES Del Cabecero
                $comando = "UPDATE ordenes_sica c 
                INNER JOIN ( SELECT osNumDoc,sum((osDetCantidad * osDetPrecio) - osDetDescuento) as osSubTotal,
                sum(osDetDescuento) as osDescuento,
                sum((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento)) as osIva,
                sum(((osDetCantidad * osDetPrecio) - osDetDescuento)+((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento))) as osTotal
                FROM ordenes_sica_det WHERE osNumDoc = :osNumDoc
                ) tabla2 ON c.osNumDoc = tabla2.osNumDoc
                SET c.osDescuento = tabla2.osDescuento,c.osSubTotal = tabla2.osSubTotal, c.osIva = tabla2.osIva, c.osTotal = tabla2.osTotal
                WHERE c.osNumDoc = :osNumDoc";


                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->execute();

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
     * Crea una orden de serivicio
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la orden de compra
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    //CARLOS 18/08/2023
    private static function crearOrdenServicio($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        //VAR_DUMP($datos);
        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $osTipoDoc = htmlspecialchars(strip_tags($datos->osTipoDoc));
            $osTipoOs = htmlspecialchars(strip_tags($datos->osTipoOs));
            $osFecha = htmlspecialchars(strip_tags($datos->osFecha));
            $osSolicitudServicio = htmlspecialchars(strip_tags($datos->osSolicitudServicio));
            $sp_tipoServicio = htmlspecialchars(strip_tags($datos->sp_tipoServicio));
            $osVeh_id = htmlspecialchars(strip_tags($datos ->osVeh_id));
            $osEmpSolicita = htmlspecialchars(strip_tags($datos->osEmpSolicita));
            $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
            $osObservacion = htmlspecialchars(strip_tags($datos->osObservacion));
            $osDirSolicita = htmlspecialchars(strip_tags($datos->osDirSolicita));
            $osDeptoSolicita = htmlspecialchars(strip_tags($datos->osDeptoSolicita));
            $osDirDestino = htmlspecialchars(strip_tags($datos->osDirDestino));
            $osDeptoDestino = htmlspecialchars(strip_tags($datos->osDeptoDestino));
            $osTipoAdjudicacion = htmlspecialchars(strip_tags($datos->osTipoAdjudicacion));
            $osgenAdjudicacion = htmlspecialchars(strip_tags($datos->osgenAdjudicacion));
            $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $FechaLimEntrega = htmlspecialchars(strip_tags($datos->osFechaLimEntrega));
            $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
            $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));
            $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));
            $osEmpSolFir = htmlspecialchars(strip_tags($datos->osEmpSolFir));
            $osEmpAut = htmlspecialchars(strip_tags($datos->osEmpAut));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::OSNUMDOC . ", " .
                    self::OSTIPODOC . ", " .
                    self::OSTIPOOS . ", " .
                    self::OSFECHA . ", " .
                    self::OSOLICITUDSERV . ", " .
                    self::VEID . ", " .
                    self::SPTIPOSERV . ", " .
                    self::OSEMPSOLICITA . ", " .
                    self::OSUSERCREA . ", " .
                    self::OSFECHAELABORA . ", " .
                    self::OSDESCRIPCION . ", " .
                    self::OSOBSERVACION . ", " .
                    self::OSDIRSOLICITA . ", " .
                    self::OSDEPTOSOLICITA . ", " .
                    self::OSDIRDESTINO . ", " .
                    self::OSDEPTODESTINO . "," .
                    self::OSTIPOADJUDICACION . ", " .
                    self::OSGENADJUDICACION . ", " .
                    self::SP_EJERCICIO . ", " .
                    self::PROV_ID . ", " .
                    self::CUECON_CUENTA . ", " .
                    self::SP_TIPO_SOL . ", " .
                    self::SP_CONCEPTO . ", " .
                    self::OSFECHALIMENTREGA . ", " .
                    self::PROV_DIRECCION . ", " .
                    self::PROV_CIUDAD . ", " .
                    self::OSEMPSOLFIR . ", " .
                    self::OSEMPAUT . ", " .
                    self::OSESTATUS . ")" .
                    " VALUES(:osNumDoc,:osTipoDoc,:osTipoOs,:osFecha,:osSolicitudServicio,:osVeh_id,:sp_tipoServicio,:osEmpSolicita,:osUserCrea,CURRENT_TIMESTAMP(6), " .
                    ":osDescripcion,:osObservacion,:osDirSolicita,:osDeptoSolicita,:osDirDestino,:osDeptoDestino, " .
                    ":osTipoAdjudicacion,:osgenAdjudicacion,:sp_ejercicio,:prov_id,:cuecon_cuenta, " . 
                    ":sp_tipo_sol,:sp_concepto,:osFechaLimEntrega,:prov_direccion,:prov_ciudad, " .
                    ":osEmpSolFir,:osEmpAut,:osEstatus) ";
                    
                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoOs", $osTipoOs, PDO::PARAM_STR);
                $sentencia->bindParam(":osSolicitudServicio", $osSolicitudServicio, PDO::PARAM_STR);
                $sentencia->bindParam(":osFecha", $osFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":osVeh_id", $osVeh_id, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipoServicio", $sp_tipoServicio, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolicita", $osEmpSolicita, PDO::PARAM_INT);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":osObservacion", $osObservacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osUserCrea", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osDirSolicita", $osDirSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoSolicita", $osDeptoSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirDestino", $osDirDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoDestino", $osDeptoDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoAdjudicacion", $osTipoAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osgenAdjudicacion", $osgenAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_concepto", $concepto, PDO::PARAM_STR);
                $sentencia->bindParam(":osFechaLimEntrega", $FechaLimEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolFir", $osEmpSolFir, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpAut", $osEmpAut, PDO::PARAM_STR);

                
                //var_dump($comando);
                $sentencia->execute();
                // Retornar en el último id insertado
                //return $pdo->lastInsertId();
                return $pdo;
            } catch (PDOException $e) {
                //VAR_DUMP($e);
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
        //var_dump($datos);
        if ($datos) {
            
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

             //Sanitiza los campos recibidos
             $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
             $osTipoDoc = htmlspecialchars(strip_tags($datos->osTipoDoc));
             $osTipoOs = htmlspecialchars(strip_tags($datos->osTipoOs));
             $osFecha = htmlspecialchars(strip_tags($datos->osFecha));
             $osEmpSolicita = htmlspecialchars(strip_tags($datos->osEmpSolicita));
             $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
             $osObservacion = htmlspecialchars(strip_tags($datos->osObservacion));
             $osDirSolicita = htmlspecialchars(strip_tags($datos->osDirSolicita));
             $osDeptoSolicita = htmlspecialchars(strip_tags($datos->osDeptoSolicita));
             $osDirDestino = htmlspecialchars(strip_tags($datos->osDirDestino));
             $osDeptoDestino = htmlspecialchars(strip_tags($datos->osDeptoDestino));
             $osSubTotal = htmlspecialchars(strip_tags($datos->osSubTotal));
             $osDescuento = htmlspecialchars(strip_tags($datos->osDescuento));
             $osIva = htmlspecialchars(strip_tags($datos->osIva));
             $osTotal = htmlspecialchars(strip_tags($datos->osTotal));
             $osTipoAdjudicacion = htmlspecialchars(strip_tags($datos->osTipoAdjudicacion));
             $osgenAdjudicacion = htmlspecialchars(strip_tags($datos->osgenAdjudicacion));
             $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
             $sp_id = htmlspecialchars(strip_tags($datos->sp_id));
             $osCRFF = htmlspecialchars(strip_tags($datos->osCRFF));
             $provId = htmlspecialchars(strip_tags($datos->prov_id));
             $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
             $provEmail = htmlspecialchars(strip_tags($datos->prov_email));
             $provEmail2 = htmlspecialchars(strip_tags($datos->prov_email2));
             $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
             $concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
             $FechaLimEntrega = htmlspecialchars(strip_tags($datos->osFechaLimEntrega));
             $LugarEntrega = htmlspecialchars(strip_tags($datos->osLugarEntrega));
             $DiasCredito = htmlspecialchars(strip_tags($datos->osDiasCredito));
             $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
             $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));
             $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));

            $ModificadPor = $idUsuario;

            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::OSTIPODOC . "= :osTipoDoc, " .
                    self::OSTIPOOS . "= :osTipoOs, " .
                    self::OSFECHA . "= :osFecha, " .
                    self::OSFECHAMOD . "= CURRENT_TIMESTAMP(6), " .
                    self::OSUSERMOD . "= :osUserMod, " .
                    self::OSEMPSOLICITA . "= :osEmpSolicita, " .
                    self::OSDESCRIPCION . "= :osDescripcion, " .
                    self::OSOBSERVACION . "= :osObservacion, " .
                    self::OSDIRSOLICITA . "= :osDirSolicita, " .
                    self::OSDEPTOSOLICITA . "= :osDeptoSolicita, " .
                    self::OSDIRDESTINO . "= :osDirDestino, " .
                    self::OSDEPTODESTINO . "= :osDeptoDestino, " .
                    self::OSSUBTOTAL . "= :osSubTotal, " .
                    self::OSDESCUENTO . "= :osDescuento, " .
                    self::OSIVA . "= :osIva, " .
                    self::OSTOTAL . "= :osTotal, " .
                    self::OSTIPOADJUDICACION . "= :osTipoAdjudicacion, " .
                    self::OSGENADJUDICACION . "= :osgenAdjudicacion, " .
                    self::SP_EJERCICIO . "= :sp_ejercicio, " .
                    self::SP_ID . "= :sp_id, " .
                    self::PROV_ID . "= :prov_id, " .
                    self::CUECON_CUENTA . "= :cuecon_cuenta, " .
                    self::SP_TIPO_SOL . "= :sp_tipo_sol, " .
                    self::SP_CONCEPTO . "= :sp_concepto, " .
                    self::OSFECHALIMENTREGA . "= :osFechaLimEntrega, " .
                    self::OSLUGARENTREGA . "= :osLugarEntrega, " .
                    self::OSDIASCREDITO . "= :osDiasCredito, " .
                    self::PROV_DIRECCION . "= :prov_direccion, " .
                    self::PROV_CIUDAD . "= :prov_ciudad, " .
                    self::OSCRFF . "= :osCRFF, " .
                    self::PROV_EMAIL . "= :prov_email, " .
                    self::PROV_EMAIL2 . "= :prov_email2, " .
                    self::OSESTATUS . "= :osEstatus " .
                    " WHERE " . self::OSNUMDOC . "= :osNumDoc";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoOs", $osTipoOs, PDO::PARAM_STR);
                $sentencia->bindParam(":osFecha", $osFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolicita", $osEmpSolicita, PDO::PARAM_INT);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":osObservacion", $osObservacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirSolicita", $osDirSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoSolicita", $osDeptoSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirDestino", $osDirDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoDestino", $osDeptoDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osSubTotal", $osSubTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDescuento", $osDescuento, PDO::PARAM_STR);
                $sentencia->bindParam(":osIva", $osIva, PDO::PARAM_STR);
                $sentencia->bindParam(":osTotal", $osTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoAdjudicacion", $osTipoAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osgenAdjudicacion", $osgenAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
                $sentencia->bindParam(":osCRFF", $osCRFF, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_email", $provEmail, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_email2", $provEmail2, PDO::PARAM_STR);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_concepto", $concepto, PDO::PARAM_STR);
                $sentencia->bindParam(":osFechaLimEntrega", $FechaLimEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osLugarEntrega", $LugarEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":osDiasCredito", $DiasCredito, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);

                $sentencia->bindParam(":osUserMod", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
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
     * Actualiza la información de un tipo
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizarDetalle($datos, $id, $posicion)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS_DET_ACT;
   
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

             //Sanitiza los campos recibidos
             //$osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
             //$osDetPosicion = htmlspecialchars(strip_tags($datos->osDetPosicion));
             $prodId = htmlspecialchars(strip_tags($datos->prod_id));
             $unidadId = htmlspecialchars(strip_tags($datos->unidad_id));
             $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
             $marcaId = htmlspecialchars(strip_tags($datos->marca_id));
 
             $osDetCantidad = htmlspecialchars(strip_tags($datos->osDetCantidad));
             $osDetPrecio = htmlspecialchars(strip_tags($datos->osDetPrecio));            
             $osPorcDcto = htmlspecialchars(strip_tags($datos->osPorcDcto));
             $osDetDescuento = htmlspecialchars(strip_tags($datos->osDetDescuento));
             $osDetSubtotal = htmlspecialchars(strip_tags($datos->osDetSubtotal));
             $osDetTasaIVA = htmlspecialchars(strip_tags($datos->osDetTasaIVA));
             $osDetIVA = htmlspecialchars(strip_tags($datos->osDetIVA));
             $osDetTotal = htmlspecialchars(strip_tags($datos->osDetTotal));
             $osDetActivo = htmlspecialchars(strip_tags($datos->osDetActivo));  

            //$ModificadPor = $idUsuario;
            
            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA_DET .
                    " SET " . self::PROD_ID . "= :prod_id, " .
                    self::UNIDAD_ID . "= :unidad_id, " .
                    self::MARCA_ID . "= :marca_id, " .
                    self::DESCRIPCION . "= :osDescripcion, " .
                    self::OSDETCANTIDAD . "= :osDetCantidad, " .
                    self::OSDETPRECIO . "= :osDetPrecio, " .
                    self::OSPORCDCTO . "= :osPorcDcto, " .
                    self::OSDETDESCUENTO . "= :osDetDescuento, " .
                    self::OSDETSUBTOTAL . "= :osDetSubtotal, " .
                    self::OSDETTASAIVA . "= :osDetTasaIVA, " .
                    self::OSDETIVA . "= :osDetIVA, " .
                    self::OSDETTOTAL . "= :osDetTotal, " .
                    self::OSDETACTIVO . "= :osDetActivo " .
                    " WHERE " . self::OSNUMDOC . "= :osNumDoc AND " . self::OSDETPOSICION . "= :osDetPosicion;"  ;
                    
                    //var_dump($consulta);
                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

                //$sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":prod_id", $prodId, PDO::PARAM_STR);
                $sentencia->bindParam(":unidad_id", $unidadId, PDO::PARAM_STR);
                $sentencia->bindParam(":marca_id", $marcaId, PDO::PARAM_STR);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                
                $sentencia->bindParam(":osDetCantidad", $osDetCantidad, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetPrecio", $osDetPrecio, PDO::PARAM_STR);
                $sentencia->bindParam(":osPorcDcto", $osPorcDcto, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetDescuento", $osDetDescuento, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetSubtotal", $osDetSubtotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetTasaIVA", $osDetTasaIVA, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetIVA", $osDetIVA, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetTotal", $osDetTotal, PDO::PARAM_STR);
                $sentencia->bindParam(":osDetActivo", $osDetActivo, PDO::PARAM_INT);
                //$sentencia->bindParam(":osUserMod", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":osDetPosicion", $posicion, PDO::PARAM_INT);
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
     * Actualiza cabecero orden de servicio
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    //carlos 21/02/2023
private static function actualizaOrdenServicio($datos, $id, $idUsuario)
    {
    
        if ($datos) {
            //var_dump($datos)
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

             $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
             $osTipoDoc = htmlspecialchars(strip_tags($datos->osTipoDoc));
             $osTipoOs = htmlspecialchars(strip_tags($datos->osTipoOs));
             $osFecha = htmlspecialchars(strip_tags($datos->osFecha));
             $sp_tipoServicio = htmlspecialchars(strip_tags($datos->sp_tipoServicio));
             $osSolicitudServicio = htmlspecialchars(strip_tags($datos->osSolicitudServicio));
             $osEmpSolicita = htmlspecialchars(strip_tags($datos->osEmpSolicita));
             $osDescripcion = htmlspecialchars(strip_tags($datos->osDescripcion));
             $osObservacion = htmlspecialchars(strip_tags($datos->osObservacion));
             $osDirSolicita = htmlspecialchars(strip_tags($datos->osDirSolicita));
             $osDeptoSolicita = htmlspecialchars(strip_tags($datos->osDeptoSolicita));
             $osDirDestino = htmlspecialchars(strip_tags($datos->osDirDestino));
             $osDeptoDestino = htmlspecialchars(strip_tags($datos->osDeptoDestino));
             $osTipoAdjudicacion = htmlspecialchars(strip_tags($datos->osTipoAdjudicacion));
             $osgenAdjudicacion = htmlspecialchars(strip_tags($datos->osgenAdjudicacion));
             $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
             $provId = htmlspecialchars(strip_tags($datos->prov_id));
             $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
             $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
             $concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
             $FechaLimEntrega = htmlspecialchars(strip_tags($datos->osFechaLimEntrega));
             $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
             $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));
             $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));
             $osVehid =  htmlspecialchars(strip_tags($datos->osVeh_id));

             $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE

               $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::OSTIPODOC . "= :osTipoDoc, " .
                    self::OSTIPOOS . "= :osTipoOs, " .
                    self::OSFECHA . "= :osFecha, " .
                    self::OSOLICITUDSERV . "= :osSolicitudServicio, " .
                    self::SPTIPOSERV . "= :sp_tipoServicio, " .
                    self::OSFECHAMOD . "= CURRENT_TIMESTAMP(6), " .
                    self::OSUSERMOD . "= :osUserMod, " .
                    self::OSEMPSOLICITA . "= :osEmpSolicita, " .
                    self::OSDESCRIPCION . "= :osDescripcion, " .
                    self::OSOBSERVACION . "= :osObservacion, " .
                    self::OSDIRSOLICITA . "= :osDirSolicita, " .
                    self::OSDEPTOSOLICITA . "= :osDeptoSolicita, " .
                    self::OSDIRDESTINO . "= :osDirDestino, " .
                    self::OSDEPTODESTINO . "= :osDeptoDestino, " .
                    self::OSTIPOADJUDICACION . "= :osTipoAdjudicacion, " .
                    self::OSGENADJUDICACION . "= :osgenAdjudicacion, " .
                    self::SP_EJERCICIO. "= :sp_ejercicio, " .
                    self::PROV_ID . "= :prov_id, " .
                    self::CUECON_CUENTA . "= :cuecon_cuenta, " .
                    self::SP_TIPO_SOL . "= :sp_tipo_sol, " .
                    self::SP_CONCEPTO . "= :sp_concepto, " .
                    self::OSFECHALIMENTREGA . "= :osFechaLimEntrega, " .
                    self::PROV_DIRECCION . "= :prov_direccion, " .
                    self::PROV_CIUDAD . "= :prov_ciudad, " .
                    self::OSESTATUS . "= :osEstatus, " .
                    self::VEID . "= :osVeh_id " .
                    " WHERE " . self::OSNUMDOC . "= :osNumDoc";
                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

                //$sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osTipoDoc", $osTipoDoc, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoOs", $osTipoOs, PDO::PARAM_STR);
                $sentencia->bindParam(":osFecha", $osFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipoServicio", $sp_tipoServicio, PDO::PARAM_STR);
                $sentencia->bindParam(":osSolicitudServicio", $osSolicitudServicio, PDO::PARAM_STR);
                $sentencia->bindParam(":osEmpSolicita", $osEmpSolicita, PDO::PARAM_INT);
                $sentencia->bindParam(":osDescripcion", $osDescripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":osObservacion", $osObservacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirSolicita", $osDirSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoSolicita", $osDeptoSolicita, PDO::PARAM_STR);
                $sentencia->bindParam(":osDirDestino", $osDirDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osDeptoDestino", $osDeptoDestino, PDO::PARAM_STR);
                $sentencia->bindParam(":osTipoAdjudicacion", $osTipoAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":osgenAdjudicacion", $osgenAdjudicacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_concepto", $concepto, PDO::PARAM_STR);
                $sentencia->bindParam(":osFechaLimEntrega", $FechaLimEntrega, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);
                $sentencia->bindParam(":osVeh_id", $osVehid, PDO::PARAM_STR);

                $sentencia->bindParam(":osUserMod", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
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
     * Actualiza la información de un tipo
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizarTotalesCabecero($id, $idUsuario)
    {
            $ModificadPor = $idUsuario;
            //var_dump($clatipDescripcion);

            try {
                // Creando consulta UPDATE
                /*
                $consulta = "UPDATE " . self::NOMBRE_TABLA . " c " .
                " INNER JOIN ( SELECT osNumDoc,sum((osDetCantidad * osDetPrecio) - osDetDescuento) as osSubTotal, " .
                " sum(osDetDescuento) as osDescuento, " .
                " sum((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento)) as osIva, " .
                " sum(((osDetCantidad * osDetPrecio) - osDetDescuento)+((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento))) as osTotal " .
                " FROM " . self::NOMBRE_TABLA_DET . " WHERE " . self::OSNUMDOC . "= :osNumDoc" .
                " ) tabla2 ON c.osNumDoc = tabla2.osNumDoc " .
                " SET c.osDescuento = tabla2.osDescuento,c.osSubTotal = tabla2.osSubTotal, c.osIva = tabla2.osIva, c.osTotal = tabla2.osTotal " .
                " WHERE " . self::OSNUMDOC . "= :osNumDoc";
                */
                $consulta = "UPDATE ordenes_sica c 
                INNER JOIN ( SELECT osNumDoc,sum((osDetCantidad * osDetPrecio) - osDetDescuento) as osSubTotal,
                sum(osDetDescuento) as osDescuento,
                sum((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento)) as osIva,
                sum(((osDetCantidad * osDetPrecio) - osDetDescuento)+((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento))) as osTotal
                FROM ordenes_sica_det WHERE osNumDoc = :osNumDoc
                ) tabla2 ON c.osNumDoc = tabla2.osNumDoc
                SET c.osDescuento = tabla2.osDescuento,c.osSubTotal = tabla2.osSubTotal, c.osIva = tabla2.osIva, c.osTotal = tabla2.osTotal
                WHERE c.osNumDoc = :osNumDoc";

                //$sentencia = $pdo->prepare($comando);
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
                $sentencia->execute();

                return $sentencia->rowCount();
                //return $pdo;
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
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

        try {
        $comando = "UPDATE " . self::NOMBRE_TABLA . " c " .
        " INNER JOIN ( SELECT osNumDoc,sum((osDetCantidad * osDetPrecio) - osDetDescuento) as osSubTotal, " .
        " sum(osDetDescuento) as osDescuento, " .
        " sum((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento)) as osIva, " .
        " sum(((osDetCantidad * osDetPrecio) - osDetDescuento)+((osDetTasaIVA/100) * ((osDetCantidad * osDetPrecio) - osDetDescuento))) as osTotal " .
        " FROM " . self::NOMBRE_TABLA_DET . " WHERE " . self::OSNUMDOC . "= :osNumDoc" .
        " ) tabla2 ON c.osNumDoc = tabla2.osNumDoc " .
        " SET c.osDescuento = tabla2.osDescuento,c.osSubTotal = tabla2.osSubTotal, c.osIva = tabla2.osIva, c.osTotal = tabla2.osTotal " .
        " WHERE " . self::OSNUMDOC . "= :osNumDoc";

        $sentencia = $pdo->prepare($comando);
        $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
        $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
    /**
     * Obtiene uno o varios registros de Ordenes de compra o servicios de acuerdo a criterios de filtrado
     *
     * @param [string] $peticion Contiene la peticion a la API (filtro)
     * @return array Devuelve un array con los registros resultado del filtrado
     */
    private static function obtenerDetOrdenFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS_DET);

        $consulta = self::SELECT_STRING_DET . self::NOMBRE_TABLA_DET . self::INNER_STRING_DET . $filtro['where'] . " order by osNumDoc desc , osDetPosicion asc";

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
     * Obtiene uno o varios registros de Ordenes de SERVICIO 
     *
     * @param [string] $peticion Contiene la peticion a la API (filtro)
     * @return array Devuelve un array con los registros resultado del filtrado
     */
      private static function obtenerDetOrdenFiltroServ($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS_DET);

        $consulta = self::SELECT_STRING_DET . self::NOMBRE_TABLA_DET . self::INNER_STRING_DET_SERV . $filtro['where'] . " order by osNumDoc desc , osDetPosicion asc";

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
     * Obtiene uno o varios registros de Ordenes de compra o servicios de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la Ordenes de compra o servicios que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerDetOrden($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_STRING_DET . self::NOMBRE_TABLA_DET . self::INNER_STRING_DET . $whereId . " order by osNumDoc desc ,osDetPosicion asc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
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
    private static function obtenerDetOrdenServ($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_STRING_DET . self::NOMBRE_TABLA_DET . self::INNER_STRING_DET_SERV . $whereId . " order by osNumDoc desc ,osDetPosicion asc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
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
     * Obtiene un registro de Ultima posicion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerUltimaPosicion($osnumdoc = null)
    {
        try {
            //$whereId = !empty($osnumdoc) ? " WHERE " . self::OSNUMDOC . "= :osNumDoc" : "";
            //$whereId = !empty($osnumdoc) ? self::OSNUMDOC . "= :osNumDoc" : "";
            //$comando = "select osdetPosicion from ordenes_sica_det " . $whereId . " order by osdetPosicion desc limit 1;";
            $comando =  "select ultimaPosicion(" . $osnumdoc . ") as ultimaposicion";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            //$sentencia->bindParam(":osNumDoc", $osnumdoc, PDO::PARAM_INT);

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            //return 0;
            
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($osnumdoc) ? " con ese osnumdoc" : " en la tabla: " .  self::NOMBRE_TABLA;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
            
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
        private static function obtenerUltimaPosicionDoc($osnumdoc = null)
    {
        try {
  
            $comando =  "select ultimaPosicionDoc(" . $osnumdoc . ") as ultimaposicion";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            //return 0;
            
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($osnumdoc) ? " con ese osnumdoc" : " en la tabla: " .  self::NOMBRE_TABLA;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
            
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    private static function eliminarDet($id, $osDetPosicion, $idUsuario)
    {
        $ModificadoPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA_DET .
        " SET " . self::OSDETACTIVO . " = 0, " .
        self::MODIFICADO_POR . " = :modificado_por, " .
        self::MODIFICADO_EL . " = CURRENT_TIMESTAMP(6) " .
        " WHERE " . self::OSNUMDOCDET . " = :osNumDoc AND " .
        self::OSDETPOSICION . " = :osDetPosicion";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
            $sentencia->bindParam(":osDetPosicion", $osDetPosicion, PDO::PARAM_STR);
            $sentencia->bindParam(":modificado_por", $ModificadoPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }

    private static function eliminarCab($osNumDoc, $idUsuario)
    {
        $ModificadoPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
        " SET " . self::OSESTATUS . " = 'CAN_OS', " .
        self::MODIFICADO_POR . " = :modificado_por, " .
        self::MODIFICADO_EL . " = CURRENT_TIMESTAMP(6) " .
        " WHERE " . self::OSNUMDOC . " = :osNumDoc";
        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_STR);
            $sentencia->bindParam(":modificado_por", $ModificadoPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
    private static function actualizarMonto($datos, $id, $idUsuario)
    {

        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $osTotalFact = htmlspecialchars(strip_tags($datos->osTotalFact));
            $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::TOTALFACT . " = :osTotalFact, " .
            self::MODIFICADO_EL . " = CURRENT_TIMESTAMP(6), " .
            self::MODIFICADO_POR . " =  :modificado_por" .
            " WHERE " . self::OSNUMDOC . " = :osNumDoc";
            var_dump($idUsuario);
            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":osTotalFact", $osTotalFact, PDO::PARAM_STR);
                $sentencia->bindParam(":modificado_por", $ModificadPor, PDO::PARAM_INT);

                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }
    private static function actualizarEstatusOrden($datos, $id, $idUsuario)
    {

        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));
            $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::OSESTATUS . " = :osEstatus, " .
            self::MODIFICADO_EL . " = CURRENT_TIMESTAMP(6), " .
            self::MODIFICADO_POR . " =  :modificado_por" .
            " WHERE " . self::OSNUMDOC . " = :osNumDoc";
            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":modificado_por", $ModificadPor, PDO::PARAM_INT);

                $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_INT);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }
    private static function actualizarEstatusConSolicitud($datos, $idUsuario)
    {

        if ($datos) {
            $campos = self::CAMPOS_OS_COMPRAS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            $osEstatus = htmlspecialchars(strip_tags($datos->osEstatus));
            $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $sp_id = htmlspecialchars(strip_tags($datos->sp_id)); 
           // $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::OSESTATUS . " = :osEstatus " .
           " WHERE " . self::SP_ID . " = :sp_id AND " .
            self::SP_EJERCICIO . " = :sp_ejercicio";

            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":osEstatus", $osEstatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }
    private static function eliminarDetRec($id, $osDetPosicion)
    {
    try {
        $consulta = "DELETE FROM " . self::NOMBRE_TABLA_DET .
                    " WHERE " . self::OSNUMDOC . " = :osNumDoc AND "
                    . self::OSDETPOSICION  . " = :osDetPosicion";

        // Eliminar el detalle
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
        $sentencia->bindParam(":osDetPosicion", $osDetPosicion, PDO::PARAM_STR);
        $sentencia->execute();

        // Actualizar las posiciones
        $consultaUpdate = "UPDATE " . self::NOMBRE_TABLA_DET .
                          " SET " . self::OSDETPOSICION  . " = " . self::OSDETPOSICION  . " - 1" .
                          " WHERE " . self::OSNUMDOC . " = :osNumDoc" .
                          " AND " . self::OSDETPOSICION  . " > :osDetPosicion";

        $sentenciaUpdate = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consultaUpdate);
        $sentenciaUpdate->bindParam(":osNumDoc", $id, PDO::PARAM_STR);
        $sentenciaUpdate->bindParam(":osDetPosicion", $osDetPosicion, PDO::PARAM_STR);
        $sentenciaUpdate->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
    }
    public static function actualizarCamposOrden($datos, $peticion)
    {
    if ($datos) {
        $campos = self::CAMPOS_OS_COMPRAS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));

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
            $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::OSNUMDOC . " = :osNumDoc AND " . self::SP_EJERCICIO . " = :sp_ejercicio )";


            // Preparar la sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

            // Bind de los parámetros
            foreach ($bindParams as $param => &$value) {
                $sentencia->bindParam($param, $value, PDO::PARAM_STR);
            }

            $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);

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
 private static function obtenerParaCargarFac($peticion)
    {
        
        $and = " and (osEstatus IN ('FAC', 'ENVPROV') OR (osEstatus = 'PRELIB' AND osTipoDoc = 'Servicio'))";

        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }
       // var_dump($filtro);
        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_OS_COMPRAS);

        $consulta = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING . $filtro['where'] .  $and . " order by os.osNumDoc desc";

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



}//fin de la clase