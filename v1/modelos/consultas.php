<?PHP
class consulta
{
    const NOMBRE_TABLA = "solicitud_pagos";
    const NOMBRE_TABLA_ORDENES ="ordenes_sica";
    const OSNUMDOC ="osNumDoc";
    const SP_ID = "sp_id";

    //Captura Inicial

    const SP_ESTATUS = "sp_estatus";
    const SP_TIPO_SOL = "sp_tipo_sol";
    const SP_CONCEPTO = "sp_concepto";
    const PROV_ID = "prov_id";
    const CUECON_CUENTA = "cuecon_cuenta";
    const SP_DESCRIPCION = "sp_descripcion";
    const SP_OBSERVACION = "sp_observacion";
    const SP_IMPORTE = "sp_importe";
    const SP_FECHA_SOLICITUD = "sp_fecha_solicitud";
    const SP_FOLIO_COMPROBACION = "sp_folio_comprobacion";
    const SP_NUM_OFICIO = "sp_num_oficio";
    const SP_FUENTE_FIN = "sp_fuente_fin";
    const SP_USER_ELABORA = "sp_user_elabora";
    const SP_FECHA_ELABORA = "sp_fecha_elabora";
    const SP_NO_FACTURA = "sp_no_factura";
    const SP_FECHA_FACTURA = "sp_fecha_factura";
    const SP_FECHA_FACTURA_PROB_PAGO = "sp_fecha_factura_prob_pago";
    const SP_EMP_ID_AUT = "sp_emp_id_aut";
    const SP_EMP_ID_SOL = "sp_emp_id_sol";
    const SP_DIRECCION_SOL = "sp_direccion_sol";
    const SP_VOBO_EMP_ID = "sp_vobo_emp_id";
    //

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::SP_ID,
        self::SP_ESTATUS,
        self::SP_TIPO_SOL,
        self::SP_CONCEPTO,
        self::PROV_ID,
        self::CUECON_CUENTA,
        self::SP_DESCRIPCION,
        self::SP_OBSERVACION,
        self::SP_IMPORTE,
        self::SP_FECHA_SOLICITUD,
        self::SP_FOLIO_COMPROBACION,
        self::SP_NUM_OFICIO,
        self::SP_FUENTE_FIN,
        self::SP_USER_ELABORA,
        self::SP_FECHA_ELABORA,
        self::SP_NO_FACTURA,
        self::SP_FECHA_FACTURA,
        self::SP_FECHA_FACTURA_PROB_PAGO,
        self::SP_EMP_ID_AUT,
        self::SP_EMP_ID_SOL,
        self::SP_DIRECCION_SOL,
        self::SP_VOBO_EMP_ID
    );
    const CAMPOS_ORDENES = array(
        self::OSNUMDOC
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
        switch ($peticion[0]) {
            case 'direccion':
                return self::obtenerDireccion();
                break;
            case 'provxtipo':
                return self::obtenerProvxTipo($peticion[1]);
                break;
            case 'directores':
                return self::obtenerDirectores($peticion[1]);
                break;
            case 'cuentaxprovxtipo':
                return self::obtenerCuentaxProvxTipo($peticion[1], $peticion[2]);
                break;
            case 'solpagos':
                if(isset($peticion[1])) {
                    return self::obtenerfoliosxfiltro($peticion[1]);
                }
                if(isset($peticion[2])) {
                    return self::obtenerfoliosxfiltro($peticion[1], $peticion[2]);
                }
                if(isset($peticion[3])) {
                    return self::obtenerfoliosxfiltro($peticion[1], $peticion[2], $peticion[3]);
                }
                if(isset($peticion[4])) {
                    return self::obtenerfoliosxfiltro($peticion[1], $peticion[2], $peticion[3], $peticion[4]);
                }
                break;
            case 'ejercidos':
                return self::obtenerEjercidos($peticion[1], $peticion[2]);
                break;
            case 'folios':
                return self::obtenerfoliosContxfiltro($peticion[1], $peticion[2]);
                break;
            case 'ejercidosimp':
                return self::obtenerEjercidosImp($peticion[1], $peticion[2]);
                break;
            case 'grupoenvpagos':
                return self::obtenerGruposEnvPagos($peticion[1], $peticion[2]);
                break;
            case 'grupoenvpregxc':
                return self::obtenerGruposEnvPresGxc($peticion[1], $peticion[2]);
                break;
            //Enviar a firma de autorizacion
            case 'grupoenvfiraut':
                return self::obtenerGruposEnvFirAut($peticion[1], $peticion[2]);
                break;
            //Enviar Comprometidos y devengados
            case 'grupoenvcomdev':
                return self::obtenerGruposEnvComDev($peticion[1], $peticion[2]);
                break;
            //Enviar a Contabilidad Gastos x conprobar
            case 'grupoenvcongxc':
                return self::obtenerGruposEnvConGxc($peticion[1], $peticion[2]);
                break;
            //Enviar a Contabilidad solicitudes NP
            case 'grupoenvconnp':
                return self::obtenerGruposEnvConNp($peticion[1], $peticion[2]);
                break;
            //Dashboard x Estatus
            case 'dashresumenestatus':
                return self::obtenerResumenxEstatus($peticion[1]);
                break;
            //Dashboard x Mes Pagadas
            case 'dashresumenpagosmes':
                return self::obtenerResumenPagosMes($peticion[1]);
                break;
            //Distinct de un campo y una tabla generico
            case 'distinct':
                return self::obtenerDistinct($peticion[1], $peticion[2], $peticion[3]);
                break;
            case 'usuarios':
                return self::obtenerUsuarios($peticion[1], $peticion[2]);
                break;
            case 'empleados':
                return self::obtenerEmpleados($peticion[1], $peticion[2]);
                break;
            case 'cuentascontables':
                return self::obtenerCuentasContables($peticion[1], $peticion[2]);
                break;            
            case 'tipos':
                return self::obtenerTipos($peticion[1], $peticion[2]);
                break;                
            case 'proveedor':
                return self::obtenerProveedores($peticion[1], $peticion[2]);
                break;                    
            case 'sistemas':
                return self::obtenerSistemas($peticion[1], $peticion[2]);
                break;
            case 'ejercicios':
                    return self::obtenerEjercicios();
                break;   
            case 'ejerciciosOrd':
                    return self::obtenerEjerciciosOrdenes();
                break;
            case 'ejerFact':
                    return self::obtenerEjerciciosFactura();
                break;                        
            case 'clastipocon':
                return self::obtenerClasTipoConsulta($peticion[1]);
                break;                        
            case 'sgteprod':
                return self::obtenerSgteProd($peticion[1]);
                break;    
            case 'foliosComPre':
                return self::obtenerfoliosComPreContxfiltro($peticion[1], $peticion[2]);
                break;
            case 'departamentos':
                return self::obtenerDeptos($peticion[1]);
                break;
            case 'conceptoSicas':
                return self::obtenerconceptoSicas();
                break;
             case 'tipOrden';
                return self::obtenerTipOrden();
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
    private static function obtenerProvxTipo($id = null)
    {
        try {
            $whereId = !empty($id) ? "where prov_activo = 1 and prov_id in (select distinct prov_id from cuenta_contable where tipo_id = :sp_id or tipo2_id = :sp_id )" : "";

            $union = "union all 
            select p.prov_id, p.prov_razon_social,p.prov_tipo,t.tipo_descripcion,
            p.prov_RFC, p.prov_empresayuc, p.prov_NumRegPadProv,
            p.prov_activo,p.prov_creado_por,p.prov_creado_el,
            p.prov_modificado_por,p.prov_modificado_el,
            ifnull(p.prov_direccion,'') as prov_direccion,
            ifnull(p.prov_ciudad,'') as prov_ciudad,  
            ifnull(p.prov_email,'') as prov_email, 
            ifnull(p.prov_email2,'') as prov_email2 
            from  proveedor p
            inner join tipo t on p.prov_tipo = t.tipo_clave and t.clatip_id = 'TIPPROV'
            where p.prov_id in (select prov_id from cuenta_contable where es_multi_concepto = 1 )";

            $comando = "select p.prov_id, p.prov_razon_social,p.prov_tipo,t.tipo_descripcion,
            p.prov_RFC, p.prov_empresayuc, p.prov_NumRegPadProv,
            p.prov_activo,p.prov_creado_por,p.prov_creado_el,
            p.prov_modificado_por,p.prov_modificado_el, 
            ifnull(p.prov_direccion,'') as prov_direccion,
            ifnull(p.prov_ciudad,'') as prov_ciudad,  
            ifnull(p.prov_email,'') as prov_email, 
            ifnull(p.prov_email2,'') as prov_email2 
            from  proveedor p
            inner join tipo t on p.prov_tipo = t.tipo_clave and t.clatip_id = 'TIPPROV' " . $whereId . $union . " order by  prov_razon_social";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerDireccion()
    {
        try {
            $comando = "select distinct emp_direccion  from empleado order by emp_direccion";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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

    private static function obtenerDirectores()
    {
        try {
            $comando = "select * from empleado where emp_codigo = emp_codigo_director";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerCuentaxProvxTipo($prov_id = null, $tipo_id = null)
    {
        try {
            $whereId = "where c.prov_id = :prov_id and (c.tipo_id = :tipo_id or c.tipo2_id = :tipo_id) and c.cuecon_activo = 1";

            /*
            $union = " union all 
            select c.cuecon_cuenta,c.prov_id,p.prov_razon_social,c.tipo_id,t.tipo_descripcion,
            c.tipo2_id,t2.tipo_descripcion as tipo2_descripcion,
            c.cuecon_activo,c.cuecon_creado_por,c.cuecon_creado_el,c.cuecon_modificado_por,
            c.cuecon_modificado_el from cuenta_contable c
            inner join proveedor p on c.prov_id = p.prov_id
            inner join tipo t on c.tipo_id = t.tipo_id
            left join tipo t2 on c.tipo2_id = t2.tipo_id 
            where c.es_multi_concepto = 1";
            */

            $comando = "select c.cuecon_cuenta,c.prov_id,p.prov_razon_social,c.tipo_id,t.tipo_descripcion,
            c.tipo2_id,t2.tipo_descripcion as tipo2_descripcion,
            c.cuecon_activo,c.cuecon_creado_por,c.cuecon_creado_el,c.cuecon_modificado_por,
            c.cuecon_modificado_el from cuenta_contable c
            inner join proveedor p on c.prov_id = p.prov_id
            inner join tipo t on c.tipo_id = t.tipo_id
            left join tipo t2 on c.tipo2_id = t2.tipo_id " . $whereId . " order by  cuecon_cuenta";
            //left join tipo t2 on c.tipo2_id = t2.tipo_id " . $whereId . $union. " order by  cuecon_cuenta";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            $sentencia->bindParam(":prov_id", $prov_id, PDO::PARAM_INT);
            $sentencia->bindParam(":tipo_id", $tipo_id, PDO::PARAM_INT);

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
    private static function obtenerfoliosxfiltro($filtro = null, $order = null, $valor = null, $filtro2 =null)
    
    {
        try {

           /*  var_dump('filtro :' . $filtro);
            var_dump('order :' . $order);
            var_dump('valor :' . $valor);
            var_dump('filtro2 :' . $filtro2);
 */
if ($valor == null){
    $valor = ' ';
}
if ($filtro2 == null){
    $filtro2 = ' ';
}
if ($filtro == null){
    $filtro = 's.sp_id > 0';
}
if ($order == null){
    $order = 's.sp_id';
}


 $SELECT_CREADO = "select s.sp_ejercicio,s.sp_id, s.sp_tipo_sol, ts.tipo_descripcion as nom_tipo_sol,
    s.sp_concepto, tc.tipo_descripcion as nom_concepto,
    s.prov_id, p.prov_razon_social,  s.sp_pago_nombre_de,
    s.cuecon_cuenta, s.sp_descripcion,
    s.sp_observacion, s.sp_importe, s.sp_fecha_solicitud, s.sp_folio_comprobacion, s.sp_num_oficio,
    s.sp_fuente_fin, ftefin.tipo_descripcion as nom_fuente_fin,
    s.sp_user_elabora, u.usr_nombres as nom_user_elabora,
    s.sp_fecha_elabora, s.sp_no_factura, s.sp_fecha_factura,
    s.sp_fecha_factura_prob_pago, s.sp_emp_id_aut, ea.emp_nombre as nombre_aut,
    ea.emp_puesto as puesto_aut, ea.emp_titulo as titulo_aut, ea.emp_direccion as direccion_aut,
    s.sp_emp_id_sol, es.emp_nombre as nombre_sol,
    es.emp_puesto as puesto_sol, es.emp_titulo as titulo_sol, es.emp_direccion as direccion_sol,
    s.sp_direccion_sol, s.sp_vobo_emp_id, evb.emp_nombre as nombre_vobo,
    evb.emp_puesto as puesto_vobo, evb.emp_titulo as titulo_vobo, evb.emp_direccion as direccion_vobo,
    -- CREADO
    s.sp_id_gpo_firma_sol, s.sp_fecha_firma_sol_ida, s.sp_user_firma_sol_ida, ufdi.usr_nombres as nombre_firma_sol_ida,
    -- SOLFIRIDA
    s.sp_fecha_firma_sol_vuelta, s.sp_user_firma_sol_vuelta, ufdv.usr_nombres as nombre_firma_sol_vuelta,
    -- SOLFIRVTA
    s.sp_id_gpo_firma_aut_ida, s.sp_fecha_firma_aut_ida, s.sp_user_firma_aut_ida,ufai.usr_nombres as nombre_firma_aut_ida,
    -- AUTFIR
    s.sp_id_gpo_firma_aut_vuelta, s.sp_fecha_firma_aut_vuelta, s.sp_user_firma_aut_vuelta, ufav.usr_nombres as nombre_firma_aut_vuelta,
    -- PAGOS
    s.sp_id_gpo_firma_aut_vuelta_gxc, s.sp_fecha_conta_gasxcomp, s.sp_user_conta_gasxcomp,ufavgxc.usr_nombres as nombre_conta_gasxcomp,
    -- GASCOM
    obtenerfolios(s.sp_id,'D',s.sp_ejercicio) as foliosDevengados,
    obtenerfolios(s.sp_id,'C',s.sp_ejercicio) as foliosComprometidos,
    -- COMPROMETIDO
    s.sp_folio_ejercido,s.sp_poliza_ejercido, s.sp_fecha_ejercido_cap,s.sp_fecha_ejercido, s.sp_user_ejercido,ueje.usr_nombres as nombre_ejercido,
    s.sp_id_gpo_ejercido, sp_fecha_envia_ejercido, sp_user_envia_ejercido, uenveje.usr_nombres as nombre_envia_ejercido,
    -- EJERCIDO
    s.sp_tipo_pago, tp.tipo_descripcion as Nom_tipo_pago, 
    s.sp_no_cuenta_pago, tcb.tipo_descripcion as CuentaBancaria, 
    s.sp_banco_pago, tb.tipo_descripcion as NomBanco, s.sp_fecha_pago_cap,
    s.sp_fecha_pago, s.sp_user_pago,upag.usr_nombres as nombre_pago,
    s.sp_no_poliza_pago, s.sp_no_folio_pago,
    -- FINPAGO
    s.sp_fecha_por_cancelar, s.sp_user_por_cancelar, uxcan.usr_nombres as nombre_xcancelar, s.sp_motivo_por_cancelar,
    -- XCANCELAR
    s.sp_fecha_cancelacion, s.sp_folio_cancela, s.sp_user_cancelacion, ucan.usr_nombres as nombre_cancelo,
    s.sp_poliza_ejercido_cancela, s.sp_motivo_cancelacion,
    -- CANCELADO
    s.sp_id_gpo_gxc_ent_conta, s.sp_fecha_gxc_ent_conta, s.sp_user_gxc_ent_conta,
    -- FINGXC
    s.sp_fecha_modifica, s.sp_user_modifica, umod.usr_nombres as nombre_modifica,
    -- MODIFICA
    s.sp_folios_comprometido, s.sp_folios_devengado,
    s.sp_fecha_folios, s.sp_user_folios, ufol.usr_nombres as nombre_folios,
    s.sp_id_gpo_folios, s.sp_fecha_gpo_folios, s.sp_user_gpo_folios, ugpofol.usr_nombres as nombre_gpo_folios,
    -- FOLIOS
    s.sp_estatus, est.tipo_descripcion as estatus_nombre, est.tipo_orden as estatus_orden,
    -- ESTATUS
    s.sp_saldo,s.sp_devolucion_efectivo,s.sp_id_folio_afecta,s.sp_ejercicio_afecta,
    -- CASOS ESPECIALES
    s.sp_id_gpo_envio_cont_np,
    s.sp_fecha_envio_cont_np,
    s.sp_user_envio_cont_np,
    ugpocontnp.usr_nombres as nombre_envio_cont_np,
    -- CONTABILIDAD_NP
    s.sp_fecha_autoriza_vuelta,s.sp_user_autoriza_vuelta,ufirvta.usr_nombres as nombre_autoriza_vuelta,
    -- AUTFIRVTA
    sp_fecha_precaptura,sp_id_gpo_envio_cont_pre_comp, sp_fecha_envio_cont_pre_comp,sp_user_envio_cont_pre_comp,
    -- PRECAPTURA
   -- ENVPRECAP
    s.sp_fecha_envprecap,
    s.sp_user_envprecap,userenv.usr_nombres as nombre_envprecap,
    s.sp_fecha_recibe,
    s.sp_user_recibe, usrrecb.usr_nombres  as nombre_recibe,
    s.sp_fecha_libera,
    s.sp_user_libera, usrlibe.usr_nombres as nombre_libera,
    s.sp_fecha_precaxrec,
    s.sp_user_precaxrec, usrxrec.usr_nombres as nombre_precaxrec,
    s.sp_fecha_precaprec, 
    s.sp_user_precaprec, usrprec.usr_nombres as nombre_precaprec,
    s.sp_fechaCreado,
    s.sp_fecha_envcomp,
    s.sp_user_envcomp, usrcomp.usr_nombres as nombre_envcomp,
    s.sp_id_comp,
    s.contrarecibo,
    s.osNumDoc,
    os.osTipoDoc as tipoOrden
    from  ";

     $INNER_CREADO = " s 
    left join ordenes_sica os on s.osNumDoc = os.osNumDoc
    inner join tipo ts on s.sp_tipo_sol = ts.tipo_id
    inner join tipo tc on s.sp_concepto = tc.tipo_id
    inner join proveedor p on s.prov_id = p.prov_id
    inner join cuenta_contable cc on s.cuecon_cuenta = cc.cuecon_cuenta
    inner join usuario u on s.sp_user_elabora = u.usr_id
    inner join empleado ea on s.sp_emp_id_aut = ea.emp_id
    left join empleado es on s.sp_emp_id_sol = es.emp_id
    left join empleado evb on s.sp_vobo_emp_id = evb.emp_id 
    -- inner join estatus est on s.sp_estatus = est.estatus_id
    inner join tipo est on s.sp_estatus = est.tipo_clave
    left join tipo tp on s.sp_tipo_pago = tp.tipo_id
    left join tipo tb on s.sp_banco_pago = tb.tipo_id
    left join tipo tcb on s.sp_no_cuenta_pago = tcb.tipo_id
    left join usuario ufdi on s.sp_user_firma_sol_ida = ufdi.usr_id
    left join usuario ufdv on s.sp_user_firma_sol_vuelta = ufdv.usr_id
    left join usuario ufai on s.sp_user_firma_aut_ida = ufai.usr_id
    left join usuario ufav on s.sp_user_firma_aut_vuelta = ufav.usr_id
    left join usuario ufavgxc on s.sp_user_conta_gasxcomp = ufavgxc.usr_id
    left join usuario ueje on s.sp_user_ejercido = ueje.usr_id
    left join usuario upag on s.sp_user_pago = upag.usr_id
    left join usuario ucan on s.sp_user_cancelacion = ucan.usr_id
    left join usuario uxcan on s.sp_user_por_cancelar = uxcan.usr_id
    left join usuario umod on s.sp_user_modifica = umod.usr_id 
    left join usuario ufol on s.sp_user_folios = ufol.usr_id 
    left join usuario ugpofol on s.sp_user_gpo_folios = ugpofol.usr_id 
    left join usuario ugpocontnp on s.sp_user_envio_cont_np = ugpocontnp.usr_id 
    left join usuario uenveje on s.sp_user_envia_ejercido = uenveje.usr_id 
    left join tipo ftefin on s.sp_fuente_fin = ftefin.tipo_clave
    left join usuario ufirvta on s.sp_user_autoriza_vuelta = ufirvta.usr_id
    left join usuario userenv on s.sp_user_envprecap = userenv.usr_id
    left join usuario usrrecb on s.sp_user_recibe = usrrecb.usr_id
    left join usuario usrlibe on s.sp_user_libera = usrlibe.usr_id
    left join usuario usrxrec on s.sp_user_precaxrec = usrxrec.usr_id
    left join usuario usrprec on s.sp_user_precaprec = usrprec.usr_id
    left join usuario usrcomp on s.sp_user_envcomp = usrcomp.usr_id
    ";

//filtro = LIKE
//order = sp_descripcion
//especia = GTS
//filtro2 = filtro

    if ($filtro != null){
        if ($filtro == 'LIKE'){
            if ($filtro2 != null){
                $whereId = " where " . $filtro2 . " AND " . $order . " like '%" . $valor ."%'";
            } else {
                $whereId = " where " . $order . " like '%" . $valor ."%'";
            }
            $orderby = " order by sp_id";
        }else{
            $whereId = " where " . $filtro;
            if ($order == null)
        {
            $orderby = " order by sp_id";
        }else{
            $orderby = " order by " . $order;

        }
        }
        
    }else{
/*         if ($orderby == null){
            $orderby = " order by sp_id///";
        }
 */        $whereId = " where s.sp_id > 0/" .  $orderby;
    }






    
   /*  if ($especial != null){
        if ($especial == 'LIKE'){
            if ($filtro != null){
                $whereId = " where " . $filtro . " AND " . $order . " like '%" . $valor ."%'";
            } else {
                $whereId = " where " . $order . " like '%" . $valor ."%'";
            }   
            $orderby = " order by sp_id";
        }

    }else {
        if ($filtro != null){
            $whereId = " where " . $filtro;
        }else{
            $whereId = " where sp_id > 0" . $filtro;
        }

        if ($order == null)
        {
            $orderby = " order by sp_id";
        }else{
            $orderby = " order by " . $order;

        }
    }         */
    
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerEjercidos($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select s.sp_ejercicio,s.sp_id,s.sp_poliza_ejercido, s.sp_folio_ejercido,s.sp_fecha_ejercido_cap, s.sp_user_ejercido,
            ueje.usr_nombres as nombre_ejercido, s.sp_id_gpo_ejercido FROM ";

            $INNER_CREADO = " s left join usuario ueje on s.sp_user_ejercido = ueje.usr_id ";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerfoliosContxfiltro($filtro = null, $order = null)
    {
        try {

            $CONSULTA= "select f.folio_id,f.folio_num, f.sp_id,f.folio_fecha,f.folio_iscomprometido,f.folio_isdevengado,f.folio_activo,
            f.folio_fecha_crea,f.folio_user_crea,ucrea.usr_login as login_crea, ucrea.usr_nombres as nombre_crea,
            f.folio_fecha_cancela,f.folio_user_cancela,ucan.usr_login as login_cancela, ucan.usr_nombres as nombre_cancela, 
            case when s.sp_concepto = 23 then 1 when s.sp_concepto = 24 then 1 else 0 end as EsComprobacion, p.prov_razon_social,
            s.sp_importe, s.sp_fecha_gpo_folios, s.sp_user_gpo_folios,ugpofol.usr_nombres as nombre_gpo_folios,
            s.sp_pago_nombre_de FROM folios f 
            inner join usuario ucrea on f.folio_user_crea = ucrea.usr_id
            left join usuario ucan on f.folio_user_cancela = ucan.usr_id
            inner join solicitud_pagos s on f.sp_id = s.sp_id and f.sp_ejercicio = s.sp_ejercicio
            inner join proveedor p on s.prov_id = p.prov_id 
            left join usuario ugpofol on s.sp_user_gpo_folios = ugpofol.usr_id ";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where folio_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by folio_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $CONSULTA . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerEjercidosImp($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct s.sp_ejercicio, s.sp_id, ifnull(f.folio_num,'') as comprometido, s.sp_fecha_ejercido_cap,s.sp_folio_ejercido,s.sp_poliza_ejercido,
            p.prov_razon_social, s.sp_pago_nombre_de,s.sp_importe, s.sp_id_gpo_ejercido, s.sp_fecha_envia_ejercido from ";

            //$INNER_CREADO = " s inner join folios f on s.sp_id = f.sp_id and f.folio_activo = 1
            //inner join proveedor p on s.prov_id = p.prov_id";

            $INNER_CREADO = " s left join folios f on s.sp_id = f.sp_id and f.folio_activo = 1 and s.sp_ejercicio = f.sp_ejercicio
            inner join proveedor p on s.prov_id = p.prov_id";


            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerGruposEnvPagos($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct s.sp_id_gpo_firma_aut_vuelta as idGrupo,
            CAST(s.sp_fecha_firma_aut_vuelta as date) as FechaEnviaPago,
            s.sp_user_firma_aut_vuelta as UserEnviaPago,
            u.usr_nombres as nombreEnviaFirmaAutoriza,
            totalGrupo(s.sp_id_gpo_firma_aut_vuelta,'ENVPAG') as totalGrupo,
            count(s.sp_id_gpo_firma_aut_ida) as numelementos
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_firma_aut_vuelta";

            $GROUP_BY = " group by  s.sp_id_gpo_firma_aut_vuelta,CAST(s.sp_fecha_firma_aut_vuelta as date),s.sp_user_firma_aut_vuelta, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    
    private static function obtenerGruposEnvPresGxc($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct s.sp_id_gpo_firma_aut_vuelta_gxc as idGrupo,
            CAST(s.sp_fecha_conta_gasxcomp as date) as FechaEnviaPresuGxC,
            s.sp_user_conta_gasxcomp as UserEnviaPresuGxC,
            u.usr_nombres as NombreEnviaPresuGxC,
            totalGrupo(s.sp_id_gpo_firma_aut_vuelta_gxc,'ENVPREGXC') as totalGrupo,
            count(s.sp_id_gpo_firma_aut_vuelta_gxc) as numelementos
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_conta_gasxcomp";

            $GROUP_BY = " group by  s.sp_id_gpo_firma_aut_vuelta_gxc,CAST(s.sp_fecha_conta_gasxcomp as date),s.sp_user_conta_gasxcomp, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerGruposEnvFirAut($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct s.sp_id_gpo_firma_aut_ida as idGrupo,
            CAST(s.sp_fecha_firma_aut_ida AS date) as FechaEnviaFirmaAutoriza,
            s.sp_user_firma_aut_ida as userEnviaFirmaAutoriza,
            u.usr_nombres as nombreEnviaFirmaAutoriza,            
            totalGrupo(s.sp_id_gpo_firma_aut_ida,'ENVFIRAUT') as totalGrupo,
            count(s.sp_id_gpo_firma_aut_ida) as numelementos
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_firma_aut_ida";

            $GROUP_BY = " group by  s.sp_id_gpo_firma_aut_ida,CAST(s.sp_fecha_firma_aut_ida AS date),s.sp_user_firma_aut_ida, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerGruposEnvComDev($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct sp_id_gpo_folios as idGrupo,
            CAST(sp_fecha_folios as date) as fechaEnviaComprometidos,
            sp_user_folios as UserEnviaComprometidos,
            u.usr_nombres as NombreEnviaComprometidos,
            totalGrupo(s.sp_id_gpo_folios,'ENVCOMDEV') as totalGrupo,
            count(s.sp_id_gpo_folios) as numelementos
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_folios";

            $GROUP_BY = " group by  s.sp_id_gpo_folios,CAST(sp_fecha_folios as date),s.sp_user_folios, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerGruposEnvConGxc($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select distinct sp_id_gpo_gxc_ent_conta as idGrupo,
            CAST(sp_fecha_gxc_ent_conta as date) as FechaenviaContaGxC,
            sp_user_gxc_ent_conta as UserEnviaContaGxC,
            u.usr_nombres as NombreEnviaContaGxC,
            totalGrupo(sp_id_gpo_gxc_ent_conta,'ENVCONGXC') as totalGrupo,
            count(s.sp_id_gpo_gxc_ent_conta) as numelementos 
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_gxc_ent_conta";

            $GROUP_BY = " group by  s.sp_id_gpo_gxc_ent_conta,CAST(sp_fecha_gxc_ent_conta as date),s.sp_user_gxc_ent_conta, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            

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
    private static function obtenerGruposEnvConNp($filtro = null, $order = null)
    {
        try {
            $SELECT_CREADO = "select  distinct s.sp_id_gpo_envio_cont_np as idGrupo,
            CAST(s.sp_fecha_envio_cont_np as date) as FechaEnviaContaNp,
            s.sp_user_envio_cont_np as UserEnviaContaNp,
            u.usr_nombres as nombreEnviaContaNp,
            totalGrupo(sp_id_gpo_envio_cont_np,'ENVCONNP') as totalGrupo,
            count(s.sp_id_gpo_envio_cont_np) as numelementos            
            from  ";

            $INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_envio_cont_np";

            $GROUP_BY = " group by  s.sp_id_gpo_envio_cont_np,CAST(s.sp_fecha_envio_cont_np as date),s.sp_user_envio_cont_np, u.usr_nombres";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where s.sp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by s.sp_id";
            }else{
                $orderby = " order by " . $order;

            }

            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;
            $comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $GROUP_BY . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerResumenxEstatus($ejercicio)
    {
        try {
            if($ejercicio == 0){
                $comando = "select e.tipo_descripcion as NomEstatus, 
                count(s.sp_id) as NumSolicitudes,
                sum(s.sp_importe) as Total,
                e.tipo_orden as tipo_orden
                from solicitud_pagos s
                inner join tipo e on s.sp_estatus = e.tipo_clave
                group by  e.tipo_descripcion ,e.tipo_orden
                union
                select 'TOTAL' as NomEstatus, 
                count(s.sp_id) as NumSolicitudes,
                sum(s.sp_importe) as Total,
                 20 as tipo_orden
                from solicitud_pagos s
                order by tipo_orden;";
    
            }else{
                $comando = "select e.tipo_descripcion as NomEstatus, 
                count(s.sp_id) as NumSolicitudes,
                sum(s.sp_importe) as Total,
                e.tipo_orden as tipo_orden
                from solicitud_pagos s
                inner join tipo e on s.sp_estatus = e.tipo_clave
                where s.sp_ejercicio = " . $ejercicio .
                " group by  e.tipo_descripcion ,e.tipo_orden
                union
                select 'TOTAL' as NomEstatus, 
                count(s.sp_id) as NumSolicitudes,
                sum(s.sp_importe) as Total,
                 20 as tipo_orden
                from solicitud_pagos s
                where s.sp_ejercicio = " . $ejercicio .
                " order by tipo_orden;";
            }

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerResumenPagosMes( $ejercicio)
    {
        try {
            $comando = 'select date_format(s.sp_fecha_pago_cap, "%b-%x") as MesYear,
            count(s.sp_fecha_pago_cap) as NumFolios,
            sum(s.sp_importe) as totalxMes,
            date_format(s.sp_fecha_pago_cap, "%m") as orden
            from solicitud_pagos s 
            where s.sp_estatus = "FINPAGO" 
            and s.sp_ejercicio = ' . $ejercicio .
            ' group by date_format(s.sp_fecha_pago_cap, "%b-%x") ,
            date_format(s.sp_fecha_pago_cap, "%m")
            union
            select "TOTAL" as MesYear,
            count(s.sp_id) as NumFolios,
            sum(s.sp_importe) as totalxMes,
            13 as orden
            from solicitud_pagos s 
            where s.sp_estatus = "FINPAGO" 
            and s.sp_ejercicio = ' . $ejercicio .
            ' order by orden;';

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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
    private static function obtenerDistinct($tabla = null, $campo = null, $filterAnd = null)
    {
        try {
            
            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where sp_id > 0" . $filtro;
            } 
                $comando = "select distinct " . $campo . " from " . $tabla . " where ifnull(" . $campo . ",'') <> ''" . $filterAnd .
                " order by " . $campo . ";";
    
            
            //var_dump($comando);
            //$comando = $SELECT_CREADO . self::NOMBRE_TABLA . $INNER_CREADO . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerUsuarios($filtro = null, $order = null)
    {
        try {
            $SELECT = "select usr_id,usr_login,usr_nombres,usr_correo,usr_activo,usr_rol from usuario ";

            //$INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_envio_cont_np";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where usr_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by usr_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerEmpleados($filtro = null, $order = null)
    {
        try {
            $SELECT = "select emp_id,emp_codigo,emp_nombre,emp_puesto,emp_departamento,emp_codigo_director,emp_direccion,
            emp_titulo,emp_activo,emp_creado_por,emp_creado_el,emp_modificado_por,emp_modificado_el
            from empleado ";

            //$INNER_CREADO = " s left join usuario u on u.usr_id = s.sp_user_envio_cont_np";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where emp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by emp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerCuentasContables($filtro = null, $order = null)
    {
        try {
             $SELECT = "select c.cuecon_cuenta,c.prov_id,p.prov_razon_social,c.tipo_id,t.tipo_descripcion,
            c.tipo2_id,t2.tipo_descripcion as tipo2_descripcion,
            c.cuecon_activo,c.cuecon_creado_por,c.cuecon_creado_el,c.cuecon_modificado_por,
            c.cuecon_modificado_el from cuenta_contable c 
            inner join proveedor p on c.prov_id = p.prov_id
            inner join tipo t on c.tipo_id = t.tipo_id
            left join tipo t2 on c.tipo2_id = t2.tipo_id";
        

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where emp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by emp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerTipos($filtro = null, $order = null)
    {
        try {
            $SELECT = "select t.tipo_id,t.tipo_descripcion, t.clatip_id, c.clatip_descripcion,
            t.tipo_activo,t.tipo_creado_por,t.tipo_creado_el,
            t.tipo_modificado_por,t.tipo_modificado_el, 
            t.tipo_clave,t.tipo_orden,
            t.tipo_relacion1, r1.tipo_descripcion as desc_relacion1,
            t.tipo_relacion2, r2.tipo_descripcion as desc_relacion2,
            t.id_sistema, s.sis_siglas
            FROM tipo t 
            inner join clasificacion_tipo c on t.clatip_id = c.clatip_id
            left join tipo r1 on t.tipo_relacion1 = r1.tipo_id
            left join tipo r2 on t.tipo_relacion2 = r2.tipo_id
            left join sistema s on t.id_sistema = s.id_sistema"; 
              

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where emp_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by emp_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerProveedores($filtro = null, $order = null)
    {
        try {
            $SELECT = "select p.prov_id, p.prov_razon_social,p.prov_tipo,
            t.tipo_descripcion,
            p.prov_activo,p.prov_creado_por,p.prov_creado_el,
            p.prov_modificado_por,p.prov_modificado_el from proveedor p
            inner join tipo t on p.prov_tipo = t.tipo_clave and t.clatip_id = 'TIPPROV'"; 
              

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where prov_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by prov_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerSistemas($filtro = null, $order = null)
    {
        try {
            $SELECT = "select 0 as id_sistema,'Todos los sistemas' as sistema,
            'TODOS' as sis_siglas
            union all
            select s.id_sistema, 
            concat(s.sis_nomsistema, ' ', s.sis_nomsistema2) as sistema,
            s.sis_siglas from sistema s;"; 
              

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where id_sistema >= 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by id_sistema";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
 private static function obtenerEjercicios()
    {
        try {
            $comando = "select distinct sp_ejercicio as sp_ejercicio from solicitud_pagos 
            union select extract(YEAR from now()) as sp_ejercicio order by sp_ejercicio desc;";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
 private static function obtenerEjerciciosOrdenes()
    {
        try {
            $comando = "select distinct sp_ejercicio as sp_ejercicio from ordenes_sica 
            union select extract(YEAR from now()) as sp_ejercicio order by sp_ejercicio desc;";

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
            $mensaje .= !empty($id) ? " con ese Id" : " en la tabla: " .  self::NOMBRE_TABLA_ORDENES;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    private static function obtenerEjerciciosFactura()
    {
        try {
            $comando = "select distinct sp_ejercicio as sp_ejercicio from factura 
            union select extract(YEAR from now()) as sp_ejercicio order by sp_ejercicio desc;";

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
            $mensaje = !empty($id) ? " con ese Id" : " en la tabla " . self::NOMBRE_TABLA_ORDENES;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
     /**
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerClasTipoConsulta($idSistema)
    {
        try {
            /* $comando = "select 'TODOS' as clatip_id, 'TODOS' as clatip_descripcion, 0 as Orden
            union
            select clatip_id,clatip_descripcion,1 as Orden from clasificacion_tipo 
            where clatip_id in (select distinct clatip_id from tipo 
            where id_sistema in (0," . $idSistema . ") and clatip_id <> '0')
            order by Orden, clatip_id,clatip_descripcion;"; */

            $comando = "select clatip_id,clatip_descripcion,1 as Orden from clasificacion_tipo 
            where clatip_id in (select distinct clatip_id from tipo 
            where id_sistema in (0," . $idSistema . ") and clatip_id <> '0')
            order by Orden, clatip_id,clatip_descripcion;";


            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
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
    private static function obtenerSgteProd($familia = null)
    {
        try {
            $SELECT = "select prod_id,
            LEFT( prod_id, INSTR( prod_id,  '0' ) -1 ) AS PRE,
            substring(prod_id,-4) as SUFIJO,
            CAST(substring(prod_id,-4) as SIGNED) as SUFIJO_NUM,
            LPAD((CAST(substring(prod_id,-4) as SIGNED)+1),4,'0') as SGTE_NUM,
            concat(LEFT( prod_id, INSTR( prod_id,  '0' ) -1 ), LPAD((CAST(substring(prod_id,-4) as SIGNED)+1),4,'0')) as Proximo_Prod_Id
            from producto p "; 
              

            $whereId = " where p.familia_id = '" . $familia . "'";
            /* if ($familia != null){
                $whereId = " where p.familia_id = " . $familia;
            } */

            $orderby = " order by CAST(substring(prod_id,-4) as SIGNED) desc limit 1";

            //$comando = $SELECT .  $whereId;
            $comando = $SELECT .  $whereId . $orderby;

            //var_dump(' $comando :' .  $comando);

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    //6/ABR/2022
    private static function obtenerfoliosComPreContxfiltro($filtro = null, $order = null)
    {
        try {

            $CONSULTA= "select f.folio_id,f.folio_num, f.sp_id,f.folio_fecha,f.folio_iscomprometido,f.folio_isdevengado,f.folio_activo,
            f.folio_fecha_crea,f.folio_user_crea,ucrea.usr_login as login_crea, ucrea.usr_nombres as nombre_crea,
            f.folio_fecha_cancela,f.folio_user_cancela,ucan.usr_login as login_cancela, ucan.usr_nombres as nombre_cancela, 
            case when s.sp_concepto = 23 then 1 when s.sp_concepto = 24 then 1 else 0 end as EsComprobacion,
            s.sp_fecha_envio_cont_pre_comp as sp_fecha_gpo_folios, s.sp_user_envio_cont_pre_comp sp_user_gpo_folios,ugpofol.usr_nombres as nombre_gpo_folios,
            s.sp_importe, s.sp_pago_nombre_de, p.prov_razon_social FROM folios f 
            inner join usuario ucrea on f.folio_user_crea = ucrea.usr_id
            left join usuario ucan on f.folio_user_cancela = ucan.usr_id
            inner join solicitud_pagos s on f.sp_id = s.sp_id and f.sp_ejercicio = s.sp_ejercicio
            inner join proveedor p on s.prov_id = p.prov_id 
            left join usuario ugpofol on s.sp_user_envio_cont_pre_comp = ugpofol.usr_id ";

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where folio_id > 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by folio_id";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $CONSULTA . $whereId . $orderby;

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
     * Obtiene Departamentos y su direccion
     * Fecha Creacion: 25/JULIO/2022
     * Creo: Roger Gala
     * Fecha Modificacion: 25/JULIO/2022
     * Modificó: 
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerDeptos($filtro = null)
    {
        try {

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where emp_id > 0" . $filtro;
            }

            $comando = "select distinct emp_direccion,emp_departamento from empleado " .  $whereId . " order by emp_direccion,emp_departamento; ";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

/*             if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
            }
 */
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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
     private static function obtenerTipOrden($filtro = null, $order = null)
    {
        try {
            $SELECT = "SELECT tipo_descripcion, tipo_clave
            FROM tipo
            WHERE clatip_id = 'TIPDOC'
            UNION ALL
            SELECT 'TODAS LAS ORDENES' AS tipo_clave, 0 AS tipo_clave;"; 
              

            if ($filtro != null){
                $whereId = " where " . $filtro;
            }else{
                $whereId = " where tipo_clave >= 0" . $filtro;
            }

            if ($order == null)
            {
                $orderby = " order by tipo_clave";
            }else{
                $orderby = " order by " . $order;

            }

            $comando = $SELECT .  $whereId . $orderby;

            
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

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
    private static function obtenerconceptoSicas()
    {
        try {
            $comando = "select c.tipo_id,c.tipo_descripcion,c.clatip_id,c.tipo_clave,c.tipo_orden,
            c.tipo_relacion1 as sp_tipo_sol_id, TIPSOL.tipo_clave as sp_tipo_sol,TIPSOL.tipo_descripcion as sp_tipo_sol_desc
            from tipo c
            inner join tipo TIPSOL on c.tipo_relacion1 = TIPSOL.tipo_id
            WHERE c.TIPO_CLAVE IN ('PAGPROV','ANTPROV');";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            /* if (!empty($id)) {
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
            } */

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
    
}//Fin de Clase
