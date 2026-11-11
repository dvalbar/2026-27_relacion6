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

// Muebles de la tienda
$mueble1 = new MuebleReciclado("Silla", "FaMu:Antequera", "España", 2026, "01/01/2026", "31/12/2035", 39.99, 20);
$mueble1->anadirCaracteristicas("color", "verde", "patas", 4);

$mueble2 = new MuebleReciclado("Mesa", "FaMu:Eco", "Portugal", 2023, "15/03/2023", "31/12/2034", 120, 65);
$mueble2->anadirCaracteristicas("material", "palet", "extensible", true);

$mueble3 = new MuebleTradicional("Sofá", "FaMu:Pisa", "Italia", 2021, "01/06/2021", "31/12/2040", 450.5, 80, "S02");
$mueble3->anadirCaracteristicas("plazas", 3, "tapizado", "terciopelo");

$mueble4 = new MuebleTradicional("Estantería", "FaMu:GrupoSeys", "España", 2022, "01/01/2022", "31/12/2038", 95, 35.5, "S15");
$mueble4->anadirCaracteristicas("baldas", 5, "color", "roble");

$mueble5 = new MuebleTradicional("Armario", "Eiffel", "Francia", 2020, "01/03/2020", "31/12/2040", 280, 150, "S07");
$mueble5->anadirCaracteristicas("puertas", 3, "espejo", true, "color", "blanco");

// Array indexado con posiciones a partir de 1
$mueblesTienda = [
    1 => $mueble1,
    2 => $mueble2,
    3 => $mueble3,
    4 => $mueble4,
    5 => $mueble5
];
