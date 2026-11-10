<?php

final class MuebleTradicional extends MuebleBase
{

    // tiene las propiedades Peso (real, entre 15 y 300, por defecto 15) y Serie (cadena, por defecto S01). 
    private float $_peso = 15;
    private string $_serie = "S01";

    function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", float $precio = 30)
    {
        $this->_peso = $this->getPeso();
        $this->_serie = $this->getSerie();
        return parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
    }

    /**
     * Getter's y setter's
     */

    /**
     * Devuelve el peso del mueble tradicional.
     *
     * @return float Devuelve el peso del mueble tradicional.
     */
    public function getPeso(): float
    {
        return $this->_peso;
    }

    // Peso (real, entre 15 y 300, por defecto 15)

    /**
     * Define el peso del mueble tradicional
     *
     * @param float $peso El peso del mueble
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setPeso(float $peso): bool
    {
        if (validaReal($peso, 15, 300, 15)) {
            $this->_peso = $peso;
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve la serie del mueble tradicional.
     *
     * @return float Devuelve la serie del mueble tradicional.
     */
    public function getSerie(): string
    {
        return $this->_serie;
    }

    // Serie (cadena, por defecto S01)

    /**
     * Define la serie del mueble tradicional
     *
     * @param string $serie La serie del mueble
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setSerie(string $serie): bool
    {
        if (validaCadena($serie, 3, "S01")) {
            $this->_serie = $serie;
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
        $arrayProps = [$this->getPeso(), $this->getSerie()];
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
        return parent::__toString() . "Peso: " . $this->getPeso() . ", Serie: " . $this->getSerie() . ".";
    }
}
