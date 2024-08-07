<?PHP
class Solpagos
{
    const NOMBRE_TABLA = "solicitud_pagos";
    const SP_EJERCICIO = "sp_ejercicio";
    
    const SP_ID = "sp_id";

    //Captura Inicial

    const SP_ESTATUS = "sp_estatus";
    const SP_TIPO_SOL = "sp_tipo_sol";
    const SP_CONCEPTO = "sp_concepto";
    const PROV_ID = "prov_id";
    const SP_PAGO_NOMBRE_DE = "sp_pago_nombre_de";
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
    const SP_SALDO = "sp_saldo";
    const SP_DEVOLUCION_EFECTIVO = "sp_devolucion_efectivo";
    const SP_ID_FOLIO_AFECTA = "sp_id_folio_afecta";
    const SP_EJERCICIO_AFECTA = "sp_ejercicio_afecta";

    const OSNUMDOC = "osNumDoc";
    const CONTRARECIBO = "contrarecibo";
    
    

    //
    const SP_FECHA_MODIFICA = "sp_fecha_modifica";
    const SP_USER_MODIFICA = "sp_user_modifica";

    const SP_ID_GPO_FIRMA_SOL = "sp_id_gpo_firma_sol";
    const SP_FECHA_FIRMA_SOL_IDA = "sp_fecha_firma_sol_ida";
    const SP_USER_FIRMA_SOL_IDA = "sp_user_firma_sol_ida";
    const SP_FECHA_FIRMA_SOL_VUELTA = "sp_fecha_firma_sol_vuelta";
    const SP_USER_FIRMA_SOL_VUELTA = "sp_user_firma_sol_vuelta";

    const SP_ID_GPO_FIRMA_AUT_IDA = "sp_id_gpo_firma_aut_ida";
    const SP_FECHA_FIRMA_AUT_IDA = "sp_fecha_firma_aut_ida";
    const SP_USER_FIRMA_AUT_IDA = "sp_user_firma_aut_ida";

    const SP_ID_GPO_FIRMA_AUT_VUELTA = "sp_id_gpo_firma_aut_vuelta";
    const SP_FECHA_FIRMA_AUT_VUELTA = "sp_fecha_firma_aut_vuelta";
    const SP_USER_FIRMA_AUT_VUELTA = "sp_user_firma_aut_vuelta";

    const SP_ID_GPO_FIRMA_AUT_VUELTA_GXC = "sp_id_gpo_firma_aut_vuelta_gxc";
    const SP_FECHA_CONTA_GASXCOMP = "sp_fecha_conta_gasxcomp";
    const SP_USER_CONTA_GASXCOMP = "sp_user_conta_gasxcomp";

    const SP_TIPO_PAGO = "sp_tipo_pago";
    const SP_NO_CUENTA_PAGO = "sp_no_cuenta_pago";
    const SP_BANCO_PAGO = "sp_banco_pago";
    const SP_FECHA_PAGO = "sp_fecha_pago";
    const SP_FECHA_PAGO_CAP = "sp_fecha_pago_cap";
    const SP_USER_PAGO = "sp_user_pago";
    const SP_NO_POLIZA_PAGO = "sp_no_poliza_pago";
    const SP_NO_FOLIO_PAGO = "sp_no_folio_pago";

    const SP_FOLIO_EJERCIDO = "sp_folio_ejercido";
    const SP_POLIZA_EJERCIDO = "sp_poliza_ejercido";
    const SP_FECHA_EJERCIDO_CAP = "sp_fecha_ejercido_cap";
    const SP_FECHA_EJERCIDO = "sp_fecha_ejercido";
    const SP_USER_EJERCIDO = "sp_user_ejercido";

    const SP_ID_GPO_EJERCIDO = "sp_id_gpo_ejercido";
    const SP_FECHA_ENVIA_EJERCIDO = "sp_fecha_envia_ejercido";
    const SP_USER_ENVIA_EJERCIDO = "sp_user_envia_ejercido";
    
    const SP_MOTIVO_CANCELACION = "sp_motivo_cancelacion";
    const SP_FECHA_CANCELACION = "sp_fecha_cancelacion";
    const SP_FOLIO_CANCELA = "sp_folio_cancela";
    const SP_USER_CANCELACION = "sp_user_cancelacion";

    const SP_FECHA_POR_CANCELAR = "sp_fecha_por_cancelar";
    const SP_USER_POR_CANCELAR = "sp_user_por_cancelar";
    const SP_MOTIVO_POR_CANCELAR = "sp_motivo_por_cancelar";

    const SP_FOLIOS_COMPROMETIDO = "sp_folios_comprometido";
    const SP_FOLIOS_DEVENGADO = "sp_folios_devengado";
    const SP_FECHA_FOLIOS = "sp_fecha_folios";
    const SP_USER_FOLIOS = "sp_user_folios";

    const SP_ID_GPO_FOLIOS = "sp_id_gpo_folios";
    const SP_FECHA_GPO_FOLIOS = "sp_fecha_gpo_folios";
    const SP_USER_GPO_FOLIOS = "sp_user_gpo_folios";

    const SP_ID_GPO_GXC_ENT_CONTA = "sp_id_gpo_gxc_ent_conta";
    const SP_FECHA_GXC_ENT_CONTA = "sp_fecha_gxc_ent_conta";
    const SP_USER_GXC_ENT_CONTA = "sp_user_gxc_ent_conta";

    const SP_ID_GPO_ENVIO_CONT_NP = "sp_id_gpo_envio_cont_np";
    const SP_FECHA_ENVIO_CONT_NP = "sp_fecha_envio_cont_np";
    const SP_USER_ENVIO_CONT_NP = "sp_user_envio_cont_np";

    const SP_FECHA_AUTORIZA_VUELTA = "sp_fecha_autoriza_vuelta";
    const SP_USER_AUTORIZA_VUELTA = "sp_user_autoriza_vuelta";

    const SP_FECHA_PRECAPTURA = "sp_fecha_precaptura";

    const SP_ID_GPO_ENVIO_CONT_PRE_COMP = "sp_id_gpo_envio_cont_pre_comp";
    const SP_FECHA_ENVIO_CONT_PRE_COMP = "sp_fecha_envio_cont_pre_comp";
    const SP_USER_ENVIO_CONT_PRE_COMP = "sp_user_envio_cont_pre_comp";
    

    const SP_FECHA_ENVPRECAP = "sp_fecha_envprecap";
    const SP_USER_ENVPRECAP = "sp_user_envprecap";
    const SP_FECHA_RECIBE = "sp_fecha_recibe";
    const SP_USER_RECIBE = "sp_user_recibe";
    const SP_FECHA_LIBERA = "sp_fecha_libera";
    const SP_USER_LIBERA = "sp_user_libera";
    const SP_FECHA_PRECAPREC = "sp_fecha_precaprec";
    const SP_USER_PRECAPREC = "sp_user_precaprec";
    const SP_FECHA_PRECAPXREC =  "sp_fecha_precaxrec"; 
    const SP_USER_PRECAPXREC  = "sp_user_precaxrec";
    const SP_FECHA_CREADO = "sp_fechaCreado";
    const SP_FECHA_ENVCOMP = "sp_fecha_envcomp";
    const SP_USER_ENVCOMP = "sp_user_envcomp";
    const SP_ID_COMP = "sp_id_comp";
    //const SP_FECHA_CREADO = "sp_fecha_creado";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::SP_EJERCICIO,
        self::SP_ID,
        self::SP_ESTATUS,
        self::SP_TIPO_SOL,
        self::SP_CONCEPTO,
        self::PROV_ID,
        self::SP_PAGO_NOMBRE_DE,
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
        self::SP_VOBO_EMP_ID,
        self::SP_FECHA_PRECAPTURA,
        self::SP_FECHA_MODIFICA,
        self::SP_USER_MODIFICA,
        self::SP_ID_GPO_FIRMA_AUT_IDA,
        self::SP_SALDO,
        self::SP_DEVOLUCION_EFECTIVO,
        self::SP_ID_FOLIO_AFECTA,
        self::SP_EJERCICIO_AFECTA,
        self::SP_ID_GPO_FIRMA_AUT_VUELTA,
        self::SP_ID_GPO_FIRMA_AUT_VUELTA_GXC,
        self::SP_ID_GPO_GXC_ENT_CONTA,
        self::SP_ID_GPO_ENVIO_CONT_NP,
        self::SP_FECHA_ENVPRECAP,
        self::SP_USER_ENVPRECAP,
        self::SP_FECHA_RECIBE,
        self::SP_USER_RECIBE, 
        self::SP_FECHA_LIBERA,
        self::SP_USER_LIBERA, 
        self::SP_FECHA_ENVPRECAP,
        self::SP_USER_ENVPRECAP,
        self::SP_FECHA_RECIBE,
        self::SP_USER_RECIBE,
        self::SP_FECHA_LIBERA,
        self::SP_USER_LIBERA,
        self::SP_FECHA_PRECAPREC ,
        self::SP_USER_PRECAPREC,
        self::SP_FECHA_PRECAPXREC,
        self::SP_USER_PRECAPXREC,
        self::SP_FECHA_CREADO,
        self::SP_FECHA_ENVCOMP,
        self::SP_USER_ENVCOMP,
        self::SP_ID_COMP,
        self::OSNUMDOC,
        self::CONTRARECIBO,
    );

    const CAMPOS_PRECAPTURA = array(
        self::SP_EJERCICIO,
        self::SP_ID,
        self::SP_ESTATUS,
        self::SP_TIPO_SOL,
        self::SP_CONCEPTO,
        self::PROV_ID,
        self::SP_PAGO_NOMBRE_DE,
        self::CUECON_CUENTA,
        self::SP_DESCRIPCION,
        self::SP_OBSERVACION,
        self::SP_IMPORTE,
        self::SP_FUENTE_FIN,
        self::SP_EMP_ID_AUT,
        self::SP_EMP_ID_SOL,
        self::SP_DIRECCION_SOL,
        self::SP_VOBO_EMP_ID, 
        self::SP_FECHA_PRECAPTURA,
        //self::SP_USER_ELABORA,
       

    );

    const CAMPOS_EDITPRECAPTURA = array(
        self::SP_TIPO_SOL,
        self::SP_ESTATUS,
        self::SP_CONCEPTO,
        self::PROV_ID,
        self::SP_PAGO_NOMBRE_DE,
        self::CUECON_CUENTA,
        self::SP_DESCRIPCION,
        self::SP_OBSERVACION,
        self::SP_IMPORTE,
        self::SP_FECHA_SOLICITUD,
        self::SP_FUENTE_FIN,
        self::SP_EMP_ID_AUT,
        self::SP_EMP_ID_SOL,
        self::SP_DIRECCION_SOL,
        self::SP_VOBO_EMP_ID, 
        self::SP_FECHA_PRECAPTURA,
        //self::SP_USER_ELABORA,
       

    );

    const CAMPOS_FIRMA = array(
        self::SP_ID_GPO_FIRMA_SOL,
        self::SP_ESTATUS,
        self::SP_ID_GPO_FIRMA_AUT_IDA,
        self::SP_ID_GPO_FIRMA_AUT_VUELTA,

    );

    const CAMPOS_GXC = array(
        self::SP_ID_GPO_FIRMA_AUT_VUELTA_GXC,
        self::SP_ESTATUS,

    );

    const CAMPOS_PAGOS = array(
        self::SP_TIPO_PAGO,
        self::SP_NO_CUENTA_PAGO,
        self::SP_BANCO_PAGO,
        self::SP_NO_POLIZA_PAGO,
        self::SP_NO_FOLIO_PAGO,
        self::SP_ESTATUS,
        self::SP_FECHA_PAGO_CAP,

    );

    const CAMPOS_EJERCIDO = array(
        self::SP_POLIZA_EJERCIDO,
        self::SP_FOLIO_EJERCIDO,
        self::SP_FECHA_EJERCIDO_CAP,

    );
    const CAMPOS_XCANCELAR = array(
        self::SP_MOTIVO_POR_CANCELAR,
        self::SP_ESTATUS,
    );
    const CAMPOS_CANCELADO = array(
        self::SP_MOTIVO_CANCELACION,
        self::SP_ESTATUS,
        self::SP_FOLIO_CANCELA,
    );

    const CAMPOS_CAMBIA_ESTATUS = array(
        self::SP_MOTIVO_CANCELACION,
        self::SP_ESTATUS,
        self::SP_ID_GPO_FIRMA_AUT_VUELTA,
    );

    const CAMPOS_FOLIOS = array(
        self::SP_FOLIOS_COMPROMETIDO,
        self::SP_FOLIOS_DEVENGADO,
        self::SP_FOLIOS_DEVENGADO,
        self::SP_FOLIOS_DEVENGADO,

    );

    const CAMPOS_GPO_FOLIOS = array(
        self::SP_ID_GPO_FOLIOS,
    );

    const CAMPOS_GPO_ENT_CONTA = array(
        self::SP_ID_GPO_GXC_ENT_CONTA,
        self::SP_ESTATUS,
    );
    
    const CAMPOS_SALDO = array(
        self::SP_SALDO,
        self::SP_DEVOLUCION_EFECTIVO,
        self::SP_ID_FOLIO_AFECTA,
        self::SP_EJERCICIO_AFECTA,
    );

    const CAMPOS_GPO_EJERCIDO = array(
        self::SP_ID_GPO_EJERCIDO,
    );
    
    const CAMPOS_GPO_CONTANP = array(
        self::SP_ID_GPO_ENVIO_CONT_NP,
    );

    const CAMPOS_FOLCOMP = array(
        self::SP_FOLIO_COMPROBACION,
    );

    const CAMPOS_AUTVTA = array(
        self::SP_ESTATUS,
    );

    const CAMPOS_GPO_FOLIOS_COMP_PRE = array(
        self::SP_ID_GPO_ENVIO_CONT_PRE_COMP,
    );


        const SELECT_CREADO = "select s.sp_ejercicio, s.sp_id, s.sp_tipo_sol, ts.tipo_descripcion as nom_tipo_sol,
    s.sp_concepto, tc.tipo_descripcion as nom_concepto,
    s.prov_id, p.prov_razon_social, s.sp_pago_nombre_de,
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
    -- COMPROMETIDO y DEVENGADO
    s.sp_folio_ejercido,s.sp_poliza_ejercido, s.sp_fecha_ejercido_cap,s.sp_fecha_ejercido, s.sp_user_ejercido,ueje.usr_nombres as nombre_ejercido,
    s.sp_id_gpo_ejercido, sp_fecha_envia_ejercido, sp_user_envia_ejercido,uenveje.usr_nombres as nombre_envia_ejercido,
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
    s.sp_id_gpo_gxc_ent_conta, s.sp_fecha_gxc_ent_conta, s.sp_user_gxc_ent_conta, ufingxc.usr_nombres as nombre_usr_fingxc,
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
    s.osNumDoc
    from ";

    const INNER_CREADO = " s inner join tipo ts on s.sp_tipo_sol = ts.tipo_id
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
    left join usuario ufingxc on s.sp_user_gxc_ent_conta = ufingxc.usr_id
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

        //var_dump($peticion[0]);
        //var_dump($peticion[1]);

        switch ($peticion[0]) {
            case 'todos':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltro($peticion[1]);
                    }
                }
                return self::obtener($peticion[1],$peticion[2]);
                break;
            case 'creado':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerCreadoFiltro($peticion[1]);
                    }
                }
                return self::obtenerCreado($peticion[1],$peticion[2]);
                break;
            case 'sgteSolPag':
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
                break;                
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
            case 'crear':
                $id = self::crear($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
                break;
            case 'crearpre':
                $id = self::crearPreCaptura($idUsuario);
                http_response_code(201);
                return [
                    "estado" => self::CODIGO_EXITO,
                    "mensaje" => "¡Registro creado con éxito!",
                    "id" => $id
                ];
                break;       
            case 'creaRegistro':
                $id = self::crearRegistro($idUsuario);
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
                break;
            case 'gposolvta':
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
                break;      
            case 'estatusSol':
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
                    if (self::actualizarEstatusSolicitud($datos, $idUsuario) > 0) {
                        //if (self::eliminar($datos, $peticion[0]) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Registro actualizado correctamente"
                        ];
                    }
                    break;
             case 'estSolAct':
             $body = file_get_contents('php://input');
                $datos = json_decode($body);
               if (self::actualizarEstatusSol($datos, $peticion[1]) > 0) {
                   http_response_code(200);
                   return [
                       "estado" => self::CODIGO_EXITO,
                       "mensaje" => "Registro actualizado correctamente"
                   ];
               }
               throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambió", 200);
               break;                                            
    
        }
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

            if (self::actualizar($datos, $peticion[0], $idUsuario,$peticion[1]) > 0) {
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
            $body = file_get_contents('php://input');
            $datos = json_decode($body);

            if (self::eliminar($datos, $peticion[0], $idUsuario,$peticion[1]) > 0) {
                http_response_code(200);
                return array(
                    "estado" => 1,
                    "mensaje" => "La solicitud ha sido cancelada con exito"
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
    private static function obtenerCreado($id = null, $ejercicio =  null)
    {
        try {
            //$whereId = !empty($id) ? " WHERE " . self::SP_ID . "= :sp_id" : "";
            $whereId = !empty($id && $ejercicio) ? " WHERE " . self::SP_ID . "= :sp_id and " . self::SP_EJERCICIO . "= :sp_ejercicio" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT_CREADO . self::NOMBRE_TABLA . self::INNER_CREADO . $whereId . " order by sp_id desc";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id && $ejercicio)) {
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
    private static function obtenerCreadoFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'];
        $consulta = self::SELECT_CREADO . self::NOMBRE_TABLA . self::INNER_CREADO . $filtro['where'] . " order by sp_id desc";

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
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null,$ejercicio = null)
    {
        try {
            $whereId = !empty($id && $ejercicio) ? " WHERE " . self::SP_ID . "= :sp_id and " . self::SP_EJERCICIO . "= :sp_ejercicio" : "";

            $comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
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
            $Ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $spId = htmlspecialchars(strip_tags($datos->sp_id));

            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $Concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $pagoNombreDe = strip_tags($datos->sp_pago_nombre_de);
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $Descripcion = htmlspecialchars(strip_tags($datos->sp_descripcion));
            $Observacion = htmlspecialchars(strip_tags($datos->sp_observacion));
            $Importe = htmlspecialchars(strip_tags($datos->sp_importe));
            $fechaSolicitud = htmlspecialchars(strip_tags($datos->sp_fecha_solicitud));
            $folioComprobacion = htmlspecialchars(strip_tags($datos->sp_folio_comprobacion));
            $numOficio = htmlspecialchars(strip_tags($datos->sp_num_oficio));
            $fuenteFin = htmlspecialchars(strip_tags($datos->sp_fuente_fin));
            //$userElabora = htmlspecialchars(strip_tags($datos->sp_user_elabora));
            $noFactura = htmlspecialchars(strip_tags($datos->sp_no_factura));
            $fechaFactura = htmlspecialchars(strip_tags($datos->sp_fecha_factura));
            if ($fechaFactura == '') {
                $fechaFactura = NULL;
            }
            $fechaProbPago = htmlspecialchars(strip_tags($datos->sp_fecha_factura_prob_pago));
            if ($fechaProbPago == '') {
                $fechaProbPago = NULL;
            }
            $empIdAut = htmlspecialchars(strip_tags($datos->sp_emp_id_aut));
            $empIdSol = htmlspecialchars(strip_tags($datos->sp_emp_id_sol));
            $direccionSol = htmlspecialchars(strip_tags($datos->sp_direccion_sol));
            $voboEmpId = htmlspecialchars(strip_tags($datos->sp_vobo_emp_id));
            $Saldo = htmlspecialchars(strip_tags($datos->sp_saldo));
            $devolucionEfectivo = htmlspecialchars(strip_tags($datos->sp_devolucion_efectivo));
            $idFolioAfecta = htmlspecialchars(strip_tags($datos->sp_id_folio_afecta));
            $ejercicioAfecta = htmlspecialchars(strip_tags($datos->sp_ejercicio_afecta));



            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::SP_EJERCICIO . ", " .
                    self::SP_ID . ", " .
                    self::SP_TIPO_SOL . ", " .
                    self::SP_ESTATUS . ", " .
                    self::SP_CONCEPTO . ", " .
                    self::PROV_ID . ", " .
                    self::SP_PAGO_NOMBRE_DE . ", " .
                    self::CUECON_CUENTA . ", " .
                    self::SP_DESCRIPCION . ", " .
                    self::SP_OBSERVACION . ", " .
                    self::SP_IMPORTE . ", " .
                    self::SP_FECHA_SOLICITUD . ", " .
                    self::SP_FOLIO_COMPROBACION . ", " .
                    self::SP_NUM_OFICIO . ", " .
                    self::SP_FUENTE_FIN . ", " .
                    self::SP_USER_ELABORA . ", " .
                    self::SP_FECHA_ELABORA . ", " .
                    self::SP_NO_FACTURA . ", " .
                    self::SP_FECHA_FACTURA . ", " .
                    self::SP_FECHA_FACTURA_PROB_PAGO . ", " .
                    self::SP_EMP_ID_AUT . ", " .
                    self::SP_EMP_ID_SOL . ", " .
                    self::SP_DIRECCION_SOL . ", " .
                    self::SP_VOBO_EMP_ID . ", " .
                    self::SP_SALDO . ", " .
                    self::SP_DEVOLUCION_EFECTIVO . ", " .
                    self::SP_ID_FOLIO_AFECTA . ", " .
                    self::SP_EJERCICIO_AFECTA . ")" .
                    " VALUES(:sp_ejercicio,:sp_id,:sp_tipo_sol,:sp_estatus,:sp_concepto,:prov_id,:sp_pago_nombre_de,:cuecon_cuenta,:sp_descripcion,:sp_observacion," .
                    ":sp_importe,:sp_fecha_solicitud,:sp_folio_comprobacion,:sp_num_oficio,:sp_fuente_fin,:sp_user_elabora," .
                    "CURRENT_TIMESTAMP(6),:sp_no_factura,:sp_fecha_factura,:sp_fecha_factura_prob_pago,:sp_emp_id_aut,:sp_emp_id_sol," .
                    ":sp_direccion_sol,:sp_vobo_emp_id,:sp_saldo,:sp_devolucion_efectivo,:sp_id_folio_afecta,:sp_ejercicio_afecta)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":sp_ejercicio", $Ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $spId, PDO::PARAM_INT);

                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_concepto", $Concepto, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_pago_nombre_de", $pagoNombreDe, PDO::PARAM_STR);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_descripcion", $Descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_observacion", $Observacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_solicitud", $fechaSolicitud, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_folio_comprobacion", $folioComprobacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_num_oficio", $numOficio, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fuente_fin", $fuenteFin, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_user_elabora", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_no_factura", $noFactura, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_factura", $fechaFactura, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_factura_prob_pago", $fechaProbPago, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_emp_id_aut", $empIdAut, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_emp_id_sol", $empIdSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_direccion_sol", $direccionSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_vobo_emp_id", $voboEmpId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_saldo", $Saldo, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_devolucion_efectivo", $devolucionEfectivo, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id_folio_afecta", $idFolioAfecta, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio_afecta", $ejercicioAfecta, PDO::PARAM_INT);


                //$sentencia->bindParam(":retencion_creado_por", $CreadoPor, PDO::PARAM_INT);
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
    private static function actualizar($datos, $id, $idUsuario,$ejercicio)
    {
        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $Concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $pagoNombreDe = strip_tags($datos->sp_pago_nombre_de);
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $Descripcion = htmlspecialchars(strip_tags($datos->sp_descripcion));
            $Observacion = htmlspecialchars(strip_tags($datos->sp_observacion));
            $Importe = htmlspecialchars(strip_tags($datos->sp_importe));
            $fechaSolicitud = htmlspecialchars(strip_tags($datos->sp_fecha_solicitud));
            $folioComprobacion = htmlspecialchars(strip_tags($datos->sp_folio_comprobacion));
            $numOficio = htmlspecialchars(strip_tags($datos->sp_num_oficio));
            $fuenteFin = htmlspecialchars(strip_tags($datos->sp_fuente_fin));
            //$userElabora = htmlspecialchars(strip_tags($datos->sp_user_elabora));
            $noFactura = htmlspecialchars(strip_tags($datos->sp_no_factura));
            $fechaFactura = htmlspecialchars(strip_tags($datos->sp_fecha_factura));
            if ($fechaFactura == '') {
                $fechaFactura = NULL;
            }
            //$fechaPrecaptura = htmlspecialchars(strip_tags($datos->sp_fecha_precaptura));
            $fechaProbPago = htmlspecialchars(strip_tags($datos->sp_fecha_factura_prob_pago));
            if ($fechaProbPago == '') {
                $fechaProbPago = NULL;
            }
            $empIdAut = htmlspecialchars(strip_tags($datos->sp_emp_id_aut));
            $empIdSol = htmlspecialchars(strip_tags($datos->sp_emp_id_sol));
            $direccionSol = htmlspecialchars(strip_tags($datos->sp_direccion_sol));
            $voboEmpId = htmlspecialchars(strip_tags($datos->sp_vobo_emp_id));
            $Saldo = htmlspecialchars(strip_tags($datos->sp_saldo));
            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_TIPO_SOL . "= :sp_tipo_sol, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_CONCEPTO . "= :sp_concepto, " .
                    self::PROV_ID . "= :prov_id, " .
                    self::SP_PAGO_NOMBRE_DE . "= :sp_pago_nombre_de, " .
                    self::CUECON_CUENTA . "= :cuecon_cuenta, " .
                    self::SP_DESCRIPCION . "= :sp_descripcion, " .
                    self::SP_OBSERVACION . "= :sp_observacion, " .
                    self::SP_IMPORTE . "= :sp_importe, " .
                    self::SP_FECHA_SOLICITUD . "= :sp_fecha_solicitud, " .
                    self::SP_FOLIO_COMPROBACION . "= :sp_folio_comprobacion, " .
                    self::SP_NUM_OFICIO . "= :sp_num_oficio, " .
                    self::SP_FUENTE_FIN . "= :sp_fuente_fin, " .
                    self::SP_NO_FACTURA . "= :sp_no_factura, " .
                    self::SP_FECHA_FACTURA . "= :sp_fecha_factura, " .
                    self::SP_FECHA_FACTURA_PROB_PAGO . "= :sp_fecha_factura_prob_pago, " .
                    self::SP_EMP_ID_AUT . "= :sp_emp_id_aut, " .
                    self::SP_EMP_ID_SOL . "= :sp_emp_id_sol, " .
                    self::SP_DIRECCION_SOL . "= :sp_direccion_sol, " .
                    self::SP_VOBO_EMP_ID . "= :sp_vobo_emp_id, " .
                    self::SP_FECHA_MODIFICA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_MODIFICA . "= :sp_user_modifica, " .
                    self::SP_SALDO . "= :sp_saldo " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_concepto", $Concepto, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_pago_nombre_de", $pagoNombreDe, PDO::PARAM_STR);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_descripcion", $Descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_observacion", $Observacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_solicitud", $fechaSolicitud, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_folio_comprobacion", $folioComprobacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_num_oficio", $numOficio, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fuente_fin", $fuenteFin, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_no_factura", $noFactura, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_factura", $fechaFactura, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_factura_prob_pago", $fechaProbPago, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_emp_id_aut", $empIdAut, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_emp_id_sol", $empIdSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_direccion_sol", $direccionSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_vobo_emp_id", $voboEmpId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_saldo", $Saldo, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_user_modifica", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
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
    private static function eliminar($datos, $id, $idUsuario)
    {
        $recMotivoCancela = htmlspecialchars(strip_tags($datos->rec_motivo_cancela));
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::REC_ESTATUS . " = 'CAN', " .
            self::REC_MOTIVO_CANCELA . "= :rec_motivo_cancela, " .
            self::REC_USER_CANCELA . "= :rec_user_cancela, " .
            self::REC_FECHA_CANCELA . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::REC_ID . " = :rec_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":rec_motivo_cancela", $recMotivoCancela, PDO::PARAM_STR);
            $sentencia->bindParam(":rec_id", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":rec_user_cancela", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Obtiene uno o varios registros de retencion de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la retencion que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function siguienteGrupo($opcion)
    {
        try {
            switch ($opcion) {
                case 'sgteGpoFirmaSol':
                    $comando = "select sgteGpoFirmaSol() as sgteGpoFirmaSol;";
                    break;
                case 'sgteGpoFirmaAut':
                    $comando = "select sgteGpoFirmaAut() as sgteGpoFirmaAut;";
                    break;
                case 'sgteGpoPagos':
                    $comando = "select sgteGpoPagos() as sgteGpoPagos;";
                    break;
                case 'sgteGpoGastosxComp':
                    $comando = "select sgteGpoGastosxComp() as sgteGpoGastosxComp;";
                    break;
                case 'sgteGpoFolios':
                    $comando = "select sgteGpoFolios() as sgteGpoFolios;";
                    break;
                case 'sgteGpoGxcEntCont':
                    $comando = "select sgteGpoGxcEntCont() as sgteGpoGxcEntCont;";
                    break;
                case 'sgteGpoEjercidos':
                    $comando = "select sgteGpoEjercidos() as sgteGpoEjercidos;";
                    break;
                case 'sgteGpoContaNp':
                    $comando = "select sgteGpoContNP() as sgteGpoContNP;";
                    break;
                case 'sgteGpoFoliosCompPre':
                    $comando = "select sgteGpoFoliosCompPre() as sgteGpoFoliosCompPre;";
                    break;
    
            }

            //$whereId = !empty($id) ? " WHERE " . self::SP_ID . "= :sp_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            //$comando = self::SELECT_CREADO . self::NOMBRE_TABLA . self::INNER_CREADO . $whereId;
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            //$mensaje .= !empty($id) ? " con ese Id" : " en la tabla: " .  self::NOMBRE_TABLA;

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
    private static function siguienteFolio($opcion, $ejercicio)
    {
        try {
            
            //var_dump($opcion);
            //var_dump($ejercicio);

            switch ($opcion) {
                case 'sgteSolPag':
                    $comando = "select sgteSolPag(" . $ejercicio . ") as sgteSolPag;";
                    break;
                 /*case 'sgteGpoFirmaAut':
                    $comando = "select sgteGpoFirmaAut() as sgteGpoFirmaAut;";
                    break;
                */    
    
            }

            //$whereId = !empty($id) ? " WHERE " . self::SP_ID . "= :sp_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            //$comando = self::SELECT_CREADO . self::NOMBRE_TABLA . self::INNER_CREADO . $whereId;
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            //$mensaje .= !empty($id) ? " con ese Id" : " en la tabla: " .  self::NOMBRE_TABLA;

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }
    /**
     * Actualiza la información de un tipo
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoFirmaSolicitudIda($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FIRMA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $idgpofirmasol = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_sol));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_FIRMA_SOL . "= :sp_id_gpo_firma_sol, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_FIRMA_SOL_IDA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_FIRMA_SOL_IDA . "= :sp_user_firma_sol_ida " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_firma_sol", $idgpofirmasol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_firma_sol_ida", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
    private static function GpoFirmaSolicitudVta($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FIRMA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            //$idgpofirmasol = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_sol));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_FIRMA_SOL_VUELTA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_FIRMA_SOL_VUELTA . "= :sp_user_firma_sol_vuelta " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                //$sentencia->bindParam(":sp_id_gpo_firma_sol", $idgpofirmasol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_firma_sol_vuelta", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * GpoFirmaAutorizaIda
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoFirmaAutorizaIda($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FIRMA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoFirmaAut = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_aut_ida));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_FIRMA_AUT_IDA . "= :sp_id_gpo_firma_aut_ida, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_FIRMA_AUT_IDA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_FIRMA_AUT_IDA . "= :sp_user_firma_aut_ida " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_firma_aut_ida", $gpoFirmaAut, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_firma_aut_ida", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * GpoEnviaPagos
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaPagos($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FIRMA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_aut_vuelta));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_FIRMA_AUT_VUELTA . "= :sp_id_gpo_firma_aut_vuelta, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_FIRMA_AUT_VUELTA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_FIRMA_AUT_VUELTA . "= :sp_user_firma_aut_vuelta " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_firma_aut_vuelta", $gpoId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_firma_aut_vuelta", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * GpoEnviaGastos
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaGastos($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_GXC;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_aut_vuelta_gxc));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_FIRMA_AUT_VUELTA_GXC . "= :sp_id_gpo_firma_aut_vuelta_gxc, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_CONTA_GASXCOMP . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_CONTA_GASXCOMP . "= :sp_user_conta_gasxcomp " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_firma_aut_vuelta_gxc", $gpoId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_conta_gasxcomp", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * Pagos
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function Pagos($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_PAGOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $tipoPago = htmlspecialchars(strip_tags($datos->sp_tipo_pago));
            $noCuentaPago = htmlspecialchars(strip_tags($datos->sp_no_cuenta_pago));
            $bancoPago = htmlspecialchars(strip_tags($datos->sp_banco_pago));
            $noPolizaPago = htmlspecialchars(strip_tags($datos->sp_no_poliza_pago));
            $noFolioPago = htmlspecialchars(strip_tags($datos->sp_no_folio_pago));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $fechaPagoCap = htmlspecialchars(strip_tags($datos->sp_fecha_pago_cap));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_TIPO_PAGO . "= :sp_tipo_pago, " .
                    self::SP_NO_CUENTA_PAGO . "= :sp_no_cuenta_pago, " .
                    self::SP_BANCO_PAGO . "= :sp_banco_pago, " .
                    self::SP_NO_POLIZA_PAGO . "= :sp_no_poliza_pago, " .
                    self::SP_NO_FOLIO_PAGO . "= :sp_no_folio_pago, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_PAGO_CAP . "= :sp_fecha_pago_cap, " .
                    self::SP_FECHA_PAGO . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_PAGO . "= :sp_user_pago " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_tipo_pago", $tipoPago, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_no_cuenta_pago", $noCuentaPago, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_banco_pago", $bancoPago, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_no_poliza_pago", $noPolizaPago, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_no_folio_pago", $noFolioPago, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_pago_cap", $fechaPagoCap, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_pago", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * ejercido
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function ejercido($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_EJERCIDO;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $polizaEjercido = htmlspecialchars(strip_tags($datos->sp_poliza_ejercido));
            $folioEjercido = htmlspecialchars(strip_tags($datos->sp_folio_ejercido));
            $fechaEjercidoCap = htmlspecialchars(strip_tags($datos->sp_fecha_ejercido_cap));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_POLIZA_EJERCIDO . "= :sp_poliza_ejercido, " .
                    self::SP_FOLIO_EJERCIDO . "= :sp_folio_ejercido, " .
                    self::SP_FECHA_EJERCIDO_CAP . "= :sp_fecha_ejercido_cap, " .
                    self::SP_FECHA_EJERCIDO . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_EJERCIDO . "= :sp_user_ejercido " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_poliza_ejercido", $polizaEjercido, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_folio_ejercido", $folioEjercido, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_ejercido", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_fecha_ejercido_cap", $fechaEjercidoCap, PDO::PARAM_STR);
                //var_dump($sentencia);

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
     * xcancelar
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function xcancelar($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_XCANCELAR;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $motivoCancelacion = htmlspecialchars(strip_tags($datos->sp_motivo_por_cancelar));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_MOTIVO_POR_CANCELAR . "= :sp_motivo_por_cancelar, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_POR_CANCELAR . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_POR_CANCELAR . "= :sp_user_por_cancelar " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_motivo_por_cancelar", $motivoCancelacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_por_cancelar", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                //var_dump($sentencia);

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
     * cancelado
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function cancelado($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_CANCELADO;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $motivoCancelacion = htmlspecialchars(strip_tags($datos->sp_motivo_cancelacion));
            $folioCancela = htmlspecialchars(strip_tags($datos->sp_folio_cancela));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_MOTIVO_CANCELACION . "= :sp_motivo_cancelacion, " .
                    self::SP_FOLIO_CANCELA . "= :sp_folio_cancela, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_CANCELACION . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_CANCELACION . "= :sp_user_cancelacion " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_motivo_cancelacion", $motivoCancelacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_folio_cancela", $folioCancela, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_cancelacion", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                //var_dump($sentencia);

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
        //
        /**
     * cambiaestatus
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function cambiaestatus($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_CAMBIA_ESTATUS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $motivoCancelacion = htmlspecialchars(strip_tags($datos->sp_motivo_cancelacion));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_MOTIVO_CANCELACION . "= :sp_motivo_cancelacion, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_ID_GPO_FIRMA_AUT_VUELTA . "= 0, " .
                    self::SP_FECHA_MODIFICA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_MODIFICA . "= :sp_user_modifica " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_motivo_cancelacion", $motivoCancelacion, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_folio_cancela", $folioCancela, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_modifica", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                //var_dump($sentencia);

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
    /*
    * actualizafolios
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizafolios($datos, $id, $idUsuario)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FOLIOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $foliosComprometido = htmlspecialchars(strip_tags($datos->sp_folios_comprometido));
            $foliosDevengado = htmlspecialchars(strip_tags($datos->sp_folios_devengado));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_FOLIOS_COMPROMETIDO . "= :sp_folios_comprometido, " .
                    self::SP_FOLIOS_DEVENGADO . "= :sp_folios_devengado, " .
                    self::SP_FECHA_FOLIOS . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_FOLIOS . "= :sp_user_folios " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_folios_comprometido", $foliosComprometido, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_folios_devengado", $foliosDevengado, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_folios", $ModificadPor, PDO::PARAM_INT);
                
                //var_dump($sentencia);

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
     * GpoEnviaFolios
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaFolios($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_GPO_FOLIOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_folios));
            //$Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_FOLIOS . "= :sp_id_gpo_folios, " .
                    self::SP_FECHA_GPO_FOLIOS . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_GPO_FOLIOS . "= :sp_user_gpo_folios " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_folios", $gpoId, PDO::PARAM_INT);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_gpo_folios", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * GpoEnviaContaGxC
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaContaGxC($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_GPO_ENT_CONTA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_gxc_ent_conta));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_GXC_ENT_CONTA . "= :sp_id_gpo_gxc_ent_conta, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_GXC_ENT_CONTA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_GXC_ENT_CONTA . "= :sp_user_gxc_ent_conta " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_gxc_ent_conta", $gpoId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_gxc_ent_conta", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
    /*
    * actualizacasosesp
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizaSaldo($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_SALDO;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $Saldo = htmlspecialchars(strip_tags($datos->sp_saldo));
            $devolucionEfectivo = htmlspecialchars(strip_tags($datos->sp_devolucion_efectivo));
            $idFolioAfecta = htmlspecialchars(strip_tags($datos->sp_id_folio_afecta));
            $ejercicioAfecta = htmlspecialchars(strip_tags($datos->sp_ejercicio_afecta));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_SALDO . "= :sp_saldo, " .
                    self::SP_DEVOLUCION_EFECTIVO . "= :sp_devolucion_efectivo, " .
                    self::SP_ID_FOLIO_AFECTA . "= :sp_id_folio_afecta, " .
                    self::SP_EJERCICIO_AFECTA . "= :sp_ejercicio_afecta " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_saldo", $Saldo, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_devolucion_efectivo", $devolucionEfectivo, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id_folio_afecta", $idFolioAfecta, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio_afecta", $ejercicioAfecta, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                
                //var_dump($sentencia);

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
    /*
    * actualizacasosesp
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizafolcomp($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_FOLCOMP;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $folioComprobacion = htmlspecialchars(strip_tags($datos->sp_folio_comprobacion));
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_FOLIO_COMPROBACION . "= :sp_folio_comprobacion " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_folio_comprobacion", $folioComprobacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                
                //var_dump($sentencia);

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
     * GpoEnviaEjercido
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaEjercido($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_GPO_EJERCIDO;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_ejercido));
            //$Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_EJERCIDO . "= :sp_id_gpo_ejercido, " .
                    self::SP_FECHA_ENVIA_EJERCIDO . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_ENVIA_EJERCIDO . "= :sp_user_envia_ejercido " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_ejercido", $gpoId, PDO::PARAM_INT);
                //$sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_envia_ejercido", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * GpoEnviaContaNp
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaContaNp($datos, $id, $idUsuario,$ejercicio)
    {
        if ($datos) {
            $campos = self::CAMPOS_GPO_CONTANP;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_envio_cont_np));
            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_ENVIO_CONT_NP . "= :sp_id_gpo_envio_cont_np, " .
                    self::SP_FECHA_ENVIO_CONT_NP . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_ENVIO_CONT_NP . "= :sp_user_envio_cont_np " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_envio_cont_np", $gpoId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_envio_cont_np", $ModificadPor, PDO::PARAM_INT);

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
     * GpoAutorizaVta
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoAutorizaVta($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_AUTVTA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            //$idgpofirmasol = htmlspecialchars(strip_tags($datos->sp_id_gpo_firma_sol));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_FECHA_AUTORIZA_VUELTA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_AUTORIZA_VUELTA . "= :sp_user_autoriza_vuelta " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                //$sentencia->bindParam(":sp_id_gpo_firma_sol", $idgpofirmasol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_autoriza_vuelta", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
     * Crea un retencion en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la retencion
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crearPreCaptura($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        //var_dump( crearPreCaptura);
        if ($datos) {
            $campos = self::CAMPOS_PRECAPTURA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //var_dump($campos);
            //Sanitiza los campos recibidos
            $Ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $spId = htmlspecialchars(strip_tags($datos->sp_id));
            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $Concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $pagoNombreDe = strip_tags($datos->sp_pago_nombre_de);
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $Descripcion = htmlspecialchars(strip_tags($datos->sp_descripcion));
            $Observacion = htmlspecialchars(strip_tags($datos->sp_observacion));
            $Importe = htmlspecialchars(strip_tags($datos->sp_importe));
            //$sp_fecha_precaptura = htmlspecialchars(strip_tags($datos->sp_fecha_precaptura));
            if (isset($datos->sp_fecha_precaptura)) {
    $sp_fecha_precaptura = htmlspecialchars(strip_tags($datos->sp_fecha_precaptura));
} else {
    $sp_fecha_precaptura = NULL;
}
            //$fechaSolicitud = htmlspecialchars(strip_tags($datos->sp_fecha_solicitud));
            //$folioComprobacion = htmlspecialchars(strip_tags($datos->sp_folio_comprobacion));
            //$numOficio = htmlspecialchars(strip_tags($datos->sp_num_oficio));
            $fuenteFin = htmlspecialchars(strip_tags($datos->sp_fuente_fin));
            //$noFactura = htmlspecialchars(strip_tags($datos->sp_no_factura));
            //$fechaFactura = htmlspecialchars(strip_tags($datos->sp_fecha_factura));

            /* if ($fechaFactura == '') {
                $fechaFactura = NULL;
            }
            $fechaProbPago = htmlspecialchars(strip_tags($datos->sp_fecha_factura_prob_pago));
            if ($fechaProbPago == '') {
                $fechaProbPago = NULL;
            } */
            $empIdAut = htmlspecialchars(strip_tags($datos->sp_emp_id_aut));
            $empIdSol = htmlspecialchars(strip_tags($datos->sp_emp_id_sol));
            $direccionSol = htmlspecialchars(strip_tags($datos->sp_direccion_sol));
            $voboEmpId = htmlspecialchars(strip_tags($datos->sp_vobo_emp_id));
            //$Saldo = htmlspecialchars(strip_tags($datos->sp_saldo));
            //$devolucionEfectivo = htmlspecialchars(strip_tags($datos->sp_devolucion_efectivo));
            //$idFolioAfecta = htmlspecialchars(strip_tags($datos->sp_id_folio_afecta));
            //$ejercicioAfecta = htmlspecialchars(strip_tags($datos->sp_ejercicio_afecta));


            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::SP_EJERCICIO . ", " .
                    self::SP_ID . ", " .
                    self::SP_TIPO_SOL . ", " .
                    self::SP_ESTATUS . ", " .
                    self::SP_CONCEPTO . ", " .
                    self::PROV_ID . ", " .
                    self::SP_PAGO_NOMBRE_DE . ", " .
                    self::CUECON_CUENTA . ", " .
                    self::SP_DESCRIPCION . ", " .
                    self::SP_OBSERVACION . ", " .
                    self::SP_IMPORTE . ", " .
                    self::SP_FECHA_PRECAPTURA . ", " .
                    self::SP_FECHA_SOLICITUD . ", " .
                    self::SP_FUENTE_FIN . ", " .
                    self::SP_USER_ELABORA . ", " .
                    self::SP_FECHA_ELABORA . ", " .
                    self::SP_EMP_ID_AUT . ", " .
                    self::SP_EMP_ID_SOL . ", " .
                    self::SP_DIRECCION_SOL . ", " .
                    self::SP_VOBO_EMP_ID . ")" .
                    " VALUES(:sp_ejercicio,:sp_id,:sp_tipo_sol,:sp_estatus,:sp_concepto,".
                    ":prov_id,:sp_pago_nombre_de,:cuecon_cuenta,:sp_descripcion,:sp_observacion," .
                    ":sp_importe,:sp_fecha_precaptura,CURRENT_TIMESTAMP(6),:sp_fuente_fin,:sp_user_elabora," .
                    "CURRENT_TIMESTAMP(6),:sp_emp_id_aut,:sp_emp_id_sol," .
                    ":sp_direccion_sol,:sp_vobo_emp_id)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":sp_ejercicio", $Ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $spId, PDO::PARAM_INT);

                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_concepto", $Concepto, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_pago_nombre_de", $pagoNombreDe, PDO::PARAM_STR);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_descripcion", $Descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_observacion", $Observacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fuente_fin", $fuenteFin, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_user_elabora", $CreadoPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_emp_id_aut", $empIdAut, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_emp_id_sol", $empIdSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_direccion_sol", $direccionSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_vobo_emp_id", $voboEmpId, PDO::PARAM_INT);
                //$sentencia->bindParam(":sp_fecha_precaptura", $sp_fecha_precaptura, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_precaptura", $sp_fecha_precaptura, ($sp_fecha_precaptura === NULL) ? PDO::PARAM_NULL : PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_fecha_solicitud", $fechaSolicitud, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_folio_comprobacion", $folioComprobacion, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_num_oficio", $numOficio, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_no_factura", $noFactura, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_fecha_factura", $fechaFactura, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_fecha_factura_prob_pago", $fechaProbPago, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_saldo", $Saldo, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_devolucion_efectivo", $devolucionEfectivo, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_id_folio_afecta", $idFolioAfecta, PDO::PARAM_INT);
                //$sentencia->bindParam(":sp_ejercicio_afecta", $ejercicioAfecta, PDO::PARAM_INT);


                //$sentencia->bindParam(":retencion_creado_por", $CreadoPor, PDO::PARAM_INT);
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
     * actualizaPreCap la información de PreCaptura     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function actualizaPreCap($datos, $id, $idUsuario,$ejercicio)
    {
        if ($datos) {
            //var_dump($datos);
            $campos = self::CAMPOS_EDITPRECAPTURA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $tipoSol = htmlspecialchars(strip_tags($datos->sp_tipo_sol));
            $Concepto = htmlspecialchars(strip_tags($datos->sp_concepto));
            $provId = htmlspecialchars(strip_tags($datos->prov_id));
            $pagoNombreDe = strip_tags($datos->sp_pago_nombre_de);
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $Descripcion = htmlspecialchars(strip_tags($datos->sp_descripcion));
            $Observacion = htmlspecialchars(strip_tags($datos->sp_observacion));
            $Importe = htmlspecialchars(strip_tags($datos->sp_importe));
            $fechaSolicitud = htmlspecialchars(strip_tags($datos->sp_fecha_solicitud));
            $fuenteFin = htmlspecialchars(strip_tags($datos->sp_fuente_fin));
            $empIdAut = htmlspecialchars(strip_tags($datos->sp_emp_id_aut));
            $empIdSol = htmlspecialchars(strip_tags($datos->sp_emp_id_sol));
            $direccionSol = htmlspecialchars(strip_tags($datos->sp_direccion_sol));
            $voboEmpId = htmlspecialchars(strip_tags($datos->sp_vobo_emp_id));
            //$sp_fecha_precaptura = htmlspecialchars(strip_tags($datos->sp_fecha_precaptura));
            /* if ($sp_fecha_precaptura == '') {
                $sp_fecha_precaptura = NULL;
            }*/
            $ModificadPor = $idUsuario;

            //var_dump( $fechaSolicitud);
            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_TIPO_SOL . "= :sp_tipo_sol, " .
                    self::SP_ESTATUS . "= :sp_estatus, " .
                    self::SP_CONCEPTO . "= :sp_concepto, " .
                    self::PROV_ID . "= :prov_id, " .
                    self::SP_PAGO_NOMBRE_DE . "= :sp_pago_nombre_de, " .
                    self::CUECON_CUENTA . "= :cuecon_cuenta, " .
                    self::SP_DESCRIPCION . "= :sp_descripcion, " .
                    self::SP_OBSERVACION . "= :sp_observacion, " .
                    self::SP_IMPORTE . "= :sp_importe, " .
                    self::SP_FECHA_SOLICITUD . "= :sp_fecha_solicitud, " .
                    self::SP_FUENTE_FIN . "= :sp_fuente_fin, " .
                    self::SP_EMP_ID_AUT . "= :sp_emp_id_aut, " .
                    self::SP_EMP_ID_SOL . "= :sp_emp_id_sol, " .
                    self::SP_DIRECCION_SOL . "= :sp_direccion_sol, " .
                    self::SP_VOBO_EMP_ID . "= :sp_vobo_emp_id, " .
                    self::SP_FECHA_MODIFICA . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_MODIFICA . "= :sp_user_modifica " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_tipo_sol", $tipoSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_concepto", $Concepto, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_estatus", $Estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_id", $provId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_pago_nombre_de", $pagoNombreDe, PDO::PARAM_STR);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_descripcion", $Descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_observacion", $Observacion, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_importe", $Importe, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fecha_solicitud", $fechaSolicitud, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_folio_comprobacion", $folioComprobacion, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_num_oficio", $numOficio, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_fuente_fin", $fuenteFin, PDO::PARAM_STR);

                //$sentencia->bindParam(":sp_no_factura", $noFactura, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_fecha_factura", $fechaFactura, PDO::PARAM_STR);
                //$sentencia->bindParam(":sp_fecha_factura_prob_pago", $fechaProbPago, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_emp_id_aut", $empIdAut, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_emp_id_sol", $empIdSol, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_direccion_sol", $direccionSol, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_vobo_emp_id", $voboEmpId, PDO::PARAM_INT);


                //$sentencia->bindParam(":sp_saldo", $Saldo, PDO::PARAM_STR);

                $sentencia->bindParam(":sp_user_modifica", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
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
     * GpoEnviaFoliosCompPre
     *
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea actualizarse
     * @param [integer] $idTipo Contiene el id del tipo que desea actualizarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function GpoEnviaFoliosCompPre($datos, $id, $idUsuario,$ejercicio)
    {
        //var_dump($idUsuario);
        if ($datos) {
            $campos = self::CAMPOS_GPO_FOLIOS_COMP_PRE;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $gpoId = htmlspecialchars(strip_tags($datos->sp_id_gpo_envio_cont_pre_comp));
            //$Estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            //$Estatus = "SOLFIRIDA";
            $ModificadPor = $idUsuario;
            //var_dump($idgpofirmasol, $Estatus, $ModificadPor);

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::SP_ID_GPO_ENVIO_CONT_PRE_COMP . "= :sp_id_gpo_envio_cont_pre_comp, " .
                    self::SP_FECHA_ENVIO_CONT_PRE_COMP . "= CURRENT_TIMESTAMP(6), " .
                    self::SP_USER_ENVIO_CONT_PRE_COMP . "= :sp_user_envio_cont_pre_comp " .
                    " WHERE " . self::SP_ID . "= :sp_id AND " . self::SP_EJERCICIO . "= :sp_ejercicio"  ;
                    //" WHERE " . self::SP_ID . "= :sp_id";


                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_id_gpo_envio_cont_pre_comp", $gpoId, PDO::PARAM_INT);

                $sentencia->bindParam(":sp_id", $id, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_user_envio_cont_pre_comp", $ModificadPor, PDO::PARAM_INT);
                //var_dump($sentencia);

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
    private static function actualizarEstatusSolicitud($datos, $idUsuario)
    {

        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $sp_estatus = htmlspecialchars(strip_tags($datos->sp_estatus));
            $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $sp_id = htmlspecialchars(strip_tags($datos->sp_id)); 
           // $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::SP_ESTATUS . " = :sp_estatus " .
           " WHERE " . self::SP_ID . " = :sp_id AND " .
            self::SP_EJERCICIO . " = :sp_ejercicio";

            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":sp_estatus", $sp_estatus, PDO::PARAM_STR);
                $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }
      public static function actualizarEstatusSol($datos, $peticion)
{
    if ($datos) {

        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        $sp_id = htmlspecialchars(strip_tags($datos->sp_id));
        $sp_ejercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
      
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
            $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::SP_ID . " = :sp_id AND " . self::SP_EJERCICIO . " = :sp_ejercicio)";

            // Preparar la sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

            // Bind de los parámetros
            foreach ($bindParams as $param => &$value) {
                $sentencia->bindParam($param, $value, PDO::PARAM_STR);
            }

            $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
            $sentencia->bindParam(":sp_ejercicio", $sp_ejercicio, PDO::PARAM_INT);

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
//CREAR UN REGISTRO NUEVO SOLO CON LOS CAMPOS QUE FUERON ENVIADOS
private static function crearRegistro($idUsuario)
{
    $body = file_get_contents('php://input');
    $datos = json_decode($body);

    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        // Define los campos permitidos y sus valores predeterminados
        $camposPermitidos = [
                self::SP_EJERCICIO => null,
                self::SP_ID => null,
                self::SP_ESTATUS => null,
                self::SP_TIPO_SOL => null,
                self::SP_CONCEPTO => null,
                self::PROV_ID => null,
                self::SP_PAGO_NOMBRE_DE => null,
                self::CUECON_CUENTA => null,
                self::SP_DESCRIPCION => null,
                self::SP_OBSERVACION => null,
                self::SP_IMPORTE => null,
                self::SP_FECHA_SOLICITUD => null,
                self::SP_FOLIO_COMPROBACION => null,
                self::SP_NUM_OFICIO => null,
                self::SP_FUENTE_FIN => null,
                self::SP_USER_ELABORA => null,
                self::SP_FECHA_ELABORA => null,
                self::SP_NO_FACTURA => null,
                self::SP_FECHA_FACTURA => null,
                self::SP_FECHA_FACTURA_PROB_PAGO => null,
                self::SP_EMP_ID_AUT => null,
                self::SP_EMP_ID_SOL => null,
                self::SP_DIRECCION_SOL => null,
                self::SP_VOBO_EMP_ID => null,
                self::SP_FECHA_PRECAPTURA => null,
                self::SP_FECHA_MODIFICA => null,
                self::SP_USER_MODIFICA => null,
                self::SP_ID_GPO_FIRMA_AUT_IDA => null,
                self::SP_SALDO => null,
                self::SP_DEVOLUCION_EFECTIVO => null,
                self::SP_ID_FOLIO_AFECTA => null,
                self::SP_EJERCICIO_AFECTA => null,
                self::SP_ID_GPO_FIRMA_AUT_VUELTA => null,
                self::SP_ID_GPO_FIRMA_AUT_VUELTA_GXC => null,
                self::SP_ID_GPO_GXC_ENT_CONTA => null,
                self::SP_ID_GPO_ENVIO_CONT_NP => null,
                self::SP_FECHA_ENVPRECAP => null,
                self::SP_USER_ENVPRECAP => null,
                self::SP_FECHA_RECIBE => null,
                self::SP_USER_RECIBE => null,
                self::SP_FECHA_LIBERA => null,
                self::SP_USER_LIBERA => null,
                self::SP_FECHA_ENVPRECAP => null,
                self::SP_USER_ENVPRECAP => null,
                self::SP_FECHA_RECIBE => null,
                self::SP_USER_RECIBE => null,
                self::SP_FECHA_LIBERA => null,
                self::SP_USER_LIBERA => null,
                self::SP_FECHA_PRECAPREC  => null,
                self::SP_USER_PRECAPREC => null,
                self::SP_FECHA_PRECAPXREC => null,
                self::SP_USER_PRECAPXREC => null,
                self::SP_FECHA_CREADO => null,
                self::SP_FECHA_ENVCOMP => null,
                self::SP_USER_ENVCOMP => null,
                self::SP_ID_COMP => null,
                self::OSNUMDOC => null,
                self::CONTRARECIBO => null,
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
}//Fin de Clase
