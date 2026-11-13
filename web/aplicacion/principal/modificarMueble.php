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
            "nombre" => "Modificar Mueble",
        ]
    ];

// Array con los datos modificados del mueble
$arrayDatosModificados = [];

// Array con los errores del formulario
$arrayErroresMuebleModificado = [];

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

if (isset($_POST["confirmar"]) && $muebleSeleccionado !== null) {

    // La mitad mediante una instancia auxiliar del tipo de
    // mueble, llamando a los métodos set
    $muebleAux = clone $muebleSeleccionado; // Instancia auxiliar del mueble seleccionado

    if (isset($_POST["nombre"])) {
        if ($muebleAux->setNombre($_POST["nombre"])) {
            $arrayDatosModificados["Nombre"] = mb_trim($muebleAux->getNombre());
        } else {
            $arrayErroresMuebleModificado["Nombre"] = "Nombre no válido";
        }
    }

    if (isset($_POST["fabricante"])) {
        if ($muebleAux->setFabricante($_POST["fabricante"])) {
            $arrayDatosModificados["Fabricante"] = mb_trim($muebleAux->getFabricante());
        } else {
            $arrayErroresMuebleModificado["Fabricante"] = "Fabricante no válido";
        }
    }

    if (isset($_POST["pais"])) {
        if ($muebleAux->setPais($_POST["pais"])) {
            $arrayDatosModificados["Pais"] = mb_trim($muebleAux->getPais());
        } else {
            $arrayErroresMuebleModificado["Pais"] = "País no válido";
        }
    }

    if (isset($_POST["anio"])) {
        if ($muebleAux->setAnio(intval($_POST["anio"]))) {
            $arrayDatosModificados["Anio"] = intval($muebleAux->getAnio());
        } else {
            $arrayErroresMuebleModificado["Anio"] = "Año no válido";
        }
    }

    if (isset($_POST["fechaIniVenta"])) {
        if ($muebleAux->setFechaIniVenta($_POST["fechaIniVenta"])) {
            $arrayDatosModificados["FechaIniVenta"] = mb_trim($muebleAux->getFechaIniVenta());
        } else {
            $arrayErroresMuebleModificado["FechaIniVenta"] = "Fecha de inicio no válida";
        }
    }

    if (isset($_POST["fechaFinVenta"])) {
        if ($muebleAux->setFechaFinVenta($_POST["fechaFinVenta"])) {
            $arrayDatosModificados["FechaFinVenta"] = mb_trim($muebleAux->getFechaFinVenta());
        } else {
            $arrayErroresMuebleModificado["FechaFinVenta"] = "Fecha de fin no válida";
        }
    }

    if (isset($_POST["precio"])) {
        if ($muebleAux->setPrecio(floatval($_POST["precio"]))) {
            $arrayDatosModificados["Precio"] = floatval($muebleAux->getPrecio());
        } else {
            $arrayErroresMuebleModificado["Precio"] = "Precio no válido";
        }
    }

    // Mueble Reciclado
    if (isset($_POST["porcentajeReciclado"])) {
        if ($muebleAux->setPorcentajeReciclado(intval($_POST["porcentajeReciclado"]))) {
            $arrayDatosModificados["PorcentajeReciclado"] = intval($muebleAux->getPorcentajeReciclado());
        } else {
            $arrayErroresMuebleModificado["PorcentajeReciclado"] = "Porcentaje reciclado no válido";
        }
    }

    // Mueble Tradicional
    if (isset($_POST["peso"])) {
        if ($muebleAux->setPeso(floatval($_POST["peso"]))) {
            $arrayDatosModificados["Peso"] = floatval($muebleAux->getPeso());
        } else {
            $arrayErroresMuebleModificado["Peso"] = "Peso no válido";
        }
    }

    if (isset($_POST["serie"])) {
        if ($muebleAux->setSerie($_POST["serie"])) {
            $arrayDatosModificados["Serie"] = mb_trim($muebleAux->getSerie());
        } else {
            $arrayErroresMuebleModificado["Serie"] = "Serie no válida";
        }
    }

    $muebleSeleccionado = $muebleAux;
    $mueblesTienda[$indice] = $muebleAux;
}

// Si no hay errores, $correcto será true
$correcto = isset($_POST["confirmar"]) && empty($arrayErroresMuebleModificado);

//dibuja la plantilla de la vista
inicioCabecera("MODIFICAR MUEBLE");
cabecera();
finCabecera();
inicioCuerpo("MODIFICAR MUEBLE", $barraUbi);
cuerpo($muebleSeleccionado, $arrayDatosModificados, $arrayErroresMuebleModificado, $correcto);  //llamo a la vista
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
function cuerpo($muebleSeleccionado, $arrayDatosModificados, $arrayErroresMuebleModificado, $correcto)
{
    // Habrá un enlace a ir a Index.php que nos permitirá volver a la página principal
    echo '<a href="/index.php">← Volver a TIENDA</a><br>' . PHP_EOL;

?>
    <br>
    <h3>Modificar mueble.</h3>
    <?php

    // Si el mueble es nulo es que de alguna forma no se ha pasado por el boton del formulario
    // asi que muestro un mensaje diciendo que no se ha seleccionado ningun mueble 
    if ($muebleSeleccionado === null) {
        echo "No se ha seleccionado ningún mueble" . PHP_EOL;
    } else {
        if ($correcto) { // Si no hay errores muestra el resumen
            formulario($muebleSeleccionado, $arrayErroresMuebleModificado); // Mostrar formulario modificación

            echo "<br>" . PHP_EOL;

            mostrarMuebles($arrayDatosModificados); // Mostrar el resumen del mueble modificado;
        } else { // Si hay errores, vuelve a mostrar el formulario con los datos actualizados
            formulario($muebleSeleccionado, $arrayErroresMuebleModificado); // Mostrar formulario modificación
        }
    }
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
 * Función que muestra el formulario de muebles. Depende del tipo de mueble
 * se muestra un formulario o otro
 *
 * @param MuebleBase $mueble Mueble con el mismo id que llega desde el otro formulario
 * 
 * @return void No devuelve nada
 */
function formulario(MuebleBase $mueble, array $errores): void
{
    if (!empty($errores)) { // Mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $error) {
            echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }


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
