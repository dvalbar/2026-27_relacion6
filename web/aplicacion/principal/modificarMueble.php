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
            "nombre" => "Modificar Mueble",
        ]
    ];

// Array con los datos modificados del mueble
$arrayDatosModificados = [];

// Por si alguien entra si pasar antes por el formulario
$muebleSeleccionado = null;

// Se recoje el indice del mueble y seleccionamos el
// mueble que es con nuestro array de muebles de la tienda
if (isset($_GET['indice']) && isset($mueblesTienda[$_GET['indice']])) {
    $indice = $_GET['indice'];
    $muebleSeleccionado = $mueblesTienda[$indice];
}

// ===================================
// Botón Confirmar Modificación Mueble
// ===================================

if (isset($_POST["confirmar"])) {
}

//dibuja la plantilla de la vista
inicioCabecera("MODIFICAR MUEBLE");
cabecera();
finCabecera();
inicioCuerpo("MODIFICAR MUEBLE", $barraUbi);
cuerpo($mueblesTienda, $muebleSeleccionado);  //llamo a la vista
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
function cuerpo($mueblesTienda, $muebleSeleccionado)
{
    // Habrá un enlace a ir a Index.php que nos permitirá volver a la página principal
    echo '<a href="/index.php">← Volver a TIENDA</a><br>' . PHP_EOL;

?>
    <br>
    <h3>Modificar mueble.</h3>
    <?php


    formulario($muebleSeleccionado); // Mostrar formulario modificación
}

// Aqui escribiremos las funciones

/**
 * Función que muestra el formulario de muebles. Depende del tipo de mueble
 * se muestra un formulario o otro
 *
 * @param MuebleBase $mueble Mueble con el mismo id que llega desde el otro formulario
 * 
 * @return void No devuelve nada
 */
function formulario(MuebleBase $mueble): void
{
    if ($mueble instanceof MuebleReciclado) { // MuebleReciclado
    ?>
        <form action="" method="POST">
            <!-- Nombre Mueble -->
            <label for="">Nombre: </label>
            <input name="nombre" type="text" value="<?php echo $mueble->getNombre() ?>">
            <br>
            <!-- Fabricante Mueble -->
            <label for="">Fabricante: </label>
            <input name="fabricante" type="text" value="<?php echo $mueble->getFabricante() ?>">
            <br>
            <!-- Pais Mueble -->
            <label for="">País: </label>
            <input name="pais" type="text" value="<?php echo $mueble->getPais() ?>">
            <br>
            <!-- Anio Mueble -->
            <label for="">Año: </label>
            <input name="anio" type="text" value="<?php echo $mueble->getAnio() ?>">
            <br>
            <!-- FechaIniVenta Mueble -->
            <label for="">FechaIniVenta: </label>
            <input name="fechaIniVenta" type="text" value="<?php echo $mueble->getFechaIniVenta() ?>">
            <br>
            <!-- FechaFinVenta Mueble -->
            <label for="">FechaFinVenta: </label>
            <input name="fechaFinVenta" type="text" value="<?php echo $mueble->getFechaFinVenta() ?>">
            <br>
            <!-- Precio Mueble -->
            <label for="">Precio: </label>
            <input name="precio" type="text" value="<?php echo $mueble->getPrecio() ?>">
            <br>
            <!-- PorcentajeReciclado Mueble -->
            <label for="">Porcentaje Reciclado: </label>
            <input name="porcentajeReciclado" type="text" value="<?php echo $mueble->getPorcentajeReciclado() ?>">
            <br>
            <button type="submit" name="confirmar">Confirmar</button>
        </form>
    <?php
    } else if ($mueble instanceof MuebleTradicional) { // MuebleTradicional
    ?>
        <form action="" method="POST">
            <!-- Nombre Mueble -->
            <label for="">Nombre: </label>
            <input name="nombre" type="text" value="<?php echo $mueble->getNombre() ?>">
            <br>
            <!-- Fabricante Mueble -->
            <label for="">Fabricante: </label>
            <input name="fabricante" type="text" value="<?php echo $mueble->getFabricante() ?>">
            <br>
            <!-- Pais Mueble -->
            <label for="">País: </label>
            <input name="pais" type="text" value="<?php echo $mueble->getPais() ?>">
            <br>
            <!-- Anio Mueble -->
            <label for="">Año: </label>
            <input name="anio" type="text" value="<?php echo $mueble->getAnio() ?>">
            <br>
            <!-- FechaIniVenta Mueble -->
            <label for="">FechaIniVenta: </label>
            <input name="fechaIniVenta" type="text" value="<?php echo $mueble->getFechaIniVenta() ?>">
            <br>
            <!-- FechaFinVenta Mueble -->
            <label for="">FechaFinVenta: </label>
            <input name="fechaFinVenta" type="text" value="<?php echo $mueble->getFechaFinVenta() ?>">
            <br>
            <!-- Precio Mueble -->
            <label for="">Precio: </label>
            <input name="precio" type="text" value="<?php echo $mueble->getPrecio() ?>">
            <br>
            <!-- Peso Mueble -->
            <label for="">Peso: </label>
            <input name="peso" type="text" value="<?php echo $mueble->getPeso() ?>">
            <br>
            <!-- Peso Serie -->
            <label for="">Serie: </label>
            <input name="serie" type="text" value="<?php echo $mueble->getSerie() ?>">
            <br>
            <button type="submit" name="confirmar">Confirmar</button>
        </form>
<?php
    }
}
