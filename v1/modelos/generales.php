<?PHP
class generales
{
    const NOMBRE_TABLA = "generales";

    const ID_SISTEMA = "id_sistema";
    const GPO_FIRMA_SOL = "gpo_firma_sol";
    const GPO_FIRMA_AUT = "gpo_firma_aut";
    const GPO_ENVIO_PAGO = "gpo_envio_pago";
    const GPO_ENVIO_COMPROBACION = "gpo_envio_comprobacion";
    const GPO_FOLIOS = "gpo_folios";
    const GPO_GXC_ENT_CONTA = "gpo_gxc_ent_conta";
    const GPO_EJERCIDO = "gpo_ejercido";
    const GPO_ENVIO_CONT_NP = "gpo_envio_cont_np";
    const ID_EMP_AUT = "id_emp_aut";

    const CAMPOS = array(
        self::ID_SISTEMA,
        self::ID_EMP_AUT,
    );

    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de generales
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
     * Obtiene uno o varios registros de clasificacion de tipo de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la clasificacion de tipo que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            //$whereId = !empty($id) ? " WHERE " . self::CE_CONCEPTO_NP . "= :ce_concepto_NP" : "";
            $whereId = !empty($id) ? " WHERE " . self::ID_SISTEMA . "= :id_sistema" : "";

            $comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":id_sistema", $id, PDO::PARAM_INT);
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


}//Fin de clase