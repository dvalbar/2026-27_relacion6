<?php

/**
 * Enumerado Material con valor entero asociado a cada caso.
 */
enum Materiales: int
{
    case MADERA = 5;
    case HIERRO = 10;
    case PLASTICO = 15;
    case ACERO = 20;

    // - Método descripcion que devuelve el nombre del caso concreto.

    /**
     * Devuelve el nombre del caso concreto (por ejemplo "Madera").
     *
     * @return string Devuelve el nombre del caso concreto (por ejemplo "Madera").
     */
    function descripcion(): string
    {
        // Devuelve el nombre del caso
        return $this->name;
    }

    // - Método valor que devuelve el valor del caso concreto.

    /**
     * Devuelve el valor numérico del caso concreto (por ejemplo 5).
     *
     * @return int Devuelve el valor numérico del caso concreto (por ejemplo 5).
     */
    function valor(): int
    {
        // Devuelve el valor del caso
        return $this->value;
    }

    // - Método estático casos que devuelve un array con todos los casos.

    /**
     * Devuelve un array con todos los casos del enumerado.
     *
     * @return array Devuelve un array con todos los casos del enumerado.
     */
    static function casos(): array
    {
        // Devuelve todos los casos del enumerado
        return self::cases();
    }

}
