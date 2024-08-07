<?php

/**
 * Utilerias para el funcionamiento de la API que valida se cumplan todas
 * las condiciones para el buen funcionamiento, enviando informacion en caso
 * de éxito o fracaso.
 *
 * @author José Antonio Rodriguez Barceló <rbsistemas@hotmail.com>
 */
class UtilidadesApi
{
    private static $utilidad = null;

    final private function __construct()
    {
    }

    public static function obtenerInstancia()
    {
        if (self::$utilidad === null) {
            self::$utilidad = new self();
        }
        return self::$utilidad;
    }

    /**
     * Comprueba las propiedades del objeto
     *
     * Comprueba que el objeto recibido en el body tenga las propiedades requeridas por la API para brindar el servicio.
     *
     * @param object $objeto Contiene el objeto recibido en el body con sus propiedades (key) y valores (value)
     * @param array $propiedades Contiene las propiedades requeridas para el servicio de la API que se va a
     * @return void
     */
    public function compruebaPropiedades($objeto, $propiedades): void
    {
        $arreglo = (array) $objeto;

        foreach (array_keys($arreglo) as $key) {
            if (!in_array($key, $propiedades)) {
                throw new ExcepcionApi(4, "Error en los parámetros recibidos, no existe " . $key);
            }
        }
        return;
    }

    /**
     * Verifica que los filtros sean válidos tanto en los parametros requeridos como en el campo \n
     * a utilizar en el criterio de filtrado
     *
     * @param object $filtro Contiene las propiedades necesarias para realizar el filtrado
     * @param array $campos Contiene los campos de la tabla
     * @return bool Devuelve false si no se cumplieron las validaciones y true en caso contrario
     */
    public function validaFiltros($campos)
    {
      //Verifica que existan los campos necesarios para un filtrado
      $campo1 = filter_has_var(INPUT_GET, 'campo1') ? filter_input(INPUT_GET, 'campo1', FILTER_SANITIZE_STRING) : '';
      $tipo1 = filter_has_var(INPUT_GET, 'tipo1') ? filter_input(INPUT_GET, 'tipo1', FILTER_SANITIZE_STRING) : '';
      $valor1 = filter_has_var(INPUT_GET, 'valor1') ? filter_input(INPUT_GET, 'valor1', FILTER_SANITIZE_STRING) : '';

      $logico2 = filter_has_var(INPUT_GET, 'logico2') ? filter_input(INPUT_GET, 'logico2', FILTER_SANITIZE_STRING) : '';
      $campo2 = filter_has_var(INPUT_GET, 'campo2') ? filter_input(INPUT_GET, 'campo2', FILTER_SANITIZE_STRING) : '';
      $tipo2 = filter_has_var(INPUT_GET, 'tipo2') ? filter_input(INPUT_GET, 'tipo2', FILTER_SANITIZE_STRING) : '';
      $valor2 = filter_has_var(INPUT_GET, 'valor2') ? filter_input(INPUT_GET, 'valor2', FILTER_SANITIZE_STRING) : '';

      $logico3 = filter_has_var(INPUT_GET, 'logico3') ? filter_input(INPUT_GET, 'logico3', FILTER_SANITIZE_STRING) : '';
      $campo3 = filter_has_var(INPUT_GET, 'campo3') ? filter_input(INPUT_GET, 'campo3', FILTER_SANITIZE_STRING) : '';
      $tipo3 = filter_has_var(INPUT_GET, 'tipo3') ? filter_input(INPUT_GET, 'tipo3', FILTER_SANITIZE_STRING) : '';
      $valor3 = filter_has_var(INPUT_GET, 'valor3') ? filter_input(INPUT_GET, 'valor3', FILTER_SANITIZE_STRING) : '';


      //var_dump($campo1 . $tipo1 . $valor1 );

      if (empty($campo1) || empty($tipo1) || $valor1=="") {
          throw new ExcepcionApi(2, "Error en el nombre de los parámetros de filtrado", 400);
      }

      //Verifica que este correcto el tipo de filtrado
      $tipos = array('igual', 'diferente', 'empieza', 'contiene');
      $logicos = array('and', 'or', 'xor', 'not');

      if (!in_array($tipo1, $tipos)) {
          throw new ExcepcionApi(2, "El tipo de filtrado '" . $tipo1 . "' no existe");
      }

      //Verifica que el campo a filtrar existe en la tabla
      if (!in_array($campo1, $campos)) {
          throw new ExcepcionApi(2, "El campo del filtro '" . $campo1 . "' no existe");
      }


      if ($logico2 <> '') {
          if (!in_array($logico2, $logicos)) {
              throw new ExcepcionApi(2, "El logico de filtrado '" . $logico2 . "' no existe");
          }
          //var_dump($valor2);
          if (empty($campo2) || empty($tipo2) || $valor2 =="") {
              throw new ExcepcionApi(2, "Error en el nombre de los parámetros de filtrado 2", 400);
          }
          if (!in_array($campo2, $campos)) {
              throw new ExcepcionApi(2, "El campo del filtro '" . $campo2 . "' no existe");
          }
      }
      if ($logico3 <> '') {
        if (!in_array($logico3, $logicos)) {
            throw new ExcepcionApi(2, "El logico de filtrado '" . $logico3 . "' no existe");
        }
        //var_dump($valor2);
        if (empty($campo3) || empty($tipo3) || $valor3 =="") {
            throw new ExcepcionApi(2, "Error en el nombre de los parámetros de filtrado 3", 400);
        }
        if (!in_array($campo3, $campos)) {
            throw new ExcepcionApi(2, "El campo del filtro '" . $campo3 . "' no existe");
        }
    }


      $whereCampo = " WHERE LOWER(" . $campo1 . ") ";
      $whereCampo .= $this->obtieneWhere($tipo1, $valor1);
      if ($logico2 <> '') {
          $whereCampo .= " " . $logico2 . " LOWER(" . $campo2 . ") ";
          $whereCampo .= $this->obtieneWhere($tipo2, $valor2);
      }
      if ($logico3 <> '') {
        $whereCampo .= " " . $logico3 . " LOWER(" . $campo3 . ") ";
        $whereCampo .= $this->obtieneWhere($tipo3, $valor3);
    }

      //var_dump($whereCampo);
      return array(
          "campo" => $campo1,
          "tipo" => $tipo1,
          "valor" => $valor1,
          "where" => $whereCampo
      );
    }

    private function obtieneWhere($tipo, $valor)
    {
        $whereCampo = "";
        $valor = (is_numeric($valor)) ? $valor : strtolower($valor);

        switch ($tipo) {
            case 'igual':
                $whereCampo .= " = '" . $valor . "'";
                break;
            case 'diferente':
                $whereCampo .= " <> '" . $valor  . "'";
                break;
            case 'empieza':
                $whereCampo .= " LIKE '" . $valor . "%'";
                break;
            default:
                $whereCampo .= " LIKE '%" . $valor . "%'";
                break;
        }
        return $whereCampo;
    }

    /**
     * validaPwdStrong.- Valida que la contraseña cumpla las reglas de fuerza definidas
     *
     * @param [string] $contrasena Contiene la contraseña a ser validada
     * @param [string] $mensaje Variable referenciada para enviar el mensaje resultado del método
     * @return bool
     */
    public function validaPwdStrong($contrasena, &$mensaje)
    {
        if (strlen($contrasena) < 6) {
            $mensaje = "La contraseña debe tener al menos 6 caracteres";
            return false;
        }
        if (strlen($contrasena) > 15) {
            $mensaje = "La contraseña no puede tener más de 15 caracteres";
            return false;
        }
        if (!preg_match('`[a-z]`', $contrasena)) {
            $mensaje = "La contraseña debe tener al menos una letra minúscula";
            return false;
        }
        if (!preg_match('`[A-Z]`', $contrasena)) {
            $mensaje = "La clave debe tener al menos una letra mayúscula";
            return false;
        }
        if (!preg_match('`[0-9]`', $contrasena)) {
            $mensaje = "La clave debe tener al menos un caracter numérico";
            return false;
        }
        $mensaje = "";
        return true;
    }

     /**
     * validaCorreoElectronico: Valida que el correo tenga un formato valido
     *
     * @param [string] $correo Contiene el correo electrónico que se valida.
     * @param [string] $mensaje Variable referenciada que envia el mensaje del resultado
     * @return bool true (si es valido el correo) ó false (si es invalido el correo)
     */
    public function validaCorreoElectronico($correo, &$mensaje = "")
    {
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL) !== false) {
            $mensaje = "Correo electrónico invalido";
            return false;
        }
        return true;
    }

    public function uuid(){
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    final protected function __clone()
    {
    }
}
