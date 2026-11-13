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

$muebles = [
    new MuebleReciclado("Banco", "Eco", "Italia", 2021, "01/06/2021", "31/12/2035", 80.58, 150),
    new MuebleReciclado("Estante", porcentajeReciclado: 50),
    new MuebleTradicional("Cómoda", peso: 500),
    new MuebleTradicional("Baúl", peso: 100, serie: "S99")
];

$propiedades = [
    "Propiedades de MuebleReciclado: " . implode(", ", $muebles[0]->damePropiedadesAdicionales()),
    "Propiedades de MuebleTradicional: " . implode(", ", $muebles[2]->damePropiedadesAdicionales())
];

// ==========================================================================================================================================
// PRUEBAS CARACTERISTICAS

// Objeto normal (sin cerrar) para probar get, foreach y toString
$caracteristicas = new Caracteristicas();
$caracteristicas->color = "rojo";
$caracteristicas->precio = 300;
$caracteristicas->saliente = true;

// Característica que no existe: debe lanzar excepción
$errorInventada = "";
try {
    echo $caracteristicas->inventada;
} catch (Exception $e) {
    $errorInventada = $e->getMessage();
}

// ==========================================================================================================================================
// PRUEBAS ULTIMA

$cerradas = new Caracteristicas();
$cerradas->color = "rojo";
$cerradas->ULTIMA = "fin";   // Aquí se cierra la lista
$cerradas->color = "azul";   // Modificar una existente: debe dejar

$erroresUltima = [];

try {
    $cerradas->nueva = 1;    // Nueva caracteristica con la lista cerrada: debe lanzar excepción
} catch (Exception $e) {
    $erroresUltima[] = $e->getMessage();
}

try {
    $cerradas->ultima = "x"; // En minúsculas es una nueva: también debe lanzar excepción
} catch (Exception $e) {
    $erroresUltima[] = $e->getMessage();
}

// ==========================================================================================================================================
// PRUEBAS CARACTERISTICAS EN MUEBLE

$muebleCar = new MuebleReciclado("Sofá");
$muebleCar->anadirCaracteristicas('saliente', true, 'precio', 300);
$muebleCar->anadirCaracteristicas('color', 'rojo', 'sobrante'); // 'sobrante' se descarta

$erroresMueble = [];
try {
    $muebleCar->anadirCaracteristicas('ULTIMA', 'fin');
    $muebleCar->anadirCaracteristicas('nueva', 1); // lista cerrada: excepción
} catch (Exception $e) {
    $erroresMueble[] = $e->getMessage();
}
$muebleCar->anadirCaracteristicas('color', 'azul'); // existente: se puede modificar

$pruebas = [
    "muebles" => $muebles,
    "propiedades" => $propiedades,
    "caracteristicas" => $caracteristicas,
    "errorInventada" => $errorInventada,
    "cerradas" => $cerradas,
    "erroresUltima" => $erroresUltima,
    "muebleCar" => $muebleCar,
    "erroresMueble" => $erroresMueble
];

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($pruebas);  //llamo a la vista
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
function cuerpo($pruebas)
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

    foreach ($pruebas["muebles"] as $mueble) {
        echo $mueble . "<br><br>" . PHP_EOL;
    }

    foreach ($pruebas["propiedades"] as $linea) {
        echo $linea . "<br>" . PHP_EOL;
    }

    echo "<h4>Clase Caracteristicas</h4>" . PHP_EOL;

    echo $pruebas["caracteristicas"]->color . "<br>" . PHP_EOL;
    echo $pruebas["caracteristicas"]->precio . "<br>" . PHP_EOL;
    echo "Error: " . $pruebas["errorInventada"] . "<br>" . PHP_EOL;

    echo "<b>foreach:</b><br>" . PHP_EOL;
    foreach ($pruebas["caracteristicas"] as $nombre => $valor) {
        echo $nombre . ": " . $valor . "<br>" . PHP_EOL;
    }

    echo "<b>foreach otra vez:</b><br>" . PHP_EOL;
    foreach ($pruebas["caracteristicas"] as $nombre => $valor) {
        echo $nombre . ": " . $valor . "<br>" . PHP_EOL;
    }

    echo "<br>" . $pruebas["caracteristicas"] . "<br>" . PHP_EOL;

    echo "<h4>Característica ULTIMA</h4>" . PHP_EOL;

    echo $pruebas["cerradas"] . "<br>" . PHP_EOL;

    foreach ($pruebas["erroresUltima"] as $error) {
        echo "Error: " . $error . "<br>" . PHP_EOL;
    }

    echo "<h4>Clase MuebleBase (Modificación)</h4>" . PHP_EOL;

    echo $pruebas["muebleCar"] . "<br>" . PHP_EOL;

    foreach ($pruebas["muebleCar"]->getCaracteristicas() as $nombre => $valor) {
        echo $nombre . ": " . $valor . "<br>" . PHP_EOL;
    }

    foreach ($pruebas["erroresMueble"] as $error) {
        echo "Error: " . $error . "<br>" . PHP_EOL;
    }
}

// Aqui escribiremos las funciones