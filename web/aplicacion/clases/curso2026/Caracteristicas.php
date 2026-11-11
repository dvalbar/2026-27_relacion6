<?php

class Caracteristicas implements Iterator
{
    private array $_misCaracteristicas = []; // Array donde se guardan las caracteristicas
    private int $_claveActual = 0; // Posición iterator
    private array $_listaNombres = []; // Array donde se guardan las caracteristicas en orden inverso y con clave númerica para poder recorrerlo
    private bool $_listaCerrada = false; // Variable para saber si se ha introducido "ULTIMA" y cerrar la _listaNombres

    /**
     * Constructor
     */
    public function __construct() {}

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
        $this->_listaNombres = []; // Vaciar _listaNombres
        $caracteristicasInversas =  array_reverse($this->_misCaracteristicas); // Caracteristicas en orden inverso
        foreach ($caracteristicasInversas as $key => $value) { // Metemos en _listaNombres el nombre de las caracteristicas (las claves)
            $this->_listaNombres[] = $key;
        }
        $this->_claveActual = 0; // Reiniciar puntero
    }

    /**
     * Comprueba si el puntero está sobre un elemento válido.
     *
     * @return bool Devuelve true si quedan elementos por recorrer, false en caso contrario
     */
    public function valid(): bool
    {
        // Devuelve si _claveActual es menor que el número de elementos de _listaNombres (count).
        return $this->_claveActual < count($this->_listaNombres);
    }

    /**
     * Devuelve el valor del elemento actual.
     *
     * @return mixed Devuelve el valor de la característica actual
     */
    public function current(): mixed
    {
        // Llama a $this->key() para saber el nombre actual y devuelve el valor que _misCaracteristicas tiene guardado con ese nombre.
        return $this->_misCaracteristicas[$this->key()];
    }

    /**
     * Devuelve la clave del elemento actual.
     *
     * @return mixed Devuelve el nombre de la característica actual
     */
    public function key(): mixed
    {
        // Devuelve el elemento de listaNombres que está en la posición _claveActual
        return $this->_listaNombres[$this->_claveActual];
    }

    /**
     * Avanza el puntero al siguiente elemento.
     *
     * @return void No devuelve nada
     */
    public function next(): void
    {
        $this->_claveActual++;
    }

    // ============================================================
    // Esta clase si permite la sobrecarga dinámica de propiedades
    // ============================================================

    /**
     * Añade o modifica una característica.
     * Si la característica ya existe, se modifica siempre. Si es nueva, solo se añade
     * mientras la lista no esté cerrada. La lista se cierra al añadir la característica
     * ULTIMA (sin distinguir mayúsculas), y a partir de ahí no se admiten nuevas.
     *
     * @param string $name  Nombre de la característica
     * @param mixed  $value Valor de la característica
     * 
     * @return void No devuelve nada
     * @throws Exception Si la lista está cerrada y la característica es nueva
     */
    public function __set(string $name, mixed $value): void
    {
        if (array_key_exists($name, $this->_misCaracteristicas)) { // Si la propiedad ya existe se puede modificar
            $this->_misCaracteristicas[$name] = $value;
        }
        else { // Si no existe
            if ($this->_listaCerrada === true) { // Si la lista ya estaba cerrada salta una excepción
                throw new Exception("No se pueden agregar más caracteristicas despues de agregar 'ULTIMA'");
            }
            else { // Si la lista sigue abierta pues se siguen introduciendo datos
                $this->_misCaracteristicas[$name] = $value;

                // Pero si el dato es "ULTIMA" cerramos la lista para que no se puedan añadir más
                if (mb_strtoupper($name) === "ULTIMA") { 
                    $this->_listaCerrada = true;
                }
            }
        }
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
