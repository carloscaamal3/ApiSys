<?php
include_once "datos/ConexionBD.php";

class folios
{
    const NOMBRE_TABLA = "folios";
    const FOLIO_ID = "folio_id";
    
    const SP_ID = "sp_id";
    const SP_EJERCICIO = "sp_ejercicio";
    const SP_EJERCICIO_AUX = "f.sp_ejercicio";
    const FOLIO_NUM = "folio_num";
    const FOLIO_FECHA = "folio_fecha";
    const FOLIO_ISCOMPROMETIDO = "folio_iscomprometido";
    const FOLIO_ISDEVENGADO = "folio_isdevengado";
    const FOLIO_ACTIVO = "folio_activo";
    

    const FOLIO_FECHA_CREA = "folio_fecha_crea";
    const FOLIO_USER_CREA = "folio_user_crea";
    const FOLIO_FECHA_CANCELA = "folio_fecha_cancela";
    const FOLIO_USER_CANCELA = "folio_user_cancela";
    const FOLIO_FECHA_MOD = "folio_fecha_mod";
    const FOLIO_USER_MOD = "folio_user_mod";


    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::FOLIO_ID,
        self::SP_ID,
        self::SP_EJERCICIO,
        self::SP_EJERCICIO_AUX,
        self::FOLIO_NUM,
        self::FOLIO_FECHA,
        self::FOLIO_ISCOMPROMETIDO,
        self::FOLIO_ISDEVENGADO,
        self::FOLIO_ACTIVO
    );

      const SELECT = "select f.folio_id,f.folio_num, f.sp_id,f.sp_ejercicio,f.folio_fecha,f.folio_iscomprometido,f.folio_isdevengado,f.folio_activo,
      f.folio_fecha_crea,f.folio_user_crea,ucrea.usr_login as login_crea, ucrea.usr_nombres as nombre_crea,
      f.folio_fecha_cancela,f.folio_user_cancela,ucan.usr_login as login_cancela, ucan.usr_nombres as nombre_cancela, 
      case when s.sp_concepto = 23 then '1' when s.sp_concepto = 24 then '1' else '0' end as EsComprobacion,
      s.sp_id_gpo_folios FROM ";

      const INNER = " f inner join usuario ucrea on f.folio_user_crea = ucrea.usr_id 
      left join usuario ucan on f.folio_user_cancela = ucan.usr_id 
      inner join solicitud_pagos s on f.sp_id = s.sp_id and f.sp_ejercicio = s.sp_ejercicio";
    /**
     * Método GET Obtiene uno o varios registros de la tabla de folio
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

        $idTipo = self::crear($idUsuario);

        http_response_code(201);
        return [
            "estado" => self::CODIGO_EXITO,
            "mensaje" => "¡Registro creado con éxito!",
            "id" => $idTipo
        ];
    }

    /**
     * Método PUT Actualiza un tipo en la base de datos
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
            $tipo = json_decode($body);

            if (self::actualizar($tipo, $peticion[0], $idUsuario) > 0) {
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
     * Método delete Inactiva un tipo en la base de datos
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
                    "mensaje" => "El tipo ha sido eliminado con exito"
                );
            }
            throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
        }
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Error en los parámetros o parámetro ausente", 400);
    }

    /**
     * Obtiene uno o varios registros de folios de acuerdo a el parametro recibido
     *
     * @param [int] $idTipo Contiene el id del tipo que se desea obtener (vacio si se quieren todos los folios)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::FOLIO_ID . "= :folio_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;
            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by f.folio_id";
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":folio_id", $id, PDO::PARAM_INT);
            }

            $sentencia->execute();
            http_response_code(200);
            if ($sentencia->rowCount() > 0) {
                return $sentencia->fetchall(PDO::FETCH_ASSOC);
            }
            $mensaje = "No se encontraron registros";
            $mensaje .= !empty($id) ? " con ese Id" : " en la tabla";

            return array(
                "estado" => 1,
                "mensaje" => $mensaje //"No se encontraron registros con ese id"
            );
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage());
        }
    }

    /**
     * Obtiene uno o varios registros de folios de acuerdo a criterios de filtrado
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

        //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'] . " order by folio_id";
        $consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER .$filtro['where'] . " order by f.folio_id";

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
     * Crea un Tipo en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea el tipo
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
            $spId = htmlspecialchars(strip_tags($datos->sp_id));
            $spEjercicio = htmlspecialchars(strip_tags($datos->sp_ejercicio));
            $folioNum = htmlspecialchars(strip_tags($datos->folio_num));
            $folioFecha = htmlspecialchars(strip_tags($datos->folio_fecha));
            $folioIsComprometido = htmlspecialchars(strip_tags($datos->folio_iscomprometido));
            $folioIsDevengado = htmlspecialchars(strip_tags($datos->folio_isdevengado));
            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::SP_ID . ", " .
                    self::SP_EJERCICIO . ", " .
                    self::FOLIO_NUM . ", " .
                    self::FOLIO_FECHA . ", " .
                    self::FOLIO_ISCOMPROMETIDO . ", " .
                    self::FOLIO_ISDEVENGADO . ", " .
                    self::FOLIO_FECHA_CREA . ", " .
                    self::FOLIO_USER_CREA . ")" .
                    " VALUES(:sp_id,:sp_ejercicio,:folio_num,:folio_fecha,:folio_iscomprometido,:folio_isdevengado,CURRENT_TIMESTAMP(6),:folio_user_crea)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":sp_id", $spId, PDO::PARAM_INT);
                $sentencia->bindParam(":sp_ejercicio", $spEjercicio, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_num", $folioNum, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_fecha", $folioFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":folio_iscomprometido", $folioIsComprometido, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_isdevengado", $folioIsDevengado, PDO::PARAM_INT);
                //$sentencia->bindParam(":tipo_activo", $tipoActivo, PDO::PARAM_STR);
                $sentencia->bindParam(":folio_user_crea", $CreadoPor, PDO::PARAM_INT);
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

            $folioNum = htmlspecialchars(strip_tags($datos->folio_num));
            $folioFecha = htmlspecialchars(strip_tags($datos->folio_fecha));
            $folioisComprometido = htmlspecialchars(strip_tags($datos->folio_iscomprometido));
            $folioisDevengado = htmlspecialchars(strip_tags($datos->folio_isdevengado));
            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::FOLIO_NUM . "= :folio_num, " .
                    self::FOLIO_FECHA . "= :folio_fecha, " .
                    self::FOLIO_ISCOMPROMETIDO . "= :folio_iscomprometido, " .
                    self::FOLIO_ISDEVENGADO . "= :folio_isdevengado, " .
                    self::FOLIO_FECHA_MOD . "= CURRENT_TIMESTAMP(6), " .
                    self::FOLIO_USER_MOD . "= :folio_user_mod " .
                    " WHERE " . self::FOLIO_ID . "= :folio_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":folio_num", $folioNum, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_fecha", $folioFecha, PDO::PARAM_STR);
                $sentencia->bindParam(":folio_iscomprometido", $folioisComprometido, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_isdevengado", $folioisDevengado, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_user_mod", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":folio_id", $id, PDO::PARAM_INT);
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
     * Cambia el valor del campo activo de un Tipo a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::FOLIO_ACTIVO . " = 0, " .
            self::FOLIO_USER_CANCELA . "= :folio_user_cancela, " .
            self::FOLIO_FECHA_CANCELA . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::FOLIO_ID . " = :folio_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":folio_id", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":folio_user_cancela", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
}//Fin de Clase
