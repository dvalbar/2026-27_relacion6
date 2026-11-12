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

$arrayDatos = [];

// Botón Mostrar Mueble

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

// Botón Modificar Mueble
if (isset($_POST["modificar"])) {

    if (isset($_POST["mueblesForm"])) {
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

    formulario($mueblesTienda); // Mostrar formulario muebles

    echo "<br>" . PHP_EOL;

    // Mostrar Muebles
    foreach ($arrayDatos as $key => $value) {
        echo $key . ": " . $value . "<br>" . PHP_EOL;
    }
}

// Aqui escribiremos las funciones

/**
 * Función que muestra la tabla de muebles
 *
 * @param array $muebles
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
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo "<td>" . $tipo . "</td>";
                echo "<td>" . $mueble->getNombre() . "</td>";
                echo "<td>" . $mueble->getFabricante() . "</td>";
                echo "<td>" . $mueble->getPais() . "</td>";
                echo "<td>" . $mueble->getPrecio() . " €</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<?php
}

/**
 * Función que muestra el formulario de muebles
 *
 * @param array $muebles
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
        <select name="mueblesForm" id="mueblesForm">
            <?php
            foreach ($muebles as $key => $mueble) {
                $nombreMueble = $mueble->getNombre();
                $tipoMueble = get_class($mueble);
                echo "<option value='$key'>$key - $nombreMueble ($tipoMueble)</option>";
            }
            ?>
        </select>
        <button type="submit" name="mostrar">Mostrar Mueble</button>
        <button type="submit" name="modificar">Modificar Mueble</button>
    </form>
<?php
}
