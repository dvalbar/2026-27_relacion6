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

$miMueble = new MuebleBase("David");

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($miMueble);  //llamo a la vista
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
function cuerpo($miMueble)
{
?>
    <br>
    <h3>Pruebas Relación 6.</h3>
<?php

    echo "<h4>Clase MuebleBase (Abstracta)</h4>" . PHP_EOL;

    echo $miMueble . PHP_EOL;

    // Seguir haciendo pruebas TO-DO
}

// Aqui escribiremos las funciones