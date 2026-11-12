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
            "enlace" => "/aplicacion/principal/index.php"
        ],
        [
            "nombre" => "Tienda",
        ]
    ];

// Array donde se guardaran los distintos datos del formulario
$arrayDatos = [];

// ======================
// Botón Modificar Mueble
// ======================

// Al pulsar el botón formulario Modificar Mueble se abrirá una nueva ventana con un
// formulario que permitirá modificar los datos del mueble indicado. En el formulario se
// mostrarán inicialmente los datos que tiene el mueble según el tipo del mismo. Cuando se
// envíe el formulario, se deben validar los datos enviados según las condiciones del
// apartado 1 y 2. La mitad mediante una instancia auxiliar del tipo de mueble, llamando a
// los métodos set, y la otra mitad de las propiedades se debe validar directamente usando
// condiciones. Si todo es correcto se actualizará el mueble correspondiente y se mostrará
// un resumen con los datos recogidos. Habrá un enlace a ir a Index.php que nos permitirá
// volver a la página principal

// Ojo, al no trabajar con sesiones, al recargar la página no aparecerán los cambios en el
// mueble que hemos modificado.

if (isset($_POST["modificar"])) {

    if (isset($_POST["mueblesForm"]) && isset($mueblesTienda[$_POST["mueblesForm"]])) {
        $indice = $_POST["mueblesForm"];

        // Mandar el indice del mueble a modificarMueble.php
        header("Location: /aplicacion/principal/modificarMueble.php?indice=$indice");
        exit;
    }
}

// ====================
// Botón Mostrar Mueble
// ====================

// Al pulsar el botón del formulario Mostrar Mueble mostrará todas las propiedades del
// mueble seleccionado y sus características a continuación del formulario anterior
// (propiedades de MuebleBase y propiedades adicionales –las sabe a partir del método
// apropiado-) en diferentes líneas. No se usará el convertir instancia en cadena.

if (isset($_POST["mostrar"])) {

    if (isset($_POST["mueblesForm"])) {
        $muebleSeleccionado = $mueblesTienda[$_POST["mueblesForm"]];

        $arrayDatos["Nombre"] = $muebleSeleccionado->getNombre();
        $arrayDatos["Fabricante"] = $muebleSeleccionado->getFabricante();
        $arrayDatos["Pais"] = $muebleSeleccionado->getPais();
        $arrayDatos["Año"] = $muebleSeleccionado->getAnio();
        $arrayDatos["FechaIniVenta"] = $muebleSeleccionado->getFechaIniVenta();
        $arrayDatos["FechaFinVenta"] = $muebleSeleccionado->getFechaFinVenta();
        $arrayDatos["Precio"] = $muebleSeleccionado->getPrecio();

        foreach ($muebleSeleccionado->damePropiedadesAdicionales() as $value) {
            $arrayDatos[$value] = $muebleSeleccionado->{"get" . $value}();
        }

        foreach ($muebleSeleccionado->getCaracteristicas() as $key => $value) {
            $arrayDatos[$key] = $value;
        }
    }
}

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($mueblesTienda, $arrayDatos);  //llamo a la vista
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
function cuerpo($mueblesTienda, $arrayDatos)
{
?>
    <br>
    <h3>Tienda Relación 6.</h3>
<?php

    tabla($mueblesTienda); // Mostrar tabla de muebles

    echo "<br>" . PHP_EOL;

    formulario($mueblesTienda); // Mostrar formulario muebles

    echo "<br>" . PHP_EOL;

    mostrarMuebles($arrayDatos); // Mostrar datos del mueble seleccionado

}

// Aqui escribiremos las funciones

/**
 * Función que muestra los datos del mueble seleccionado en el formulario
 *
 * @param array $datos Array con los datos del mueble que se ha seleccionado
 * 
 * @return void No devuelve nada
 */
function mostrarMuebles(array $datos)
{
    foreach ($datos as $key => $value) {
        echo $key . ": " . $value . "<br>" . PHP_EOL;
    }
}

/**
 * Función que muestra la tabla de muebles
 *
 * @param array $muebles Array con los muebles de nuestra tienda
 * 
 * @return void No devuelve nada
 */
function tabla(array $muebles): void
{
?>
    <table border="1">
        <thead>
            <tr>
                <th>Índice</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>País</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($muebles as $key => $mueble) {
                $tipo = get_class($mueble);
                echo "<tr>" . PHP_EOL;
                echo "<td>" . $key . "</td>" . PHP_EOL;
                echo "<td>" . $tipo . "</td>" . PHP_EOL;
                echo "<td>" . $mueble->getNombre() . "</td>" . PHP_EOL;
                echo "<td>" . $mueble->getFabricante() . "</td>" . PHP_EOL;
                echo "<td>" . $mueble->getPais() . "</td>" . PHP_EOL;
                echo "<td>" . $mueble->getPrecio() . " €</td>" . PHP_EOL;
                echo "</tr>" . PHP_EOL;
            }
            ?>
        </tbody>
    </table>
<?php
}

/**
 * Función que muestra el formulario de muebles
 *
 * @param array $muebles Array con los muebles de nuestra tienda
 * 
 * @return void No devuelve nada
 */
function formulario(array $muebles): void
{
    // Un solo formulario con dos botones de envío (Mostrar Mueble y Modificar Mueble) y
    // un elemento para seleccionar el mueble sobre el que trabajar. Se usará un select
    // mostrando datos del mueble y como valor se tendrá el índice en el array.

?>
    <form action="" method="POST">
        <label for="">Escoge un mueble: </label>
        <select name="mueblesForm" id="mueblesForm">
            <?php
            foreach ($muebles as $key => $mueble) {
                $nombreMueble = $mueble->getNombre();
                $tipoMueble = get_class($mueble);
                echo "<option value='$key'>$key - $nombreMueble ($tipoMueble)</option>" . PHP_EOL;
            }
            ?>
        </select>
        <button type="submit" name="mostrar">Mostrar Mueble</button>
        <button type="submit" name="modificar">Modificar Mueble</button>
    </form>
<?php
}
