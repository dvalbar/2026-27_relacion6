<?php

class Caracteristicas implements Iterator
{

    private $_misCaracteristicas = [];

    /**
     * Constructor
     *
     * @param array $misCaracteristicas Características iniciales (nombre => valor)
     */
    public function __construct(array $misCaracteristicas = [])
    {
        $this->_misCaracteristicas = $misCaracteristicas;
    }

    /**
     * Devuelve las características en forma de cadena: car1:valor1;car2:valor2;
     * Si no hay ninguna, devuelve un mensaje indicándolo.
     *
     * @return string Devuelve las características como cadena
     */
    public function __toString(): string
    {
        $cadena = "";
        try {
            if (empty($this->_misCaracteristicas)) {
                throw new Exception("No se han añadido caracteristicas");
            }
            foreach ($this->_misCaracteristicas as $key => $value) {
                $cadena .= $key . ":" . $value . ";";
            }
        } catch (Exception $e) {
            $cadena = $e->getMessage();
        }
        return $cadena;
    }

    // ================
    // MÉTODOS ITERATOR
    // ================

    /**
     * Se ejecuta al empezar el foreach.
     * Prepara el recorrido: array en orden inverso, con las claves, y puntero al principio.
     *
     * @return void No devuelve nada
     */
    public function rewind(): void
    {
        // array_reverse (conservando claves) + reset
    }

    /**
     * Comprueba si el puntero está sobre un elemento válido.
     *
     * @return bool Devuelve true si quedan elementos por recorrer, false en caso contrario
     */
    public function valid(): bool
    {
        // ¿Qué devuelve key() cuando el puntero se sale del array?
    }

    /**
     * Devuelve el valor del elemento actual.
     *
     * @return mixed Devuelve el valor de la característica actual
     */
    public function current(): mixed {}

    /**
     * Devuelve la clave del elemento actual.
     *
     * @return mixed Devuelve el nombre de la característica actual
     */
    public function key(): mixed {}

    /**
     * Avanza el puntero al siguiente elemento.
     *
     * @return void No devuelve nada
     */
    public function next(): void {}

    // ============================================================
    // Esta clase si permite la sobrecarga dinámica de propiedades
    // ============================================================

    /**
     * Mete el valor en el array con el nombre como clave.
     *
     * @param string $name  Nombre de la propiedad
     * @param mixed  $value Valor que se intentaba asignar
     * 
     * @return void No devuelve nada
     */
    public function __set(string $name, mixed $value): void
    {
        $this->_misCaracteristicas[$name] = $value;
    }

    /**
     * Devuelve el valor de la característica indicada.
     * 
     * @param string $name Nombre de la característica
     * 
     * @return mixed Devuelve el valor de la característica
     * @throws Exception Si la característica no existe
     */
    public function __get(string $name): mixed
    {
        if (!array_key_exists($name, $this->_misCaracteristicas)) {
            throw new Exception("La caracteristica no existe");
        }
        return $this->_misCaracteristicas[$name];
    }

    /**
     * Se ejecuta al usar isset() o empty() sobre una característica.
     * Comprueba si la característica existe en el array.
     *
     * @param string $name Nombre de la característica
     * 
     * @return bool Devuelve true si la característica existe, false en caso contrario
     */
    public function __isset(string $name): bool
    {
        return array_key_exists($name, $this->_misCaracteristicas);
    }

    /**
     * Se ejecuta al usar unset() sobre una característica.
     * Elimina la característica del array.
     *
     * @param string $name Nombre de la característica
     * 
     * @return void No devuelve nada
     */
    public function __unset(string $name): void
    {
        unset($this->_misCaracteristicas[$name]);
    }
}
