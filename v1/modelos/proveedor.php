<?PHP
class Proveedor
{
    const NOMBRE_TABLA = "proveedor";
    //const NOMBRE_TABLA_INNER_1 = "cat_tipo";
    const PROV_ID = "prov_id";

    const PROV_RAZON_SOCIAL = "prov_razon_social";
    const PROV_TIPO = "prov_tipo";

    const PROV_RFC = "prov_RFC";
    const PROV_EMPRESAYUC = "prov_empresayuc";
    const PROV_NUMREGPADPROV = "prov_NumRegPadProv";
    const PROV_ACTIVO = "prov_activo";
    const PROV_CREADO_POR = "prov_creado_por";
    const PROV_CREADO_EL = "prov_creado_el";
    const PROV_MODIFICADO_POR = "prov_modificado_por";
    const PROV_MODIFICADO_EL = "prov_modificado_el";

    const PROV_EMAIL = "prov_email";
    const PROV_EMAIL2 = "prov_email2";

    const PROV_DIRECCION = "prov_direccion";
    const PROV_CIUDAD = "prov_ciudad";

    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;

    const CAMPOS = array(
        self::PROV_ID,
        self::PROV_RAZON_SOCIAL,
        self::PROV_TIPO,
        self::PROV_RFC,
        self::PROV_EMPRESAYUC,
        self::PROV_NUMREGPADPROV,
        self::PROV_ACTIVO,
        self::PROV_EMAIL,
        self::PROV_EMAIL2,
        self::PROV_DIRECCION,
        self::PROV_CIUDAD
    );

    const SELECT = "select p.prov_id, p.prov_razon_social,p.prov_tipo,
    t.tipo_descripcion,
    p.prov_RFC, p.prov_empresayuc, p.prov_NumRegPadProv,
    p.prov_activo,p.prov_creado_por,p.prov_creado_el,
    p.prov_modificado_por,p.prov_modificado_el,  
    ifnull(p.prov_direccion,'') as prov_direccion ,
    ifnull(p.prov_ciudad,'') as prov_ciudad,  
    ifnull(p.prov_email,'') as prov_email, 
    ifnull(p.prov_email2,'') as prov_email2 from ";

    const INNER = " p inner join tipo t on p.prov_tipo = t.tipo_clave and t.clatip_id = 'TIPPROV'";
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //METODOS
    ////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Método GET Obtiene uno o varios registros de la tabla de entidad
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

        $id = self::crear($idUsuario);

        http_response_code(201);
        return [
            "estado" => self::CODIGO_EXITO,
            "mensaje" => "¡Registro creado con éxito!",
            "id" => $id
        ];
    }
    /**
     * Método PUT Actualiza una entidad en la base de datos
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
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambios", 200);
                }
                break;
            case 'putCorreo':
                if (!empty($peticion[0])) {
                    $body = file_get_contents('php://input');
                    $datos = json_decode($body);
        
                    if (self::actualizarMail($datos, $peticion[1], $idUsuario) > 0) {
                        http_response_code(200);
                        return [
                            "estado" => self::CODIGO_EXITO,
                            "mensaje" => "Correos actualizado correctamente"
                        ];
                    }
                    throw new ExcepcionApi(self::ESTADO_NO_ENCONTRADO, "El registro al que intentas acceder no existe o no cambios", 200);
                }
                break;
            default:
            throw new ExcepcionApi(self::ESTADO_URL_INCORRECTA, "Url mal formada", 400);
            break;
        }
        
        throw new ExcepcionApi(self::ESTADO_ERROR_PARAMETROS, "Falta información", 422);
    }


    /**
     * Método delete Inactiva una entidad en la base de datos
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
                    "mensaje" => "El proveedor ha sido eliminado con exito"
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
     * Obtiene uno o varios registros de entidad de acuerdo a el parametro recibido
     *
     * @param [int] $id Contiene el id de la entidad que se desea obtener (vacio si se quieren todos los tipos)
     * @return array Devuelve un array con los registros resultado de la búsqueda
     */
    private static function obtener($id = null)
    {
        try {
            $whereId = !empty($id) ? " WHERE " . self::PROV_ID . "= :prov_id" : "";

            //$comando = "SELECT * FROM " . self::NOMBRE_TABLA . $whereId;

            $comando = self::SELECT . self::NOMBRE_TABLA . self::INNER . $whereId . " order by p.prov_razon_social";

            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);

            if (!empty($id)) {
                $sentencia->bindParam(":prov_id", $id, PDO::PARAM_INT);
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
     * Obtiene uno o varios registros de entidad de acuerdo a criterios de filtrado
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

        //$consulta = "SELECT * FROM " . self::NOMBRE_TABLA . $filtro['where'] . " order by prov_razon_social";
        $consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER . $filtro['where']  . " order by p.prov_razon_social";


        //$consulta = self::SELECT . self::NOMBRE_TABLA . self::INNER . $filtro['where'] + " order by prov_razon_social";
        //$consulta = "SELECT ent.*, tipo.tipo_nombre FROM " . self::NOMBRE_TABLA . " as ent inner join " . self::NOMBRE_TABLA_INNER_1 . " as tipo on ent.id_tipo = tipo.id_tipo "
        //. $filtro['where'];

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
     * Crea un entidad en la base de datos
     *
     * @param [integer] $idUsuario Contiene el id del usuario que crea la entidad
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
            $provRazonSocial = htmlspecialchars(strip_tags($datos->prov_razon_social));
            $provTipo = htmlspecialchars(strip_tags($datos->prov_tipo));

            $provRFC = htmlspecialchars(strip_tags($datos->prov_RFC));
            $provEmpresaYuc = htmlspecialchars(strip_tags($datos->prov_empresayuc));
            $provNumRegPadProv = htmlspecialchars(strip_tags($datos->prov_NumRegPadProv));

            $provEmail = htmlspecialchars(strip_tags($datos->prov_email));
            $provEmail2 = htmlspecialchars(strip_tags($datos->prov_email2));

            $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
            $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));

            $CreadoPor = $idUsuario;
            try {
                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                $comando = "INSERT INTO " . self::NOMBRE_TABLA . " ( " .
                    self::PROV_RAZON_SOCIAL . ", " .
                    self::PROV_TIPO . ", " .
                    self::PROV_RFC . ", " .
                    self::PROV_EMPRESAYUC . ", " .
                    self::PROV_NUMREGPADPROV . ", " .
                    self::PROV_EMAIL . ", " .
                    self::PROV_EMAIL2 . ", " .
                    self::PROV_DIRECCION . ", " .
                    self::PROV_CIUDAD . ", " .
                    self::PROV_CREADO_EL . ", " .
                    self::PROV_CREADO_POR . ")" .
                    " VALUES(:prov_razon_social,:prov_tipo,:prov_RFC,:prov_empresayuc,:prov_NumRegPadProv,:prov_email,:prov_email2,:prov_direccion,:prov_ciudad,CURRENT_TIMESTAMP(6),:prov_creado_por)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);
                $sentencia->bindParam(":prov_razon_social", $provRazonSocial, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_tipo", $provTipo, PDO::PARAM_STR);
                
                $sentencia->bindParam(":prov_RFC", $provRFC, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_empresayuc", $provEmpresaYuc, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_NumRegPadProv", $provNumRegPadProv, PDO::PARAM_STR);                

                $sentencia->bindParam(":prov_email", $provEmail, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_email2", $provEmail2, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_creado_por", $CreadoPor, PDO::PARAM_INT);
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

            $provRazonSocial = htmlspecialchars(strip_tags($datos->prov_razon_social));
            $provTipo = htmlspecialchars(strip_tags($datos->prov_tipo));
            $provActivo = htmlspecialchars(strip_tags($datos->prov_activo));

            $provRFC = htmlspecialchars(strip_tags($datos->prov_RFC));
            $provEmpresaYuc = htmlspecialchars(strip_tags($datos->prov_empresayuc));
            $provNumRegPadProv = htmlspecialchars(strip_tags($datos->prov_NumRegPadProv));

            $provEmail = htmlspecialchars(strip_tags($datos->prov_email));
            $provEmail2 = htmlspecialchars(strip_tags($datos->prov_email2));

            $provDireccion = htmlspecialchars(strip_tags($datos->prov_direccion));
            $provCiudad = htmlspecialchars(strip_tags($datos->prov_ciudad));


            //var_dump($provRFC);

            $ModificadPor = $idUsuario;

            try {
                // Creando consulta UPDATE
                $consulta = "UPDATE " . self::NOMBRE_TABLA .
                    " SET " . self::PROV_RAZON_SOCIAL . "= :prov_razon_social, " .
                    self::PROV_TIPO . "= :prov_tipo, " .
                    self::PROV_RFC . "= :prov_RFC, " .
                    self::PROV_EMPRESAYUC . "= :prov_empresayuc, " .
                    self::PROV_EMAIL . "= :prov_email, " .
                    self::PROV_EMAIL2 . "= :prov_email2, " .
                    self::PROV_DIRECCION . "= :prov_direccion, " .
                    self::PROV_CIUDAD . "= :prov_ciudad, " .
                    self::PROV_NUMREGPADPROV . "= :prov_NumRegPadProv, " .
                    self::PROV_ACTIVO . "= :prov_activo, " .
                    self::PROV_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6), " .
                    self::PROV_MODIFICADO_POR . "= :prov_modificado_por " .
                    " WHERE " . self::PROV_ID . "= :prov_id";

                // Preparar la sentencia
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":prov_razon_social", $provRazonSocial, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_tipo", $provTipo, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_RFC", $provRFC, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_empresayuc", $provEmpresaYuc, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_NumRegPadProv", $provNumRegPadProv, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_email", $provEmail, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_email2", $provEmail2, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_direccion", $provDireccion, PDO::PARAM_STR);
                $sentencia->bindParam(":prov_ciudad", $provCiudad, PDO::PARAM_STR);

                $sentencia->bindParam(":prov_activo", $provActivo, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_modificado_por", $ModificadPor, PDO::PARAM_INT);
                $sentencia->bindParam(":prov_id", $id, PDO::PARAM_INT);
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
     * Cambia el valor del campo activo de una Entidad a cero para desactivarlo
     *
     * @param [integer] $idTipo Contiene el id del tipo que desea desactivarse
     * @return integer Devuelve el número de lineas obtenidas al ejecutar la consulta.
     * (0.- si no encontro el registro o no se hicieron cambios. 1.- si se realizaron cambios)
     */
    private static function eliminar($id, $idUsuario)
    {
        $ModificadPor = $idUsuario;

        $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::PROV_ACTIVO . " = 0, " .
            self::PROV_MODIFICADO_POR . "= :prov_modificado_por, " .
            self::PROV_MODIFICADO_EL . "= CURRENT_TIMESTAMP(6) " .
            " WHERE " . self::PROV_ID . " = :prov_id";

        try {
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
            $sentencia->bindParam(":prov_id", $id, PDO::PARAM_INT);
            $sentencia->bindParam(":prov_modificado_por", $ModificadPor, PDO::PARAM_INT);
            $sentencia->execute();

            return $sentencia->rowCount();
        } catch (PDOException $e) {
            throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
        }
    }
    private static function actualizarMail($datos, $id, $idUsuario)
    {
        if ($datos) {
            $campos = self::CAMPOS;
            UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

            $prov_email = htmlspecialchars(strip_tags($datos->prov_email));
            $prov_email2 = htmlspecialchars(strip_tags($datos->prov_email2));
            $ModificadPor = $idUsuario;

            $consulta = "UPDATE " . self::NOMBRE_TABLA .
            " SET " . self::PROV_EMAIL . " = :prov_email, " .
            self::PROV_EMAIL2 . " = :prov_email2, " .
            self::PROV_MODIFICADO_EL . " = CURRENT_TIMESTAMP(6), " .
            self::PROV_MODIFICADO_POR . " =  :modificado_por" .
            " WHERE " . self::PROV_ID . " = :prov_id";
            
            try {
                $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($consulta);
                $sentencia->bindParam(":prov_email", $prov_email, PDO::PARAM_STR);
                 $sentencia->bindParam(":prov_email2", $prov_email2, PDO::PARAM_STR);
                $sentencia->bindParam(":modificado_por", $ModificadPor, PDO::PARAM_INT);

                $sentencia->bindParam(":prov_id", $id, PDO::PARAM_INT);
                $sentencia->execute();
                return $sentencia->rowCount();
            } catch (PDOException $e) {
                throw new ExcepcionApi(self::ESTADO_ERROR_BD, $e->getMessage(), 400);
            }
        }
    }
}//Fin de Clase
