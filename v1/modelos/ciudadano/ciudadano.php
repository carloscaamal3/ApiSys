<?php
class ciudadano{

    const NOMBRE_TABLA = "ciudadanoInfo";
    const ID_CIUD = "idCiud";
    const NOMBRE = "nombreCom";
    const CLAVE_INE = "claveINE";
    const DIRECCION = "direccion";
    const COLONIA = "colonia";
    const SECCION = "seccion";
    const MUNICIPIO = "municipio";
    const CREADO_POR = "creado_por";
    const CRADO_EL = "creado_el";

    const CAMPOS_OS_COMPRAS_DET = array(
    
        self::ID_CIUD,
        self::NOMBRE ,
        self::CLAVE_INE,
        self::DIRECCION,
        self::COLONIA,
        self::SECCION,
        self::MUNICIPIO,
        self::CREADO_POR,
        self::CREADO_EL,
    
    );

    //CODIGOS DE ERROR
    const CODIGO_EXITO = 1;
    const ESTADO_EXITO = 1;
    const ESTADO_ERROR = 2;
    const ESTADO_ERROR_BD = 3;
    const ESTADO_ERROR_PARAMETROS = 4;
    const ESTADO_NO_ENCONTRADO = 5;



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
            //inserta registro sin importar los campos enviados
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

    private static function crearCampo($idUsuario)
{
    $body = file_get_contents('php://input');
    $datos = json_decode($body);

    if ($datos) {
        $campos = self::CAMPOS;
        UtilidadesApi::obtenerInstancia()->compruebaPropiedades($datos, $campos);

        // Define los campos permitidos y sus valores predeterminados
        $camposPermitidos = [

            self::ID_CIUD => null,
            self::NOMBRE  => null,
            self::CLAVE_INE => null,
            self::DIRECCION => null,
            self::COLONIA => null,
            self::SECCION => null,
            self::MUNICIPIO => null,
            self::CREADO_POR => $idUsuario,
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


}
