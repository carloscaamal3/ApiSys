<?php
class rel_cuentas
{
    const NOMBRE_TABLA = "rel_cuenta_contable";
    
    const CUECON_CUENTA = "cuecon_cuenta";
    const REL_CLAVE = "rel_clave";
    
    const REL_TIPO = "rel_tipo";
    const REL_ACTIVO = "rel_activo";
    const REL_CLAVE_ID = "rel_clave_id";
    const REL_TABLA = "rel_tabla";

    const REL_USER_CREA = "rel_user_crea";
    const REL_FECHA_CREA = "rel_fecha_crea";
    const REL_USER_MOD = "rel_user_mod";
    const REL_FECHA_MOD = "rel_fecha_mod";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS_CREA = array(
        self::CUECON_CUENTA,
        self::REL_CLAVE,
        self::REL_TIPO,
        self::REL_CLAVE_ID,
        self::REL_TABLA
    );

    ////////////////////////////////////////////////////////////////////////////////////////////////
    //M E T O D O S
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de cuenta contable
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
            case 'penalim':
                return self::obtenerPensionAlimen();
                break;
            default:
                throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
                break;
        }
/*         if (!empty($peticion[0])) {
            if (!is_numeric($peticion[0])) {
                return self::obtenerFiltro($peticion[0]);
            }
        }

        return self::obtener($peticion[0]); */
    } 
    /**
     * Metodo POST Crea una Relacion cuenta - proveedor o concepto en la base de datos
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
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //F U N C I O N E S
    ////////////////////////////////////////////////////////////////////////////////////////////////
     /**
     * Crea un cuenta contable en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la cuenta contable
     * @param [object] $tipo Contiene un objeto con la informacion del tipo que desea
     * @return integer Devuelve el id el nuevo registro creado
     */
    private static function crear($idUsuario)
    {
        $body = file_get_contents('php://input');
        $datos = json_decode($body);

        if ($datos) {
            $campos = self::CAMPOS_CREA;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);
            //Sanitiza los campos recibidos
            $cueconCuenta = htmlspecialchars(strip_tags($datos->cuecon_cuenta));
            $relClave = htmlspecialchars(strip_tags($datos->rel_clave));
            $relTipo = htmlspecialchars(strip_tags($datos->rel_tipo));
            $relClaveId = htmlspecialchars(strip_tags($datos->rel_clave_id));
            $relTabla = htmlspecialchars(strip_tags($datos->rel_tabla));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::CUECON_CUENTA . ", " .
                    self::REL_CLAVE . ", " .
                    self::REL_TIPO . ", " .
                    self::REL_CLAVE_ID . ", " .
                    self::REL_TABLA . ", " .
                    self::REL_FECHA_CREA . ", " .
                    self::REL_USER_CREA . ")" .
                    " VALUES(:cuecon_cuenta,:rel_clave,:rel_tipo,:rel_clave_id,:rel_tabla,CURRENT_TIMESTAMP(6),:rel_user_crea)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":cuecon_cuenta", $cueconCuenta, PDO::PARAM_STR);
                $sentencia->bindParam(":rel_clave", $relClave, PDO::PARAM_STR);
                $sentencia->bindParam(":rel_clave_id", $relClaveId, PDO::PARAM_INT);
                $sentencia->bindParam(":rel_tipo", $relTipo, PDO::PARAM_STR);
                $sentencia->bindParam(":rel_tabla", $relTabla, PDO::PARAM_STR);
                $sentencia->bindParam(":rel_user_crea", $CreadoPor, PDO::PARAM_INT);
                
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
     * Obtiene uno o varios registros de cuenta contable de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la cuenta contable que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtenerPensionAlimen()
    {
        try {
            //$whereId = !empty($id) ? " WHERE " . self::CUECON_CUENTA . "= :cuecon_cuenta" : "";
            $whereId = "where r.rel_tipo = 'penalim' and r.rel_activo = 1";
            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            //$comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId;
            $comando = "select r.cuecon_cuenta,
            c.tipo_id as concepto,
            tc.tipo_descripcion as nomconcepto,
            r.rel_clave,
            p.prov_razon_social,
            p.prov_tipo,
            t.tipo_descripcion,
            r.rel_tipo,
            r.rel_activo,
            r.rel_clave_id,
            r.rel_clave_id  as prov_id,
            r.rel_user_crea,
            r.rel_fecha_crea,
            r.rel_fecha_mod,
            r.rel_user_mod,
            r.rel_tabla
            from rel_cuenta_contable r
            inner join cuenta_contable c on c.cuecon_cuenta = r.cuecon_cuenta
            inner join tipo tc on c.tipo_id = tc.tipo_id
            inner join proveedor p on r.rel_clave_id = p.prov_id
            inner join tipo t on p.prov_tipo = t.tipo_clave " . $whereId . " order by p.prov_razon_social";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($cuenta)) {
                $sentencia->bindParam(":cuecon_cuenta", $cuenta, PDO::PARAM_STR);
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

    

}//fin de clase