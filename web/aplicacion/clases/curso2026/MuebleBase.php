<?php

/**
 * Clase MuebleReciclado que hereda de MuebleBase.
 * Representa muebles fabricados con material reciclado e incluye el porcentaje correspondiente.
 * Esta clase no permite la creación de subclases (final).
 */
abstract class MuebleBase
{
    // Representa el número máximo de muebles que se pueden crear
    const MAXIMO_MUEBLES = 10;

    // Variable de clase privada mueblesCreados.
    private static int $_mueblesCreados = 0; // Número de muebles (instancias) creados hasta el momento.

    // Variables de instancia
    private string $_nombre; // Nombre del mueble (Obligatorio)
    private string $_fabricante = "FaMu:"; // Nombre del fabricante del mueble
    private string $_pais = "ESPAÑA"; // Pais del mueble
    private int $_anio = 2020; // Año de inicio de fabricación
    private string $_fechaIniVenta = "01/01/2020"; // Fecha de inicio de venta
    private string $_fechaFinVenta = "31/12/2040"; // Fecha de fin de venta
    private float $_precio = 30; // Precio del mueble

    // Definir una propiedad privada de tipo Caracteristicas.
    private Caracteristicas $_caracteristicas;

    // Constructor. Recibe valores para las propiedades teniendo en cuenta los posibles
    // valores por defecto, salvo el nombre que es obligatorio que se indique. Se deben asignar
    // los valores en las propiedades llamando a los métodos set correspondientes. Si la función
    // setNombre falla (devuelve false), se lanzará un error. Para cualquier otro campo, en
    // caso de fallar el set, se asignará el valor por defecto. Además, si se ha superado el
    // máximo de instancias creadas no se debe permitir la creación (lanzar excepción).

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
     */
    public function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaIniVenta = "01/01/2020", string $fechaFinVenta = "31/12/2040", float $precio = 30)
    {
        $limite = 0;

        if (!self::puedeCrear($limite)) {
            throw new Exception("Limite de muebles alcanzado.");
        }

        if (!$this->setNombre($nombre)) {
            throw new Exception("El nombre no es válido.");
        }

        $this->setFabricante($fabricante);
        $this->setPais($pais);
        $this->setAnio($anio);
        $this->setFechaIniVenta($fechaIniVenta);
        $this->setFechaFinVenta($fechaFinVenta);
        $this->setPrecio($precio);

        $this->_caracteristicas = new Caracteristicas();

        self::$_mueblesCreados++;
    }

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

        if ($nombre === "") {
            $resultado = false;
        } else {
            if (validaCadena($nombre, 40, "")) {
                $this->_nombre = $nombre;
                $resultado = true;
            } else {
                $resultado = false;
            }
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
        // Si no empieza por FaMu: se pone al principio de la cadena
        if (mb_substr($fabricante, 0, 5) !== "FaMu:") {
            $fabricante = "FaMu:" . $fabricante;
        }

        $recortado = mb_substr($fabricante, 0, 30);

        if (validaCadena($fabricante, 30, "FaMu:")) {
            $this->_fabricante = $fabricante;
            $resultado = true;
        } else {
            $this->_fabricante = $recortado;
            $resultado = false; // Se recorta pero es un error
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

    // Anio (entero, año de inicio de fabricación, valor entre 2020 y el 
    // año actual, por defecto 2020)

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

        if (validaFecha($fechaIniVenta, "")) {
            $fechaAnioFabricacion = DateTime::createFromFormat('d/m/Y', $cadenaFechaAnioFabricacion);
            $fechaInicioVenta = DateTime::createFromFormat('d/m/Y', $fechaIniVenta);

            if ($fechaInicioVenta >= $fechaAnioFabricacion) {
                $this->_fechaIniVenta = $fechaIniVenta;
                $resultado = true;
            } else {
                $this->_fechaIniVenta = $cadenaFechaAnioFabricacion;
                $resultado = false;
            }
        } else {
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
        if (validaFecha($fechaFinVenta, "")) {
            $fechaInicioVenta = DateTime::createFromFormat('d/m/Y', $this->getFechaIniVenta());
            $fechaFinalVenta =  DateTime::createFromFormat('d/m/Y', $fechaFinVenta);

            // FechaFinVenta menor que fechaIniVenta
            if ($fechaFinalVenta < $fechaInicioVenta) {
                $resultado = false;
            } else {
                $this->_fechaFinVenta = $fechaFinVenta;
                $resultado = true;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
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
        if (validaReal($precio, 30, PHP_FLOAT_MAX, 30)) {
            $this->_precio = $precio;
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    /**
     * MÉTODOS
     */

    // Método damePropiedadesAdicionales. Será redefinido en las clases hijas y devolverá
    // un array con el nombre de las propiedades adicionales a la clase base. 

    /**
     * Devuelve un array con las propiedades adicionales de la clase.
     * 
     * @return array Array con el nombre de la propiedad adicional
     */
    abstract function damePropiedadesAdicionales(): array; // Se redefine en las clases hijas

    // Método de clase puedeCrear que devuelve true si se pueden crear más instancias de la
    // clase y false en caso contrario. Además, devuelve en el parámetro Número el número de
    // muebles que aún se pueden crear de la clase.
    static function puedeCrear(&$numero): bool
    {
        $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;

        if (MuebleBase::$_mueblesCreados >= self::MAXIMO_MUEBLES) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    // Método anadirCaracteristicas que recibirá pares de argumentos en la forma (string
    // carac, mixed valor) que se corresponden con el nombre de la característica y el valor de
    // la misma y que añadirá la característica a la propiedad privada.
    // (pueden indicarse 2, 4, 6 … parámetros, si se indica un número impar se desecha el ultimo parámetro).

    // Ejemplo, anadirCaracteristicas(‘saliente’, true, ‘precio’, 300).

    /**
     * Añade características al mueble recibiendo pares (nombre, valor).
     * Si se indica un número impar de parámetros, se descarta el último.
     *
     * @param string $carac Nombre de la primera característica
     * @param mixed $valor Valor de la primera característica
     * @param mixed ...$resto Más pares nombre, valor
     * 
     * @return void No devuelve nada
     * @throws Exception Si la lista de características está cerrada con ULTIMA
     */
    public function anadirCaracteristicas(string $carac, mixed $valor, ...$resto): void
    {
        $this->_caracteristicas->$carac = $valor;

        if (!empty($resto)) {
            if (count($resto) % 2 === 0) { // Si la longitud del array es par -> las caracteristicas van en grupos pares (2, 4, 6, ...)
                for ($i = 0; $i < count($resto); $i += 2) {
                    $nombre = $resto[$i];
                    $val = $resto[$i + 1];
                    $this->_caracteristicas->$nombre = $val;
                }
            } else { // Falta un parametro (le quito 1 a la longitud del array para descartar el ultimo parámetro)
                for ($i = 0; $i < count($resto) - 1; $i += 2) {
                    $nombre = $resto[$i];
                    $val = $resto[$i + 1];
                    $this->_caracteristicas->$nombre = $val;
                }
            }
        }
    }

    // Se tendrá en método getCaracteristicas que devolverá las características asignadas al mueble (como objeto)

    /**
     * Devuelve las características del mueble.
     *
     * @return Caracteristicas Devuelve el objeto con las características
     */
    public function getCaracteristicas(): Caracteristicas
    {
        return $this->_caracteristicas;
    }

    // Método que al convertir la instancia en cadena nos devuelve 'MUEBLE de clase
    // XXX con nombre XXX, fabricante XXX, fabricado en XXX a partir del año 999,
    // vendido desde 99/99/9999 hasta 99/99/9999, precio 9999'

    // Al convertirse la instancia de mueble en cadena deben mostrarse las características.

    /**
     * toString - devuelve los datos en forma de cadena
     *
     * @return string Cadena con los datos
     */
    public function __toString(): string
    {
        return "MUEBLE de clase " . get_class($this) . " con nombre " . $this->getNombre() . ", fabricante " . $this->getFabricante() .
            ", fabricado en " . $this->getPais() . " a partir del año " . $this->getAnio() . ", vendido desde " . $this->getFechaIniVenta() .
            " hasta " . $this->getFechaFinVenta() . ", precio " . $this->getPrecio() . ". Caracteristicas adicionales: " . $this->getCaracteristicas() . ". ";
    }

    // ===========================================================
    // Esta clase no permite la sobrecarga dinámica de propiedades
    // ===========================================================

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
