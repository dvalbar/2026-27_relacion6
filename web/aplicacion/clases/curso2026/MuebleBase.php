<?php

// Representa el número máximo de muebles que se pueden crear
const MAXIMO_MUEBLES = 10;

abstract class Mueblebase
{
    // Variable de clase privada mueblesCreados.
    private static int $_mueblesCreados; // Número de muebles (instancias) creados hasta el momento.

    // Variables de instancia
    private string $_nombre; // Nombre del mueble
    private string $_fabricante; // Nombre del fabricante del mueble
    private string $_pais; // Pais del mueble
    private int $_anio; // Año de inicio de fabricación
    private string $_fechaIniVenta; // Fecha de inicio de venta
    private string $_fechaFinVenta; // Fecha de fin de venta
    private float $_precio; // Precio del mueble

    /**
     * ===================
     * Getter's y Setter's
     * ===================
     */

    /**
     * Devuelve el nombre del mueble.
     *
     * @return string Devuelve el nombre
     */
    public function getNombre(): string
    {
        return $this->_nombre;
    }

    // Nombre (cadena de máximo 40, no puede estar vacía, a mayúscula, obligatorio)

    /**
     * Define el nombre del mueble.
     *
     * @param string $nombre El nombre del mueble
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setNombre(string $nombre): bool
    {
        $nombre = mb_strtoupper($nombre); // Pasamos nombre a mayúsculas

        if (validaCadena($nombre, 40, "")) {
            $this->_nombre = $nombre;
            $resultado = true;
        }
        if ($nombre === "") {
            $resultado = false;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve el fabricante del mueble.
     *
     * @return string Devuelve el fabricante
     */
    public function getFabricante(): string
    {
        return $this->_fabricante;
    }

    // Fabricante (cadena de máximo 30, por defecto ‘FaMu:’, siempre se añade
    // al principio FaMu: si no lo tiene ya - se recorta a 30 caracteres-)

    /**
     * Define el fabricante del mueble.
     *
     * @param string $fabricante El fabricante del mueble
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setFabricante(string $fabricante): bool
    {
        if (validaCadena($fabricante, 30, "FaMu:")) {
            if (!mb_substr($fabricante, 5) === "FaMu:") { // Si no empieza por FaMu: se lo ponemos
                $this->_fabricante = "FaMu:" . $fabricante;
                $resultado = true;
            } else { // Si ya empieza no hacemos nada
                $this->_fabricante = $fabricante;
                $resultado = true;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve el país de origen.
     *
     * @return string Devuelve el país
     */
    public function getPais(): string
    {
        return $this->_pais;
    }

    // Pais (cadena, máximo 20 caracteres, por defecto ‘ESPAÑA’)

    /**
     * Define el país de origen.
     *
     * @param string $pais El país de origen
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setPais(string $pais): bool
    {
        if (validaCadena($pais, 20, "ESPAÑA")) {
            $this->_pais = $pais;
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve el año de fabricación.
     *
     * @return int Devuelve el año
     */
    public function getAnio(): int
    {
        return $this->_anio;
    }

    // Anio (entero, año de inicio de fabricación, valor entre 2020 y el año actual, por defecto 2020)

    /**
     * Define el año de fabricación.
     *
     * @param int $anio El año de fabricación
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setAnio(int $anio): bool
    {
        $fechaActual = new DateTime();
        $anioActual = intval($fechaActual->format("Y")); // Año actual

        if (validaEntero($anio, 2020, $anioActual, 2020)) {
            $this->_anio = $anio;
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve la fecha de inicio de venta.
     *
     * @return string Devuelve la fecha de inicio
     */
    public function getFechaIniVenta(): string
    {
        return $this->_fechaIniVenta;
    }

    // FechaIniVenta (cadena, fecha en la que se empieza a vender el mueble, no puede 
    // ser anterior al uno de enero del Anio de inicio de fabricación, en caso de fallo
    // se asigna “01/01/anio”, por defecto ‘01/01/2020’ aunque se usará lo anterior)

    /**
     * Define la fecha de inicio de venta.
     *
     * @param string $fechaIniVenta La fecha de inicio de venta
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setFechaIniVenta(string $fechaIniVenta): bool
    {
        $cadenaFechaAnioFabricacion = "01/01/" . $this->getAnio();

        if (validaFecha($fechaIniVenta, "") && validaFecha($cadenaFechaAnioFabricacion, "")) {
            $fechaAnioFabricacion = DateTime::createFromFormat('d/m/Y', "01/01/" . $this->getAnio());
            $fechaInicioVenta = DateTime::createFromFormat('d/m/Y', $fechaIniVenta);

            if ($fechaInicioVenta >= $fechaAnioFabricacion) { // Si la fechaIniVenta es mayor al 01/01/AñoFabricacion
                $this->_fechaIniVenta = $fechaIniVenta;
                $resultado = true;
            } else {
                $this->_fechaIniVenta = $cadenaFechaAnioFabricacion;
                $resultado = false;
            }
        }
        else {
            $this->_fechaIniVenta = $cadenaFechaAnioFabricacion;
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * Devuelve la fecha de fin de venta.
     *
     * @return string Devuelve la fecha de fin
     */
    public function getFechaFinVenta(): string
    {
        return $this->_fechaFinVenta;
    }

    // FechaFinVenta (cadena-fecha, fecha en la que dejará de venderse, no
    // puede ser anterior a la FechaIniVenta, por defecto 31/12/2040’)

    /**
     * Define la fecha de fin de venta.
     *
     * @param string $fechaFinVenta La fecha de fin de venta
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setFechaFinVenta(string $fechaFinVenta): bool
    {
        $this->_fechaFinVenta = $fechaFinVenta; // TO-DO
    }

    /**
     * Devuelve el precio del mueble.
     *
     * @return float Devuelve el precio
     */
    public function getPrecio(): float
    {
        return $this->_precio;
    }

    // Precio (real, por defecto 30, no puede ser menor de 30)

    /**
     * Define el precio del mueble.
     *
     * @param float $precio El precio del mueble
     * @return bool Devuelve true si cumple las restricciones, false en caso contrario
     */
    public function setPrecio(float $precio): bool
    {
        if (validaReal($precio, 30, $precio, 30)) {
            $this->_precio = $precio;
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    /**
     * MÉTODOS
     */

    // Método damePropiedadesAdicionales. Será redefinido en las clases hijas y devolverá
    // un array con el nombre de las propiedades adicionales a la clase base. 

    abstract function damePropiedadesAdicionales(): array; // Se redefine en las clases hijas

    // Método de clase puedeCrear que devuelve true si se pueden crear más instancias de la
    // clase y false en caso contrario. Además, devuelve en el parámetro Número el número de
    // muebles que aún se pueden crear de la clase.
    static function puedeCrear(&$huecosDisponibles): bool
    {
        $huecosDisponibles = MAXIMO_MUEBLES - Mueblebase::$_mueblesCreados;

        if (Mueblebase::$_mueblesCreados >= MAXIMO_MUEBLES) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    // Método que al convertir la instancia en cadena nos devuelve 'MUEBLE de clase
    // XXX con nombre XXX, fabricante XXX, fabricado en XXX a partir del año 999,
    // vendido desde 99/99/9999 hasta 99/99/9999, precio 9999'
    public function __toString(): string
    {
        return ""; // TO-DO
    }

    // ==================================================================================================================
    // Esta clase no permite la sobrecarga dinámica de propiedades

    /**
     * Se ejecuta al escribir en una propiedad inaccesible o inexistente.
     * Lanza una excepción para evitar la sobrecarga de propiedades.
     *
     * @param string $name  Nombre de la propiedad.
     * @param mixed  $value Valor que se intentaba asignar.
     * @throws \Exception Siempre.
     * @return void No devuelve nada
     */
    public function __set(string $name, mixed $value): void
    {
        throw new \Exception("La propiedad $name no existe");
    }

    /**
     * Se ejecuta al leer una propiedad inaccesible o inexistente.
     * Lanza una excepción para evitar la sobrecarga de propiedades.
     *
     * @param string $name Nombre de la propiedad.
     * @return mixed
     * @throws \Exception Siempre.
     * @return mixed No devuelve nada
     */
    public function __get(string $name): mixed
    {
        throw new \Exception("La propiedad $name no existe");
    }

    /**
     * Se ejecuta al usar isset() o empty() sobre una propiedad inaccesible.
     * Siempre devuelve false porque no hay propiedades dinámicas.
     *
     * @param string $name Nombre de la propiedad.
     * @return bool Siempre devolverá falso
     */
    public function __isset(string $name): bool
    {
        // Ninguna propiedad inaccesible "existe"
        return false;
    }

    /**
     * Se ejecuta al usar unset() sobre una propiedad inaccesible.
     * No hace nada.
     *
     * @param string $name Nombre de la propiedad.
     * @return void No devuelve nada
     */
    public function __unset(string $name): void
    {;
        // throw new \Exception('Not implemented');
    }
}
