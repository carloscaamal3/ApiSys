<?php
/**
 * Created by PhpStorm.
 * User: pillo
 * Date: 28/06/17
 * Time: 12:07
 */

abstract class VistaApi{

    // Código de error
    public $estado;

    public abstract function imprimir($cuerpo);
}