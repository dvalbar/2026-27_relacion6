<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barraUbi =
    [
        [
            "nombre" => "Inicio",
            "enlace" => "/index.php"
        ],
        [
            "nombre" => "Principal",
            "enlace" => "/aplicacion/principal/pruebas.php"
        ],
        [
            "nombre" => "Pruebas",
        ]
    ];

// PRUEBAS MUEBLEBASE ABSTRACTA

$error = "";

// $miMueble1 = new MuebleBase("David");

// try {
//     $miMueble2 = new MuebleBase("Pepe");
// } catch (Exception $e) {
//     $error = $e->getMessage();
// }

$misMuebles = [
    // "miMueble1" => $miMueble1,
    // "miMueble2" => $miMueble2 ?? null,
    "error" => $error
];

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($misMuebles);  //llamo a la vista
finCuerpo();
// **********************************************************


//vista
function cabecera()
{
    // Fin del PHP
?>
    <!-- Esto va en el HEAD -->
<?php
    // Inicio del PHP
}

//vista
function cuerpo($misMuebles)
{
?>
    <br>
    <h3>Pruebas Relación 6.</h3>
<?php

    echo "<h4>Clase MuebleBase (Abstracta)</h4>" . PHP_EOL;

    echo $misMuebles["miMueble1"] . "<br>" . PHP_EOL;

    if ($misMuebles["miMueble2"] !== null) {
        echo $misMuebles["miMueble2"] . "<br>" . PHP_EOL;
    }

    if ($misMuebles["error"] !== "") {
        echo "<p>Error: " . $misMuebles["error"] . "</p>";
    }
}

// Aqui escribiremos las funciones