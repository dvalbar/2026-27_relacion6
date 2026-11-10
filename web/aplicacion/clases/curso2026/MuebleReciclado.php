<?php

final class MuebleReciclado extends MuebleBase
{

    // Tiene la propiedad adicional PorcentajeReciclado (entero, con valor por defecto 10, debe estar entre 0 y 100)
    private int $_porcentajeReciclado = 10;

    /**
     * Constructor
     */
    function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", float $precio = 30, $porcentajeReciclado = 10)
    {
        $this->$porcentajeReciclado = $this->setPorcentajeReciclado($porcentajeReciclado);
        return parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
    }

    /**
     * Getter's y setter's
     */

    /**
     * Devuelve el porcentaje reciclado del mueble reciclado.
     *
     * @return string Devuelve el porcentaje reciclado del mueble reciclado.
     */
    public function getPorcentajeReciclado(): string
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
        $arrayProps = [$this->getPorcentajeReciclado()];
        return $arrayProps;
    }

    /**
     * toString
     *
     * @return string
     */
    #[Override]
    function __toString(): string
    {
        return parent::__toString() . "Porcentaje reciclado: " . $this->getPorcentajeReciclado() . ".";
    }
}
