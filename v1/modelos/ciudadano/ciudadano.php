<?php

class ciudadano {

    const NOMBRE_TABLA = 'ciudadanoInfo';
    const ID_CIUD = 'idCiud';
    const NOMBRE = 'nombreCom';
    const CLAVE_INE = 'claveINE';
    const DIRECCION = 'direccion';
    const COLONIA = 'colonia';
    const SECCION = 'seccion';
    const MUNICIPIO = 'municipio';
    const TIPO = 'tipoCiud';
    const ACTIVO = 'activo';
    const CREADO_POR = 'creado_por';
    //const CRADO_EL = 'creado_el';

    const CAMPOS = array(

        self::ID_CIUD,
        self::NOMBRE,
        self::CLAVE_INE,
        self::DIRECCION,
        self::COLONIA,
        self::SECCION,
        self::MUNICIPIO,
        self::TIPO,
        self::ACTIVO,
        self::CREADO_POR,
        //self::CREADO_EL,

    );

    //CODIGOS DE ERROR
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const SELECT = "select ifnull(idCiud, '') as idCiud,
              ifnull(nombreCom, '') as nombreCom,
              ifnull(claveINE, '') as claveIne,
              ifnull(direccion, '') as direccion,
              ifnull(colonia, '') as colonia,
              ifnull(seccion, '') as seccion,
              ifnull(municipio, '') as municipio,
              ifnull(tipoCiud, '') as tipoCiud,
              ifnull(activo, '') as activo,
              ifnull(creado_por, '') as creado_por,
              ifnull(creado_el, '') as creado_el from ";

    /**
    * Metodo POST Crea un tipo en la base de datos
    *
    * @return object Devuelve un json con el resultado del método
    */
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
            case 'insertCiud':
            $id = self::addCiud( $idUsuario );
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
    /**
    * Método PUT Actualiza un Sistema en la base de datos
    *
    * @param [ array ] $peticion Contiene un array con la( s ) petición( es ) del cliente
    * @return array Devuelve un array con el resultado del método
    */
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

            case 'updateCiud':
            if ( !empty( $peticion[ 0 ] ) ) {
                $body = file_get_contents( 'php://input' );
                $datos = json_decode( $body );

                //if ( self::actualizarDetalle( $datos, $peticion[ 1 ], $peticion[ 2 ], $idUsuario ) > 0 ) {
                if ( self::updateCiudadano( $datos, $idUsuario ) > 0 ) {
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
    /**
    * Método GET Obtiene uno o varios registros de la tabla de Sistema
    *
    * @param [ array ] $peticion Contiene un array con la( s ) petición( es ) del cliente
    * @return object Devuelve un json con el resultado del método
    */
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

            default:
            throw new ExcepcionApi( self::ESTADO_URL_INCORRECTA, 'Url mal formada', 400 );
            break;
        }
    }

    private static function addCiud( $idUsuario )
 {
        $body = file_get_contents( 'php://input' );
        $datos = json_decode( $body );

        if ( $datos ) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );

            // Define los campos permitidos y sus valores predeterminados
            $camposPermitidos = [

                self::ID_CIUD => null,
                self::NOMBRE  => null,
                self::CLAVE_INE => null,
                self::DIRECCION => null,
                self::COLONIA => null,
                self::SECCION => null,
                self::MUNICIPIO => null,
                self::TIPO => null,
                self::ACTIVO => null,
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

    public static function updateCiudadano( $datos, $peticion )
 {
        if ( $datos ) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades( $datos, $campos );

            $idCiud = htmlspecialchars( strip_tags( $datos->idCiud ) );

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
                //$consulta = 'UPDATE ' . self::NOMBRE_TABLA . " SET $setClause WHERE " . self::OSNUMDOC . ' = :osNumDoc AND ' . self::OSEJERCICIO . ' = :osEjercicio';
                $consulta = 'UPDATE ' . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::ID_CIUD . ' = :idCiud AND ' . self::CLAVE_INE . ' = :claveINE )';
                //$consulta = 'UPDATE ' . self::NOMBRE_TABLA . " SET $setClause WHERE (" . self::CLAVE_INE . ' = :claveINE)';

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $consulta );

                // Bind de los parámetros
                foreach ( $bindParams as $param => &$value ) {
                    $sentencia->bindParam( $param, $value, PDO::PARAM_STR );
                }

                $sentencia->bindParam( ':idCiud', $idCiud, PDO::PARAM_STR );
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
            $whereId = !empty( $id ) ? ' WHERE ' . self::ID_CIUD . '= :idCiud' : '';

            //$comando = 'SELECT * FROM ' . self::NOMBRE_TABLA . $whereId;
            //$comando = self::SELECT_STRING. self::NOMBRE_TABLA . self::INNER_STRING . $whereId . ' order by osNumDoc asc';
            $comando = self::SELECT. self::NOMBRE_TABLA . $whereId . ' order by idCiud desc';
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare( $comando );

            if ( !empty( $id ) ) {
                $sentencia->bindParam( ':idCiud', $id, PDO::PARAM_INT );
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
    private static function getAllFiltered($peticion)
    {
        if ($peticion != "filtro") {
            throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "No existe el servicio " . $peticion);
        }

        $filtro = UtilidadesApi::obtenerInstancia()->validaFiltros(self::CAMPOS);

        $consulta = self::SELECT. self::NOMBRE_TABLA . $filtro['where'] . " order by idCiud desc";

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
