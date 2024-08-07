<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('America/Merida');
 
// variables used for jwt
$key = "example_key";
$iss = "http://example.org";
$aud = "https://shuttleexpressmexico.com.mx";
$iat = 1356999524;
$nbf = 1357000000;
$urlImages = "https://api.shuttleexpressmexico.com.mx/imagenes/";
