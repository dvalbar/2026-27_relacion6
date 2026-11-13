<?php

/**
 * Clase MuebleReciclado que hereda de MuebleBase.
 * Representa muebles fabricados con material reciclado e incluye el porcentaje correspondiente.
 * Esta clase no permite la creación de subclases (final).
 */
final class MuebleReciclado extends MuebleBase
{

    // Tiene la propiedad adicional PorcentajeReciclado (entero, con valor por defecto 10, debe estar entre 0 y 100)
    private int $_porcentajeReciclado = 10;

    /**
     * Constructor
     *
     * @param string $nombre Nombre del mueble
     * @param string $fabricante Fabricante del mueble
     * @param string $pais Pais donde se fabricó el mueble
     * @param integer $anio Año de fabricación del mueble
     * @param string $fechaIniVenta Fecha de inicio del mueble
     * @param string $fechaFinVenta Fecha de fin de venta del mueble
     * @param integer $precio Precio del mueble
     * @param integer $porcentajeReciclado Porcentaje de reciclado del mueble
     */
    function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", float $precio = 30, int $porcentajeReciclado = 10)
    {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
        $this->setPorcentajeReciclado($porcentajeReciclado);
    }

    /**
     * Getter's y setter's
     */

    /**
     * Devuelve el porcentaje reciclado del mueble reciclado.
     *
     * @return int Devuelve el porcentaje reciclado del mueble reciclado.
     */
    public function getPorcentajeReciclado(): int
    {
        return $this->_porcentajeReciclado;
    }

    // Porcentaje reciclado, entero, con valor por defecto 10, debe estar entre 0 y 100

    /**
     * Define el porcentaje reciclado del mueble reciclado.
     *
     * @param int $porcentaje El porcentaje reciclado
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setPorcentajeReciclado(int $porcentaje): bool
    {
        if (validaEntero($porcentaje, 0, 100, 10)) {
            $this->_porcentajeReciclado = $porcentaje;
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Función que devolverá un array con el nombre de las propiedades adicionales a la clase base
     *
     * @return array Devuelve un array con el nombre de las propiedades adicionales a la clase base
     */
    #[Override]
    function damePropiedadesAdicionales(): array
    {
        $arrayProps = ["PorcentajeReciclado"]; // Preguntar a Vicente si este método es para el __toString
        return $arrayProps;
    }

    /**
     * toString - devuelve los datos en forma de cadena
     *
     * @return string Cadena con los datos
     */
    #[Override]
    function __toString(): string
    {
        return parent::__toString() . "Porcentaje reciclado: " . $this->getPorcentajeReciclado() . ".";
    }
}
