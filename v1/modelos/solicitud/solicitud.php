<?php

class solicitud
 {
    const NOMBRE_TABLA = 'solicitudes';

    const NOMBRE_TABLA_DET = 'sol_detalle';

    const S_FOLIO = 's_folio';
    const S_EJERCICIO = 's_ejercicio';
    const TIPO_SOL = 'tipoSol';
    const DEP_SOL = 'departamentoSol';
    const DESCRIPCION = 'descripcion';
    const ESTATUS = 'estatus';
    const MONTO = 'monto';
    const MONTO_APROB = 'montoAprob'; //pen 
    const CANTIDAD = 'cantidad'; //pen
    const ID_CIUD = 'idCiud';
    const FECHA_SOL = 'fechaSolicitud';
    const FECHA_APROB = 'fechaAprobacion';
    const CREADO_POR = 'creado_por';

    const SFOLIODET = "s_folio";
    const SPOSICION = "s_posicion";
    const IDSERVICIO = "id_servicio";
    const SEDESCRIPCION = "se_descripcion";
    const SECANTIDAD = "se_cantidad";
    const SEUNIDAD = "se_unidad";
    const SEMARCA = "se_marca";
    const SETOTAL= "se_total";
    const SE_CREADO = "creado_por";
    const SE_CREADOEL = "creado_el";

    const CAMPOS = array (
        self::S_FOLIO,
        self::S_EJERCICIO,

        self::TIPO_SOL,
        self::DEP_SOL,
        self::DESCRIPCION,
        self::ESTATUS,
        self::MONTO,
        self::MONTO_APROB,
        self::CANTIDAD,
        self::ID_CIUD,
        self::FECHA_SOL,
        self::FECHA_APROB,
        self::CREADO_POR,
    );

    const CAMPOS_DET = array (
    sef::SFOLIODET,
    sef::SPOSICION,
    sef::IDSERVICIO,
    sef::SEDESCRIPCION,
    sef::SECANTIDAD,
    sef::SEUNIDAD,
    sef::SEMARCA,
    sef::SETOTAL,
    sef::SE_CREADO,
    sef::SE_CREADOEL,
    );

    //CODIGOS DE ERROR
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const SELECT = "select ifnull(s_folio, '') as s_folio,
    ifnull(s_ejercicio, '') as s_ejercicio,
    ifnull(tipoSol, '') as tipoSol,
    ifnull(departamentoSol, '') as departamentoSol,
    ifnull(descripcion, '') as descripcion,
    ifnull(estatus, '') as estatus,
    ifnull(monto, '') as monto,
    ifnull(montoAprob, '') as montoAprob,
    ifnull(cantidad, '') as cantidad,
    ifnull(idCiud, '') as idCiud,
    ifnull(fechaSolicitud, '') as fechaSolicitud,
    ifnull(fechaAprobacion, '') as fechaAprobacion,
    ifnull(creado_por, '') as creado_por from ";

    public static function post( $peticion )
 {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ( $validaToken[ 'exp' ] ) {
            error_log( 'Quedan ' . ( $validaToken[ 'exp' ] - time() ) / 60 . ' minutos' );
        }

        $idUsuario = $validaToken[ 'data' ]->id;

        switch ( $peticion[ 0 ] ) {
            //inserta registro sin importar los campos enviados
            case 'insertSol':
            $id = self::addSol( $idUsuario );
            http_response_code( 201 );
            return [
                'estado' => self::CODIGO_EXITO,
                'mensaje' => '¡Registro creado con éxito!',
                'id' => $id
            ];
            break;
            case 'insertDet':
                $id = self::addSolDet( $idUsuario );
                http_response_code( 201 );
                return [
                    'estado' => self::CODIGO_EXITO,
                    'mensaje' => '¡Registro creado con éxito!',
                    'id' => $id
                ];
                break;
            default:
            throw new ExcepcionApi( self::ESTADO_URL_INCORRECTA, 'Url mal formada', 400 );
            break;
        }
    }
    public static function put( $peticion )
 {
        //Rutina de autorizacion
        $validaToken = Validador::obtenerInstancia()->validaToken();
        //Termina rutina de autorizacion
        if ( $validaToken[ 'exp' ] ) {
            error_log( 'Quedan ' . ( $validaToken[ 'exp' ] - time() ) / 60 . ' minutos' );
        }

        $idUsuario = $validaToken[ 'data' ]->id;
        switch ( $peticion[ 0 ] ) {

            case 'updateSol':
            if ( !empty( $peticion[ 0 ] ) ) {
                $body = file_get_contents( 'php://input' );
                $datos = json_decode( $body );

                if ( self::updateSolcitud( $datos, $idUsuario ) > 0 ) {
                    http_response_code( 200 );
                    return [
                        'estado' => self::CODIGO_EXITO,
                        'mensaje' => 'Registro actualizado correctamente'
                    ];
                }
                throw new ExcepcionApi( self::ESTADO_NO_ENCONTRADO, 'El registro al que intentas acceder no existe o no cambio', 200 );
            }
            break;
            case 'updatDet':
                if ( !empty( $peticion[ 0 ] ) ) {
                    $body = file_get_contents( 'php://input' );
                    $datos = json_decode( $body );
    
                    if ( self::updateSolcitudDet( $datos, $idUsuario ) > 0 ) {
                        http_response_code( 200 );
                        return [
                            'estado' => self::CODIGO_EXITO,
                            'mensaje' => 'Registro actualizado correctamente'
                        ];
                    }
                    throw new ExcepcionApi( self::ESTADO_NO_ENCONTRADO, 'El registro al que intentas acceder no existe o no cambio', 200 );
                }
                break;

            default:
            throw new ExcepcionApi( self::ESTADO_URL_INCORRECTA, 'Url mal formada', 400 );
            break;
        }

        throw new ExcepcionApi( self::ESTADO_ERROR_PARAMETROS, 'Falta información', 422 );
    }

    public static function get( $peticion )
 {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ( $validaToken[ 'exp' ] ) {
            error_log( 'Quedan ' . ( $validaToken[ 'exp' ] - time() ) / 60 . ' minutos' );
        }
        switch ( $peticion[ 0 ] ) {
            case 'getAll':
            if ( !empty( $peticion[ 1 ] ) ) {
                if ( !is_numeric( $peticion[ 1 ] ) ) {
                    return self::getAllFiltered( $peticion[ 1 ] );
                }
            }
            return self::getAll( $peticion[ 1 ] );
            break;
            case 'getAllDet':
                if ( !empty( $peticion[ 1 ] ) ) {
                    if ( !is_numeric( $peticion[ 1 ] ) ) {
                        return self::getAllFilteredDet( $peticion[ 1 ] );
                    }
                }
                return self::getAllDeta( $peticion[ 1 ] );
            break;
            default:
            throw new ExcepcionApi( self::ESTADO_URL_INCORRECTA, 'Url mal formada', 400 );
            break;
        }
    }
    public static function delete($peticion)
    {
        $validaToken = Validador::obtenerInstancia()->validaToken();

        if ($validaToken["exp"]) {
            error_log("Quedan " . ($validaToken["exp"] - time()) / 60 . " minutos");
        }
        $idUsuario = $validaToken['data']->id;
      switch ($peticion[0]) {
            case 'deleteDet':
                if (self::deleteDeta($peticion[1], $idUsuario) > 0) {
                    http_response_code(200);
                    return [
                        "estado" => self::CODIGO_EXITO,
                        "mensaje" => "Registro elimino correctamente"
                    ];
                }
                throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambio", 200);
                break;                  
        }

    }
    private static function addSol( $idUsuario )
 {
        $body = file_get_contents( 'php://input' );
        $datos = json_decode( $body );

        if ( $datos ) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );

            // Define los campos permitidos y sus valores predeterminados
            $camposPermitidos = [

                self::S_FOLIO => null,
                self::S_EJERCICIO => null,
                self::TIPO_SOL => null,
                self::DEP_SOL => null,
                self::DESCRIPCION => null,
                self::ESTATUS => null,
                self::MONTO => null,
                self::MONTO_APROB => null,
                self::CANTIDAD => null,
                self::ID_CIUD  => null,
                self::FECHA_SOL => null,
                self::FECHA_APROB => null,
                self::CREADO_POR => $idUsuario,
            ];

            // Filtra solo los campos presentes en la solicitud y sus valores
            $datosInsert = array_intersect_key( ( array )$datos, $camposPermitidos );

            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                // Construye la consulta dinámicamente con los campos presentes
                $comando = 'INSERT INTO ' . self::NOMBRE_TABLA . ' (' . implode( ', ', array_keys( $datosInsert ) ) . ') VALUES (:' . implode( ', :', array_keys( $datosInsert ) ) . ')';

                $sentencia = $pdo->prepare( $comando );

                foreach ( $datosInsert as $campo => &$valor ) {
                    $sentencia->bindParam( ":$campo", $valor, PDO::PARAM_STR );
                }

                // Ejecutar la sentencia
                $sentencia->execute();

                // Retornar en el último id insertado
                // return $pdo->lastInsertId();
                return $pdo;
            } catch ( PDOException $e ) {
                throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage(), 400 );
            }
        }

        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            'Error en el cuerpo de la solicitud',
            400
        );
    }

    private static function addSolDet( $idUsuario )
    {
           $body = file_get_contents( 'php://input' );
           $datos = json_decode( $body );
   
           if ( $datos ) {
               $campos = self::CAMPOS_DET;
               UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );
   
               // Define los campos permitidos y sus valores predeterminados
               $camposPermitidos = [
   
                sef::SFOLIODET => null,
                sef::SPOSICION => null,
                sef::IDSERVICIO => null,
                sef::SEDESCRIPCION => null,
                sef::SECANTIDAD => null,
                sef::SEUNIDAD => null,
                sef::SEMARCA => null,
                sef::SETOTAL => null,
                sef::SE_CREADO => $idUsuario,
               ];
   
               // Filtra solo los campos presentes en la solicitud y sus valores
               $datosInsert = array_intersect_key( ( array )$datos, $camposPermitidos );
   
               try {
                   $pdo = ConexionBD::obtenerInstancia()->obtenerBD();
   
                   // Construye la consulta dinámicamente con los campos presentes
                   $comando = 'INSERT INTO ' . self::NOMBRE_TABLA_DET . ' (' . implode( ', ', array_keys( $datosInsert ) ) . ') VALUES (:' . implode( ', :', array_keys( $datosInsert ) ) . ')';
   
                   $sentencia = $pdo->prepare( $comando );
   
                   foreach ( $datosInsert as $campo => &$valor ) {
                       $sentencia->bindParam( ":$campo", $valor, PDO::PARAM_STR );
                   }
   
                   // Ejecutar la sentencia
                   $sentencia->execute();
   
                   // Retornar en el último id insertado
                   // return $pdo->lastInsertId();
                   return $pdo;
               } catch ( PDOException $e ) {
                   throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage(), 400 );
               }
           }
   
           throw new ExcepcionApi(
               self::ESTADO_ERROR_PARAMETROS,
               'Error en el cuerpo de la solicitud',
               400
           );
       }

    public static function updateSolcitud( $datos, $peticion )
 {
        if ( $datos ) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );

            $s_folio = htmlspecialchars( strip_tags( $datos->s_folio ) );

            $setClause = '';
            $bindParams = [];

            foreach ( $campos as $campo ) {
                if ( isset( $datos-> {
                    $campo}
                ) ) {
                    $setClause .= "$campo = :$campo, ";
                    $bindParams[ ":$campo" ] = htmlspecialchars( strip_tags( $datos-> {
                        $campo}
                    ) );
                }
            }

            // Elimina la coma adicional al final de la cadena de la cláusula SET
            $setClause = rtrim( $setClause, ', ' );

            try {

                $consulta = 'UPDATE ' . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::S_FOLIO . ' = :s_folio AND ' . self::S_EJERCICIO . ' = :s_ejercicio )';

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $consulta );

                // Bind de los parámetros
                foreach ( $bindParams as $param => &$value ) {
                    $sentencia->bindParam( $param, $value, PDO::PARAM_STR );
                }

                $sentencia->bindParam( ':s_folio', $s_folio, PDO::PARAM_STR );
                //$sentencia->bindParam( ':claveINE', $claveINE, PDO::PARAM_STR );

                $sentencia->execute();
                return $sentencia->rowCount();
            } catch ( PDOException $e ) {
                throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage() );
            }
        }

        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            'Error en existencia o sintaxis de parámetros'
        );
    }
    
    public static function updateSolcitudDet( $datos, $peticion )
 {
        if ( $datos ) {
            $campos = self::CAMPOS_DET;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );

            $s_folio = htmlspecialchars( strip_tags( $datos->s_folio ) );

            $setClause = '';
            $bindParams = [];

            foreach ( $campos as $campo ) {
                if ( isset( $datos-> {
                    $campo}
                ) ) {
                    $setClause .= "$campo = :$campo, ";
                    $bindParams[ ":$campo" ] = htmlspecialchars( strip_tags( $datos-> {
                        $campo}
                    ) );
                }
            }

            // Elimina la coma adicional al final de la cadena de la cláusula SET
            $setClause = rtrim( $setClause, ', ' );

            try {

                $consulta = 'UPDATE ' . self::NOMBRE_TABLA_DET . " SET $setClause WHERE (" . self::S_FOLIO . ' = :s_folio AND ' . self::SPOSICION . ' = :s_posicion )';

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $consulta );

                // Bind de los parámetros
                foreach ( $bindParams as $param => &$value ) {
                    $sentencia->bindParam( $param, $value, PDO::PARAM_STR );
                }

                $sentencia->bindParam( ':s_folio', $s_folio, PDO::PARAM_STR );
                //$sentencia->bindParam( ':claveINE', $claveINE, PDO::PARAM_STR );

                $sentencia->execute();
                return $sentencia->rowCount();
            } catch ( PDOException $e ) {
                throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage() );
            }
        }

        throw new ExcepcionApi(
            self::ESTADO_ERROR_PARAMETROS,
            'Error en existencia o sintaxis de parámetros'
        );
    }
    private static function getAll( $id = null )
    {
           try {
               $whereId = !empty( $id ) ? ' WHERE ' . self::S_FOLIO . '= :s_folio' : '';
   
               //$comando = 'SELECT * FROM ' . self::NOMBRE_TABLA . $whereId;
               //$comando = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING . $whereId . ' order by osNumDoc asc';
               $comando = self::SELECT. self::NOMBRE_TABLA . $whereId . ' order by s_folio desc';
               $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $comando );
   
               if ( !empty( $id ) ) {
                   $sentencia->bindParam( ':s_folio', $id, PDO::PARAM_INT );
               }
   
               $sentencia->execute();
               http_response_code( 200 );
               if ( $sentencia->rowCount() > 0 ) {
                   return $sentencia->fetchall( PDO::FETCH_ASSOC );
               }
               $mensaje = 'No se encontraron registros';
               $mensaje .= !empty( $id ) ? ' con ese Id' : ' en la tabla: ' .  self::NOMBRE_TABLA;
   
               return array(
                   'estado' => 1,
                   'mensaje' => $mensaje //'No se encontraron registros con ese id'
               );
           } catch ( PDOException $e ) {
               throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage() );
           }
       }
       private static function getAllDeta( $id = null )
    {
           try {
               $whereId = !empty( $id ) ? ' WHERE ' . self::SFOLIODET . '= :s_folio' : '';
   
               //$comando = 'SELECT * FROM ' . self::NOMBRE_TABLA . $whereId;
               //$comando = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING . $whereId . ' order by osNumDoc asc';
               $comando = self::SELECT_DET. self::NOMBRE_TABLA_DET . $whereId . ' order by s_posicion desc';
               $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $comando );
   
               if ( !empty( $id ) ) {
                   $sentencia->bindParam( ':s_folio', $id, PDO::PARAM_INT );
               }
   
               $sentencia->execute();
               http_response_code( 200 );
               if ( $sentencia->rowCount() > 0 ) {
                   return $sentencia->fetchall( PDO::FETCH_ASSOC );
               }
               $mensaje = 'No se encontraron registros';
               $mensaje .= !empty( $id ) ? ' con ese Id' : ' en la tabla: ' .  self::NOMBRE_TABLA_DET;
   
               return array(
                   'estado' => 1,
                   'mensaje' => $mensaje //'No se encontraron registros con ese id'
               );
           } catch ( PDOException $e ) {
               throw new ExcepcionApi( self::ESTADO_ERROR_BD, $e->getMessage() );
           }
       }
       private static function getAllFiltered($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        $consulta = self::SELECT. self::NOMBRE_TABLA . $filtro['where'] . " order by s_folio desc";

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
    private static function getAllFilteredDet($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS_DET);

        $consulta = self::SELECT_DET. self::NOMBRE_TABLA_DET . $filtro['where'] . " order by s_posicion desc";

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
    private static function deleteDeta($id, $s_posicion)
    {
    try {
        $consulta = "DELETE FROM " . self::NOMBRE_TABLA_DET .
                    " WHERE " . self::SFOLIODET . " = :s_folio AND "
                    . self::SPOSICION  . " = :s_posicion";

        // Eliminar el detalle
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
        $sentencia->bindParam(":s_folio", $id, PDO::PARAM_STR);
        $sentencia->bindParam(":s_posicion", $s_posicion, PDO::PARAM_STR);
        $sentencia->execute();

        // Actualizar las posiciones
        $consultaUpdate = "UPDATE " . self::NOMBRE_TABLA_DET .
                          " SET " . self::SPOSICION  . " = " . self::SPOSICION  . " - 1" .
                          " WHERE " . self::SFOLIODET . " = :s_folio" .
                          " AND " . self::SPOSICION  . " > :s_posicion";

        $sentenciaUpdate = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consultaUpdate);
        $sentenciaUpdate->bindParam(":s_folio", $id, PDO::PARAM_STR);
        $sentenciaUpdate->bindParam(":s_posicion", $s_posicion, PDO::PARAM_STR);
        $sentenciaUpdate->execute();

        return $sentencia->rowCount();
    } catch (PDOException $e) {
        throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
    }
    }
}
