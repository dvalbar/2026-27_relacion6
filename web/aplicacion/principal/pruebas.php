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

// PRUEBAS MUEBLEBASE

// Array donde guardar los muebles de prueba
// $resultados = [];

// // Valores por defecto y todos los valores
// $resultados[] = new MuebleBase("Sofá");
// $resultados[] = new MuebleBase("Mesa", "Ikea", "Francia", 2022, "15/3/2022", "31/12/2030", 150.5);

// // Valores incorrectos: deben quedar los de por defecto
// $resultados[] = new MuebleBase("Silla", "", "aaaaaaaaaaaaaaaaaaa", 2010, "01/01/2015", "01/01/2010", 5);

// // Set: true/false
// $resultados[] = "setNombre('') -> " . var_export($resultados[0]->setNombre(""), true);
// $resultados[] = "setPrecio(10) -> " . var_export($resultados[0]->setPrecio(10), true);

// // Nombre vacío: debe lanzar excepción
// try {
//     new MuebleBase("");
// } catch (Exception $e) {
//     $resultados[] = "Error: " . $e->getMessage();
// }

// // Propiedad dinámica: debe lanzar excepción
// try {
//     $resultados[0]->color = "rojo";
// } catch (Exception $e) {
//     $resultados[] = "Error: " . $e->getMessage();
// }

// // Límite de muebles: debe lanzar excepción al llegar a 10
// try {
//     while (true) {
//         new MuebleBase("Relleno");
//     }
// } catch (Exception $e) {
//     $resultados[] = "Error: " . $e->getMessage();
// }

// $misMuebles = ["resultados" => $resultados];

// ==========================================================================================================================================
// PRUEBAS MUEBLE_RECICLADO Y MUEBLE_TRADICIONAL

$mueblesHijos[] = new MuebleReciclado("Banco", "Eco", "Italia", 2021, "01/06/2021", "31/12/2035", 80, 150);
$mueblesHijos[] = new MuebleReciclado("Estante", porcentajeReciclado: 50);

$mueblesHijos[] = new MuebleTradicional("Cómoda", peso: 500);
$mueblesHijos[] = new MuebleTradicional("Baúl", peso: 100, serie: "S99");

$mueblesHijos[] = "Propiedades: " . implode(", ", $mueblesHijos[0]->damePropiedadesAdicionales());
$mueblesHijos[] = "Propiedades: " . implode(", ", $mueblesHijos[2]->damePropiedadesAdicionales());

$misMuebles = ["mueblesHijos" => $mueblesHijos];

// ==========================================================================================================================================
// PRUEBAS CARACTERISTICAS

$caracteristicas = new Caracteristicas();

$caracteristicas->color = "rojo";
$caracteristicas->precio = 300;

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($misMuebles, $caracteristicas);  //llamo a la vista
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
function cuerpo($misMuebles, $caracteristicas)
{
?>
    <br>
    <h3>Pruebas Relación 6.</h3>
<?php

    // echo "<h4>Clase MuebleBase (Abstracta)</h4>" . PHP_EOL;

    // Pruebas MuebleBase
    // foreach ($misMuebles["resultados"] as $value) {
    //     echo $value . "<br><br>" . PHP_EOL;
    // }

    echo "<h4>Clase MuebleReciclado y MuebleTradicional</h4>" . PHP_EOL;

    // Pruebas MuebleReciclado y MuebleTradicional
    foreach ($misMuebles["mueblesHijos"] as $value) {
        echo $value . "<br><br>" . PHP_EOL;
    }

    echo "<h4>Clase Caracteristicas</h4>" . PHP_EOL;

    echo $caracteristicas->color . "<br>" . PHP_EOL;
    echo $caracteristicas->precio . "<br>" . PHP_EOL;

    try {
        echo $caracteristicas->inventada;
    } catch (Exception $e) {
        echo $e->getMessage() . "<br>" . PHP_EOL;
    }

    echo $caracteristicas . "<br>" . PHP_EOL;
}

// Aqui escribiremos las funciones