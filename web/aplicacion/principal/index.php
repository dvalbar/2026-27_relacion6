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

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbi);
cuerpo($mueblesTienda);  //llamo a la vista
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
function cuerpo($mueblesTienda)
{
?>
    <br>
    <h3>Tienda Relación 6.</h3>
<?php

    tabla($mueblesTienda);
}

// Aqui escribiremos las funciones

/**
 * Función que muestra la tabla de muebles
 *
 * @param array $muebles
 * @return void
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
