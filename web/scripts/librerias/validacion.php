<?php

// - function validaEntero(int &$var, int $min, int $max, int $defecto):bool
// Esta función comprueba que $var contiene un entero cuyo valor está entre $min y $max. En $var se
// devuelve el entero saneado (en caso de no cumplir las condiciones asigna a $var el valor
// $defecto). La función devuelve true si es correcto y false en caso contrario.

/**
 * Función validaEntero() que comprueba que $var sea un número entero entre un valor $min y $max.
 *
 * @param integer $var Número entero a comprobar
 * @param integer $min Valor minimo
 * @param integer $max Valor máximo
 * @param integer $defecto Valor por defecto en caso de que no cumpla las condiciones
 * 
 * @return boolean Devuelve true si es correcto y false en caso contrario
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    $opciones = [
        'options' => [
            'min_range' => $min,
            'max_range' => $max
        ]
    ];

    $filtrado = filter_var($var, FILTER_VALIDATE_INT, $opciones);

    if ($filtrado !== false) {
        $var = $filtrado;
        $resultado = true;
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaReal(float &$var, float $min, float $max, float $defecto):bool
// Esta función comprueba que $var contiene un real cuyo valor está entre $min y $max. En $var se devuelve
// el real saneado (en caso de no cumplir las condiciones asigna a $var el valor $defecto). La
// función devuelve true si es correcto y false en caso contrario.

/**
 * Función validaReal() que comprueba que $var sea un número real entre un valor $min y $max.
 *
 * @param float $var Número real a comprobar
 * @param float $min Valor minimo
 * @param float $max Valor máximo
 * @param float $defecto Valor por defecto en caso de que no cumpla las condiciones
 * 
 * @return boolean Devuelve true si es correcto y false en caso contrario
 */
function validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    $opciones = [
        'options' => [
            'min_range' => $min,
            'max_range' => $max
        ]
    ];

    $filtrado = filter_var($var, FILTER_VALIDATE_FLOAT, $opciones);

    if ($filtrado !== false) {
        $var = $filtrado;
        $resultado = true;
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaFecha(string &$var, string $defecto):bool
// Esta función comprueba que $var contiene una fecha correcta en el formato dd/mm/aaaa. En $var se devuelve
// la fecha saneada (2 cifras para dia y mes y cuatro para año- ej fecha 1/2/2023 es válida aunque se sanea y se
// convierte en 01/02/2023). En caso de no cumplir las condiciones devuelve $defecto en
// $var. La función devuelve true si es correcta y false en caso contrario.

/**
 * Función validaFecha() que comprueba que $var, que es una fecha, sea correcta.
 *
 * @param string $var Fecha a comprobar
 * @param string $defecto Fecha por defecto
 * 
 * @return boolean Devuelve true si es correcta y false en caso contrario
 */
function validaFecha(string &$var, string $defecto): bool
{
    $arrayExp = [];
    $expFecha = '/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/';
    if (preg_match($expFecha, $var, $arrayExp)) {

        $dia = intval($arrayExp[1]);
        $mes = intval($arrayExp[2]);
        $anio = intval($arrayExp[3]);

        $esFechaValida = checkdate($mes, $dia, $anio);
        if (!$esFechaValida) {
            $var = $defecto;
            $resultado = false;
        } else {
            // Sanear fecha
            $diaSaneado = str_pad($dia, 2, "0", STR_PAD_LEFT);
            $mesSaneado = str_pad($mes, 2, "0", STR_PAD_LEFT);

            $var = $diaSaneado . "/" . $mesSaneado . "/" . $anio;
            $resultado = true;
        }
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaHora(string &$var, string $defecto):bool
// Esta función comprueba que $var contiene una hora correcta en el formato hh:mm:ss . En $var
// se devuelve la hora saneada (2 cifras para hora, min, segundos - Ej 0:5:1, hora valida aunque
// se sanea y se convierte a 00:05:01). En caso de no cumplir las condiciones devuelve $defecto
// en $var. La función devuelve true si es correcta y false en caso contrario.

/**
 * Función validaHora() que comprueba que $var, que es una hora en concreto, sea correcta.
 *
 * @param string $var Hora a comprobar
 * @param string $defecto Hora por defecto
 * 
 * @return boolean Devuelve true si es correcta y false en caso contrario
 */
function validaHora(string &$var, string $defecto): bool
{
    $arrayExp = [];
    $expHora = '/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/';
    if (preg_match($expHora, $var, $arrayExp)) {

        $horas = intval($arrayExp[1]);
        $minutos = intval($arrayExp[2]);
        $segundos = intval($arrayExp[3]);

        if ($horas > 23 || $minutos > 59 || $segundos > 59) {
            $var = $defecto;
            $resultado = false;
        } else {
            // Sanear hora
            $horasSaneadas = str_pad($horas, 2, "0", STR_PAD_LEFT);
            $minutosSaneados = str_pad($minutos, 2, "0", STR_PAD_LEFT);
            $segundosSaneados = str_pad($segundos, 2, "0", STR_PAD_LEFT);

            $var = $horasSaneadas . ":" . $minutosSaneados . ":" . $segundosSaneados;
            $resultado = true;
        }
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaEmail(string &$var, string $defecto):bool
// Esta función comprueba que $var contiene un email correcto en el formato aaaaa@bbbb.ccc.
// En $var se devuelve el email saneado (en caso de no cumplir las condiciones devuelve $defecto).
// La función devuelve true si es correcto y false en caso contrario.

/**
 * Función que comprueba que $var, que es un Email, sea correcto
 *
 * @param string $var Email a comprobar
 * @param string $defecto Email por defecto
 * 
 * @return boolean Devuelve true si es correcto y false en caso contrario
 */
function validaEmail(string &$var, string $defecto): bool
{
    $filtrado = filter_var($var, FILTER_VALIDATE_EMAIL);

    if ($filtrado !== false) {
        $var = $filtrado;
        $resultado = true;
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaCadena(string &$var, int $longitud, string $defecto):bool
// Esta función comprueba que $var contiene una cadena de longitud máxima $longitud. En caso de no
// cumplir las condiciones se asigna a $var el valor $defecto. La función devuelve true si es
// correcto y false en caso contrario.

/**
 * Función validaCadena() que comprueba que la longitud de la cadena $var sea menor que la $longitud indicada
 *
 * @param string $var Cadena que se va a validar
 * @param integer $longitud Longitud máxima que puede alcanzar la cadena
 * @param string $defecto Cadena por defecto
 * 
 * @return boolean Devuelve true si es correcta y false en caso contrario
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{
    if (mb_strlen($var) <= $longitud) {
        $resultado = true;
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaExpresion(string &$var, string $expresion, string $defecto):bool
// Esta función comprueba que $var cumple con la expresión regular $expresion. En caso de no cumplir las
// condiciones se asigna a $var el valor por $defecto. La función devuelve true si es correcto y
// false en caso contrario.

/**
 * Función que comprueba que $var cumple con la expresión regular $expresion
 *
 * @param string $var Cadena a comprobar
 * @param string $expresion Expresión regular con la que se comprueba el primer parámetro
 * @param string $defecto Cadena por defecto
 * 
 * @return boolean Devuelve true si es correcto y false en caso contrario
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    // Hay que pasar la expresion regular aqui
    $opciones = [
        'options' => [
            'regexp' => $expresion
        ]
    ];

    $filtrado = filter_var($var, FILTER_VALIDATE_REGEXP, $opciones);

    if ($filtrado !== false) {
        $var = $filtrado;
        $resultado = true;
    } else {
        $var = $defecto;
        $resultado = false;
    }
    return $resultado;
}

// - function validaRango(mixed $var, array $posibles, int $tipo=1):bool
// Esta función comprueba que $var sea igual a uno de los elementos del array $posibles ($tipo=1) o a una
// de las claves del array $posibles ($tipo=2).
// La función devuelve true si es correcta y false en caso contrario.

/**
 * Funcion validaRango() que comprueba que $var sea igual a uno de los elementos del array $posibles ($tipo = 1)
 * o una de las claves del array $posibles ($tipo = 2)
 *
 * @param mixed $var Cadena, número o indice a buscar
 * @param array $posibles Array donde se buscara
 * @param integer $tipo 1 para buscar valores, 2 para buscar indices
 * 
 * @return boolean Devuelve true si es correcta y false en caso contrario
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    if (is_string($var)) {
        $var = mb_strtolower($var);
    }

    switch ($tipo) {
        case 1: // Buscamos el valor
            if (in_array($var, $posibles)) { // Si encontramos el valor en el array
                $resultado = true; // Encontrada
            } else {
                $resultado = false; // No encontrada
            }
            break;
        case 2: // Buscamos la clave
            if (array_key_exists($var, $posibles)) { // Si encontramos la clave en el array
                $resultado = true; // Encontrada
            } else {
                $resultado = false; // No encontrada
            }
            break;
        default:
            $resultado = false;
            break;
    }
    return $resultado;
}
