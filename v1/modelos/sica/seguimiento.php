<?php
class seguimiento {
	const NOMBRE_TABLA = "seguimientoOs";
	const OSNUMDOC = 'osNumDoc';
    const OSNUMDOC_FIL = 'os.osNumDoc';
	const OSEJERCICIO = 'osEjercicio';
	const SP_ID = 'sp_id';
	const OS_FECHA_CAP = 'os_fecha_cap';
	const OS_USER_CAP = 'os_user_cap';
	const OS_FECHA_ENVPRE = 'os_fecha_envpre';
	const OS_USER_ENVPRE = 'os_user_envpre';
	const OS_FECHA_PRECAP = 'os_fecha_precap';
	const OS_USER_PRECA = 'os_user_precap';
	const OS_FECHA_PRELIB = 'os_fecha_prelib';
	const OS_USER_PRELIB = 'os_user_prelib';
	const OS_FECHA_ENVPROV = 'os_fecha_envprov';
	const OS_USR_ENVPROV = 'os_user_envprov';
	const OS_FECHA_FAC = 'os_fecha_fac';
	const OS_USER_FAC = 'os_user_fac';
	const OS_FECHA_ENVPAG = 'os_fecha_envpag';
	const OS_USER_ENVPAG = 'os_user_envpag';
	const OS_FECHA_SOLPAG = 'os_fecha_solpag';
	const OS_USER_SOLPAG = 'os_user_solpag';
	const OS_FECHA_PAG = 'os_fecha_pag';
	const OS_USER_PAG = 'os_user_pag';
	const OS_FECHA_CAN = 'os_fecha_can';
	const OS_USER_CAN = 'os_user_can';
    const OS_FECHA_ENVCOMP = 'os_fecha_envcomp';
    const OS_USER_ENVCOMP = 'os_user_envcomp';
    const OS_FECHA_COMPROBACION = 'os_fecha_comprob';
    const OS_USER_COMPROBACION = 'os_user_comprob';
	const CREADOPOR = "Creado_por";

	   const CAMPOS = array(
        self::OSNUMDOC,
        self::OSNUMDOC_FIL,
        self::OSEJERCICIO,
        self::SP_ID,
        self::OS_FECHA_CAP,
        self::OS_USER_CAP,
        self::OS_FECHA_ENVPRE,
        self::OS_USER_ENVPRE,
        self::OS_FECHA_PRECAP,
        self::OS_USER_PRECA,
        self::OS_FECHA_PRELIB,
        self::OS_USER_PRELIB,
        self::OS_FECHA_ENVPROV,
        self::OS_USR_ENVPROV,
        self::OS_FECHA_FAC,
        self::OS_USER_FAC,
        self::OS_FECHA_ENVPAG,
        self::OS_USER_ENVPAG,
        self::OS_FECHA_SOLPAG,
        self::OS_USER_SOLPAG,
        self::OS_FECHA_PAG,
        self::OS_USER_PAG,
        self::OS_FECHA_CAN,
        self::OS_USER_CAN,
        self::OS_FECHA_ENVCOMP,
        self::OS_USER_ENVCOMP,
        self::OS_FECHA_COMPROBACION,
        self::OS_USER_COMPROBACION,
    );
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const SELECT = "SELECT
    so.osNumDoc,
    so.osEjercicio,
    so.sp_id,
    so.os_fecha_cap,
    u1.usr_nombres AS usr_nombres_cap,
    so.os_fecha_envpre,
    u2.usr_nombres AS usr_nombres_envpre,
    so.os_fecha_precap,
    u3.usr_nombres AS usr_nombres_precap,
    so.os_fecha_prelib,
    u4.usr_nombres AS usr_nombres_prelib,
    so.os_fecha_envprov,
    u5.usr_nombres AS usr_nombres_envprov,
    so.os_fecha_fac,
    u6.usr_nombres AS usr_nombres_fac,
    so.os_fecha_envpag,
    u7.usr_nombres AS usr_nombres_envpag,
    so.os_fecha_solpag,
    u8.usr_nombres AS usr_nombres_solpag,
    so.os_fecha_pag,
    u9.usr_nombres AS usr_nombres_pag,
    so.os_fecha_can,
    u10.usr_nombres AS usr_nombres_can,
    so.os_fecha_envcomp,
    u11.usr_nombres AS usr_nombres_envcomp,
    so.os_fecha_comprob,
    u12.usr_nombres AS usr_nombres_comprob,
    u13.usr_nombres AS usr_nombres_osEmpSolFir,
    u14.usr_nombres AS usr_nombres_osEmpAut,
    so.Creado_por,
    os.*
    FROM ordenes_sica os
    LEFT JOIN seguimientoOs so ON so.osNumDoc = os.osNumDoc
    LEFT JOIN usuario u1 ON so.os_user_cap = u1.usr_id AND so.os_user_cap > 0
    LEFT JOIN usuario u2 ON so.os_user_envpre = u2.usr_id AND so.os_user_envpre > 0
    LEFT JOIN usuario u3 ON so.os_user_precap = u3.usr_id AND so.os_user_precap > 0
    LEFT JOIN usuario u4 ON so.os_user_prelib = u4.usr_id AND so.os_user_prelib > 0
    LEFT JOIN usuario u5 ON so.os_user_envprov = u5.usr_id AND so.os_user_envprov > 0
    LEFT JOIN usuario u6 ON so.os_user_fac = u6.usr_id AND so.os_user_fac > 0
    LEFT JOIN usuario u7 ON so.os_user_envpag = u7.usr_id AND so.os_user_envpag > 0
    LEFT JOIN usuario u8 ON so.os_user_solpag = u8.usr_id AND so.os_user_solpag > 0
    LEFT JOIN usuario u9 ON so.os_user_pag = u9.usr_id AND so.os_user_pag > 0
    LEFT JOIN usuario u10 ON so.os_user_can = u10.usr_id AND so.os_user_can > 0
    LEFT JOIN usuario u11 ON so.os_user_envcomp = u11.usr_id AND so.os_user_envcomp > 0
    LEFT JOIN usuario u12 ON so.os_user_comprob = u12.usr_id AND so.os_user_comprob > 0
    LEFT JOIN usuario u13 ON os.osEmpSolFir = u13.usr_id AND os.osEmpSolFir > 0 
    LEFT JOIN usuario u14 ON os.osEmpAut = u14.usr_id AND os.osEmpAut > 0";
  /*const SELECT = "SELECT
    so.osNumDoc,
    so.osEjercicio,
    so.sp_id,
    so.os_fecha_cap,
    u1.usr_nombres AS usr_nombres_cap,
    so.os_fecha_envpre,
    u2.usr_nombres AS usr_nombres_envpre,
    so.os_fecha_precap,
    u3.usr_nombres AS usr_nombres_precap,
    so.os_fecha_prelib,
    u4.usr_nombres AS usr_nombres_prelib,
    so.os_fecha_envprov,
    u5.usr_nombres AS usr_nombres_envprov,
    so.os_fecha_fac,
    u6.usr_nombres AS usr_nombres_fac,
    so.os_fecha_envpag,
    u7.usr_nombres AS usr_nombres_envpag,
    so.os_fecha_solpag,
    u8.usr_nombres AS usr_nombres_solpag,
    so.os_fecha_pag,
    u9.usr_nombres AS usr_nombres_pag,
    so.os_fecha_can,
    u10.usr_nombres AS usr_nombres_can,
    so.os_fecha_envcomp,
    u11.usr_nombres AS usr_nombres_envcomp,
    so.os_fecha_comprob,
    u12.usr_nombres AS  usr_nombres_comprob,
    so.Creado_por,
    os.*
FROM seguimientoOs so
LEFT JOIN usuario u1 ON so.os_user_cap = u1.usr_id AND so.os_user_cap > 0
LEFT JOIN usuario u2 ON so.os_user_envpre = u2.usr_id AND so.os_user_envpre > 0
LEFT JOIN usuario u3 ON so.os_user_precap = u3.usr_id AND so.os_user_precap > 0
LEFT JOIN usuario u4 ON so.os_user_prelib = u4.usr_id AND so.os_user_prelib > 0
LEFT JOIN usuario u5 ON so.os_user_envprov = u5.usr_id AND so.os_user_envprov > 0
LEFT JOIN usuario u6 ON so.os_user_fac = u6.usr_id AND so.os_user_fac > 0
LEFT JOIN usuario u7 ON so.os_user_envpag = u7.usr_id AND so.os_user_envpag > 0
LEFT JOIN usuario u8 ON so.os_user_solpag = u8.usr_id AND so.os_user_solpag > 0
LEFT JOIN usuario u9 ON so.os_user_pag = u9.usr_id AND so.os_user_pag > 0
LEFT JOIN usuario u10 ON so.os_user_can = u10.usr_id AND so.os_user_can > 0
LEFT JOIN usuario u11 ON so.os_user_envcomp = u11.usr_id AND so.os_user_envcomp > 0
LEFT JOIN usuario u12 ON so.os_user_comprob = u12.usr_id AND so.os_user_comprob > 0
LEFT JOIN ordenes_sica os ON so.osNumDoc = os.osNumDoc";*/


const INNER = "LEFT JOIN usuario u1 ON so.os_user_cap = u1.usr_id AND so.os_user_cap > 0
LEFT JOIN usuario u2 ON so.os_user_envpre = u2.usr_id AND so.os_user_envpre > 0
LEFT JOIN usuario u3 ON so.os_user_precap = u3.usr_id AND so.os_user_precap > 0
LEFT JOIN usuario u4 ON so.os_user_prelib = u4.usr_id AND so.os_user_prelib > 0
LEFT JOIN usuario u5 ON so.os_user_envprov = u5.usr_id AND so.os_user_envprov > 0
LEFT JOIN usuario u6 ON so.os_user_fac = u6.usr_id AND so.os_user_fac > 0
LEFT JOIN usuario u7 ON so.os_user_envpag = u7.usr_id AND so.os_user_envpag > 0
LEFT JOIN usuario u8 ON so.os_user_solpag = u8.usr_id AND so.os_user_solpag > 0
LEFT JOIN usuario u9 ON so.os_user_pag = u9.usr_id AND so.os_user_pag > 0
LEFT JOIN usuario u10 ON so.os_user_can = u10.usr_id AND so.os_user_can > 0
LEFT JOIN ordenes_sica so ON so.osNumDoc = os.osNumDoc";

         public static function get($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        switch ($peticion[0]) {
             case 'segOsNum':
                if (!empty($peticion[1])) {
                    if (!is_numeric($peticion[1])) {
                        return self::obtenerFiltro($peticion[1]);
                    }
                }
                //return self::obtenerTodos($peticion[1]);
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
         case 'creaCampo':
            $id = self::crearCampo($idUsuario);
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
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }

        $idUsuario = $validaToken['data']->id;

        //var_dump($peticion[0]);
        //var_dump($peticion[1]);

        if (!empty($peticion[0])) {
            $body = file_get_contents('php://input');
            $datos = json_decode($body);
            
            //var_dump($datos);

            switch ($peticion[0]) {
                case 'actualiza':
                if (self::actualizar($datos, $peticion[1]) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro actualizado correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambió", 200);
                break;
                     case 'actCamp':
                if (self::actualizarCampo($datos, $peticion[1]) > 0) {
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
   public static function actualizarCampo($datos, $peticion)
{
    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
        $osEjercicio = htmlspecialchars(strip_tags($datos->osEjercicio));
        $sp_id = htmlspecialchars(strip_tags($datos->sp_id));

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
           // $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE " . self::OSNUMDOC . " = :osNumDoc AND " . self::OSEJERCICIO . " = :osEjercicio";
            $consulta = "UPDATE " . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::OSNUMDOC . " = :osNumDoc AND " . self::OSEJERCICIO . " = :osEjercicio) OR (sp_id = :sp_id AND " . self::OSEJERCICIO . " = :osEjercicio)";

            // Preparar la sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);

            // Bind de los parámetros
            foreach ($bindParams as $param => &$value) {
                $sentencia->bindParam($param, $value, PDO::PARAM_STR);
            }

            $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
            $sentencia->bindParam(":osEjercicio", $osEjercicio, PDO::PARAM_INT);
            $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);

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

    private static function actualizar($datos)
    {
        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

             var_dump($datos);
            $os_fecha_cap = htmlspecialchars(strip_tags($datos->os_fecha_cap));
            $os_user_cap = htmlspecialchars(strip_tags($datos->os_user_cap));
            $os_fecha_envpre = htmlspecialchars(strip_tags($datos->os_fecha_envpre));
            $os_user_envpre = htmlspecialchars(strip_tags($datos->os_user_envpre));
            $os_fecha_precap = htmlspecialchars(strip_tags($datos->os_fecha_precap));
            $os_user_precap = htmlspecialchars(strip_tags($datos->os_user_precap));
            $os_fecha_prelib = htmlspecialchars(strip_tags($datos->os_fecha_prelib));
            $os_user_prelib = htmlspecialchars(strip_tags($datos->os_user_prelib));
            $os_fecha_envprov = htmlspecialchars(strip_tags($datos->os_fecha_envprov));
            $os_user_envprov = htmlspecialchars(strip_tags($datos->os_user_envprov));
            $os_fecha_fac = htmlspecialchars(strip_tags($datos->os_fecha_fac));
            $os_user_fac = htmlspecialchars(strip_tags($datos->os_user_fac));
            $os_fecha_envpag = htmlspecialchars(strip_tags($datos->os_fecha_envpag));
            $os_user_envpag = htmlspecialchars(strip_tags($datos->os_user_envpag));
            $os_fecha_solpag = htmlspecialchars(strip_tags($datos->os_fecha_solpag));
            $os_user_solpag = htmlspecialchars(strip_tags($datos->os_user_solpag));
            $os_fecha_pag = htmlspecialchars(strip_tags($datos->os_fecha_pag));
            $os_user_pag = htmlspecialchars(strip_tags($datos->os_user_pag));
            $os_fecha_can = htmlspecialchars(strip_tags($datos->os_fecha_can));
            $os_user_can = htmlspecialchars(strip_tags($datos->os_user_can));

            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $osEjercicio = htmlspecialchars(strip_tags($datos->osEjercicio));

            try {

               $consulta = "UPDATE " . self::NOMBRE_TABLA .
               " SET " . 
               self::OS_FECHA_CAP . " = :os_fecha_cap, " .
               self::OS_USER_CAP . " = :os_user_cap, " .
               self::OS_FECHA_ENVPRE . " = :os_fecha_envpre, " .
               self::OS_USER_ENVPRE . " = :os_user_envpre, " .
               self::OS_FECHA_PRECAP . " = :os_fecha_precap, " .
               self::OS_USER_PRECA . " = :os_user_precap, " .
               self::OS_FECHA_PRELIB . " = :os_fecha_prelib, " .
               self::OS_USER_PRELIB . " = :os_user_prelib, " .
               self::OS_FECHA_ENVPROV . " = :os_fecha_envprov, " .
               self::OS_USR_ENVPROV . " = :os_user_envprov, " .
               self::OS_FECHA_FAC . " = :os_fecha_fac, " .
               self::OS_USER_FAC . " = :os_user_fac, " .
               self::OS_FECHA_ENVPAG . " = :os_fecha_envpag, " .
               self::OS_USER_ENVPAG . " = :os_user_envpag, " .
               self::OS_FECHA_SOLPAG . " = :os_fecha_solpag, " .
               self::OS_USER_SOLPAG . " = :os_user_solpag, " .
               self::OS_FECHA_PAG . " = :os_fecha_pag, " .
               self::OS_USER_PAG . " = :os_user_pag, " .
               self::OS_FECHA_CAN . " = :os_fecha_can, " .
               self::OS_USER_CAN . " = :os_user_can " .
               " WHERE " . self::OSNUMDOC . " = :osNumDoc AND " . self::OSEJERCICIO . " = :osEjercicio";
                // Preparar la sentencia
               $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
               
               $sentencia->bindParam(":os_fecha_cap", $os_fecha_cap, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_cap", $os_user_cap, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_envpre", $os_fecha_envpre, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_envpre", $os_user_envpre, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_precap", $os_fecha_precap, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_precap", $os_user_precap, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_prelib", $os_fecha_prelib, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_prelib", $os_user_prelib, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_envprov", $os_fecha_envprov, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_envprov", $os_user_envprov, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_fac", $os_fecha_fac, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_fac", $os_user_fac, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_envpag", $os_fecha_envpag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_envpag", $os_user_envpag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_solpag", $os_fecha_solpag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_solpag", $os_user_solpag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_pag", $os_fecha_pag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_pag", $os_user_pag, PDO::PARAM_STR);
               $sentencia->bindParam(":os_fecha_can", $os_fecha_can, PDO::PARAM_STR);
               $sentencia->bindParam(":os_user_can", $os_user_can, PDO::PARAM_STR);
               $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
               $sentencia->bindParam(":osEjercicio", $osEjercicio, PDO::PARAM_INT);
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
private static function crearCampo($idUsuario)
{
    $body = file_get_contents('php://input');
    $datos = json_decode($body);

    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        // Define los campos permitidos y sus valores predeterminados
        $camposPermitidos = [
            self::OSNUMDOC => null,
            self::OSEJERCICIO => null,
            self::SP_ID => null,
            self::OS_FECHA_CAP  => null,
            self::OS_USER_CAP  => null,
            self::OS_FECHA_ENVPRE  => null,
            self::OS_USER_ENVPRE  => null,
            self::OS_FECHA_PRECAP  => null,
            self::OS_USER_PRECA  => null,
            self::OS_FECHA_PRELIB  => null,
            self::OS_USER_PRELIB  => null,
            self::OS_FECHA_ENVPROV  => null,
            self::OS_USR_ENVPROV  => null,
            self::OS_FECHA_FAC  => null,
            self::OS_USER_FAC  => null,
            self::OS_FECHA_ENVPAG  => null,
            self::OS_USER_ENVPAG  => null,
            self::OS_FECHA_SOLPAG  => null,
            self::OS_USER_SOLPAG  => null,
            self::OS_FECHA_PAG  => null,
            self::OS_USER_PAG  => null,
            self::OS_FECHA_CAN  => null,
            self::OS_USER_CAN  => null,
            self::CREADOPOR  => null,
            self::OS_FECHA_ENVCOMP  => null,
            self::OS_USER_ENVCOMP  => null,
            self::OS_FECHA_COMPROBACION  => null,
            self::OS_USER_COMPROBACION  => null,
            self::CREADOPOR => $idUsuario,
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

    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            $osNumDoc = htmlspecialchars(strip_tags($datos->osNumDoc));
            $osEjercicio = htmlspecialchars(strip_tags($datos->osEjercicio));
            $sp_id = htmlspecialchars(strip_tags($datos->sp_id));
            $os_fecha_cap = htmlspecialchars(strip_tags($datos->os_fecha_cap));
            $os_user_cap = htmlspecialchars(strip_tags($datos->os_user_cap));
            $os_fecha_envpre = htmlspecialchars(strip_tags($datos->os_fecha_envpre));
            $os_user_envpre = htmlspecialchars(strip_tags($datos->os_user_envpre));
            $os_fecha_precap = htmlspecialchars(strip_tags($datos->os_fecha_precap));
            $os_user_precap = htmlspecialchars(strip_tags($datos->os_user_precap));
            $os_fecha_prelib = htmlspecialchars(strip_tags($datos->os_fecha_prelib));
            $os_user_prelib = htmlspecialchars(strip_tags($datos->os_user_prelib));
            $os_fecha_envprov = htmlspecialchars(strip_tags($datos->os_fecha_envprov));
            $os_user_envprov = htmlspecialchars(strip_tags($datos->os_user_envprov));
            $os_fecha_fac = htmlspecialchars(strip_tags($datos->os_fecha_fac));
            $os_user_fac = htmlspecialchars(strip_tags($datos->os_user_fac));
            $os_fecha_envpag = htmlspecialchars(strip_tags($datos->os_fecha_envpag));
            $os_user_envpag = htmlspecialchars(strip_tags($datos->os_user_envpag));
            $os_fecha_solpag = htmlspecialchars(strip_tags($datos->os_fecha_solpag));
            $os_user_solpag = htmlspecialchars(strip_tags($datos->os_user_solpag));
            $os_fecha_pag = htmlspecialchars(strip_tags($datos->os_fecha_pag));
            $os_user_pag = htmlspecialchars(strip_tags($datos->os_user_pag));
            $os_fecha_can = htmlspecialchars(strip_tags($datos->os_fecha_can));
            $os_user_can = htmlspecialchars(strip_tags($datos->os_user_can));

            $Creado_por = $idUsuario;

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
   
                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::OSNUMDOC . ", " .
                    self::OSEJERCICIO . ", " .
                    self::SP_ID . ", " .
                    self::OS_FECHA_CAP . ", " .
                    self::OS_USER_CAP . ", " .
                    self::OS_FECHA_ENVPRE . ", " .
                    self::OS_USER_ENVPRE . ", " .
                    self::OS_FECHA_PRECAP . ", " .
                    self::OS_USER_PRECA . ", " .
                    self::OS_FECHA_PRELIB . ", " .
                    self::OS_USER_PRELIB . ", " .
                    self::OS_FECHA_ENVPROV . ", " .
                    self::OS_USR_ENVPROV . ", " .
                    self::OS_FECHA_FAC . ", " .
                    self::OS_USER_FAC . ", " .
                    self::OS_FECHA_ENVPAG . ", " .
                    self::OS_USER_ENVPAG . ", " .
                    self::OS_FECHA_SOLPAG . ", " .
                    self::OS_USER_SOLPAG . ", " .
                    self::OS_FECHA_PAG . ", " .
                    self::OS_USER_PAG . ", " .
                    self::OS_FECHA_CAN . ", " .
                    self::OS_USER_CAN . ", " .
                    self::CREADOPOR . ")" .
                "VALUES (:osNumDoc, :osEjercicio, :sp_id, :os_fecha_cap, :os_user_cap, :os_fecha_envpre, :os_user_envpre, :os_fecha_precap, :os_user_precap, " .
                    ":os_fecha_prelib, :os_user_prelib, :os_fecha_envprov, :os_user_envprov, :os_fecha_fac, " .
                    ":os_user_fac, :os_fecha_envpag, :os_user_envpag, :os_fecha_solpag, :os_user_solpag, " .
                    ":os_fecha_pag, :os_user_pag, :os_fecha_can, :os_user_can, :Creado_por)";

            // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":osNumDoc", $osNumDoc, PDO::PARAM_INT);
                $sentencia->bindParam(":osEjercicio", $osEjercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_id", $sp_id, PDO::PARAM_INT);
                $sentencia->bindParam(":os_fecha_cap", $os_fecha_cap, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_cap", $os_user_cap, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_envpre", $os_fecha_envpre, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_envpre", $os_user_envpre, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_precap", $os_fecha_precap, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_precap", $os_user_precap, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_prelib", $os_fecha_prelib, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_prelib", $os_user_prelib, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_envprov", $os_fecha_envprov, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_envprov", $os_user_envprov, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_fac", $os_fecha_fac, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_fac", $os_user_fac, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_envpag", $os_fecha_envpag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_envpag", $os_user_envpag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_solpag", $os_fecha_solpag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_solpag", $os_user_solpag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_pag", $os_fecha_pag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_pag", $os_user_pag, PDO::PARAM_STR);
                $sentencia->bindParam(":os_fecha_can", $os_fecha_can, PDO::PARAM_STR);
                $sentencia->bindParam(":os_user_can", $os_user_can, PDO::PARAM_STR);
                $sentencia->bindParam(":Creado_por", $Creado_por, PDO::PARAM_INT);

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
    private static function obtenerFiltro($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        $consulta = self::SELECT.$filtro['where'] . " order by so.osNumDoc desc";
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
