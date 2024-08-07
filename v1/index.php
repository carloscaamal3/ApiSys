<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, PUT, POST, HEAD, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Jwt, Rft, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "vistas/VistaJson.php";
require "vistas/VistaXML.php";
require "utilidades/ExcepcionApi.php";
require "utilidades/UtilidadesApi.php";
require "utilidades/Validador.php";

//COMUNES
require "modelos/usuarios.php";
require "modelos/tokens.php";
require "modelos/Password.php";
require "modelos/generales.php";

require "modelos/sistema.php";
require "modelos/clastipo.php";
require "modelos/consultas.php";
require "modelos/cuentas.php";
require "modelos/empleado.php";
require "modelos/proveedor.php";
require "modelos/tipo.php";
//require "modelos/facturas.php";


//SICF
require "modelos/sicf/casosesp.php";
require "modelos/sicf/solpagos.php";
require "modelos/sicf/folios.php";

//SICA
require "modelos/sica/concomite.php";
require "modelos/sica/producto.php";
require "modelos/sica/vehiculo.php";
require "modelos/sica/ordenes.php";
require "modelos/sica/factura.php";
require "modelos/sica/envioCorreo.php";
require "modelos/sica/seguimiento.php";
require "modelos/sica/prodLista.php";

// Constantes de estado
const ESTADO_URL_INCORRECTA = 2;
const ESTADO_EXISTENCIA_RECURSO = 3;
const ESTADO_METODO_NO_PERMITIDO = 4;

// Preparar manejo de excepciones
$formato = isset($_GET['formato']) ? $_GET['formato'] : 'json';

//Determina el formato en el que sera devuelta la respuesta
switch ($formato) {
    case 'xml':
        $vista = new VistaXML();
        break;
    case 'json':
    default:
        $vista = new VistaJson();
}

// Se define el manejo de excepciones personalizado.
set_exception_handler(
    function ($exception) use ($vista) {
        $cuerpo = array(
            "estado" => $exception->estado,
            "mensaje" => $exception->getMessage()
        );
        if ($exception->getCode()) {
            $vista->estado = $exception->getCode();
        } else {
            $vista->estado = 500;
        }
        $vista->imprimir($cuerpo);
    }
);

// Extraer segmento de la url
if (isset($_GET['PATH_INFO'])) { //Existe una ruta
    $peticion = explode('/', $_GET['PATH_INFO']); //crea un arreglo con la peticion (login, registro)
} else { //No existe una ruta
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));
}

// Obtener recurso
$recurso = array_shift($peticion); //Toma el primer elemento del array para obtener el recurso  en este caso usuarios o contactos
//VV=========AQUI SE CONFIGURAN LOS RECURSOS=========VV//
//$recursos_existentes = ['usuarios', 'tipo', 'tokens', 'password', 'clastipo', 'proveedor', 'cuentas', 'empleado', 'solpagos','consulta','folios','estatus','casosEsp','generales','rel_cuentas'];
$recursos_existentes = ['usuarios', 'tipo', 'tokens', 'password', 'clastipo', 'proveedor', 
'cuentas', 'empleado', 'solpagos','consulta','folios','casosEsp','generales','sistema',
'vehiculo','producto','concomite','ordensica','factura','envioCorreo','seguimiento','productoLista'];
// Comprobar si existe el recurso
if (!in_array($recurso, $recursos_existentes)) { //Si la API no cuenta con el recurso solicitado envia un mensaje
    throw new ExcepcionApi(ESTADO_EXISTENCIA_RECURSO, "No se reconoce el recurso al que intentas acceder", 404);
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']); //Toma el metodo (GET, POST, PUT, DELETE)
switch ($metodo) {
    case 'options':
        http_response_code(204);
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, HEAD, OPTIONS, DELETE');
        header('Access-Control-Allow-Headers: Jwt, Rft, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        break;
    case 'get':
        // $vista->imprimir(contactos::get($peticion));
        //break;
    case 'post':
        //Envia el arreglo sin el primer elemento
        // $vista->imprimir(usuarios::post($peticion));
        //break;
    case 'put':
        // Procesar método put
        //break;
    case 'delete':
        // Procesar método delete
        // Generalizacion de metodos, se llama  ej: (Se llama al metodo get de la clase contacto y se pasa la peticion de parametro
        if (method_exists($recurso, $metodo)) {
            // $respuesta = call_user_func(array($recurso, $metodo), $peticion);
            $respuesta = call_user_func(array(ucfirst($recurso), $metodo), $peticion);

            $vista->imprimir($respuesta);
            break;
        }
        // no break
    default:
        // Método no aceptado
        $vista->estado = 405;
        $cuerpo = [
            "estado" => ESTADO_METODO_NO_PERMITIDO,
            "mensaje" => "Método no permitido"
        ];
        $vista->imprimir($cuerpo);
}
