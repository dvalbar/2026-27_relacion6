<?php
error_reporting(0);

date_default_timezone_set("Europe/Madrid");

define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO", "desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);

// Clases
spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/aplicacion/clases/curso2026/"; // Ruta donde se ubican nuestras clases
    $fichero = $ruta . "$clase.php";

    if (file_exists($fichero)) {
        require_once($fichero);
    } else {
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

include(RUTABASE . "/aplicacion/plantilla/plantilla.php");
require_once(RUTABASE . "/scripts/librerias/validacion.php"); // Incluir libreria validacion.php

// Creo todos los objetos que necesita mi aplicación

// Ya que no hemos visto todavía ningún método para almacenar datos de forma permanente, vamos
// a definir un array indexado (posiciones a partir de 1) con 5 muebles
// (MuebleReciclado/MuebleTradicional). Cada mueble tendrá al menos dos características adicionales
// a las básicas. Definir este array en un único punto de forma que esté accesible en todas las páginas.