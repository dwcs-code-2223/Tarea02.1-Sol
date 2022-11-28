<?php

const FILAS_POR_DEFECTO = 4;
const COLUMNAS_POR_DEFECTO = 4;

const DNI_MIN_DESTACADO = 30000000;
const DNI_MAX_DESTACADO = 40500000;

const DNI_LENGTH = 9;
const DNI_DIVISOR_LETRA = 23;
const DNI_LETRA_OFFSET = -1;

const DNI_MIN_VALUE = 1;
const DNI_MAX_VALUE = 99999999;

/**
 * Función que escribe un array bidimensional en una tabla html
 */
function printArrayBi(array $array): void {
    echo "<div style='font-family: Monospace'>";
    echo "<table><thead><tr><th colspan=" . count($array[0]) . ">DNIs personalizados</th></tr></thead><tbody>";
    foreach ($array as $fila) {
        echo "<tr>";
        foreach ($fila as $elem) {

            if (!isInRange($elem, DNI_MIN_DESTACADO, DNI_MAX_DESTACADO)) {
                echo "<td>$elem</td>";
            } else {
                echo "<td class='destacado'>$elem</td>";
            }
        }
        echo"</tr>";
    }
    echo "</tbody></table>";
    echo "</div>";
}

/*
 * Comprueba si $dni está en el rango [$min, $max], extremos incluidos
 */

function isInRange(string $dni, int $min, int $max) {
    $num = substr($dni, 0, DNI_LENGTH - 1);
    //$num = (int) $num;
    $resultado = (($num >= $min) && ($num <= $max));
    return $resultado;
}

/**
 * Función que crea un array de $num_rows filas x $num_colums columnas
 * con enteros aleatorios entre $min y $max como valores
 */
function crearArrayRandomDNI($num_rows = FILAS_POR_DEFECTO,
        $num_colums = COLUMNAS_POR_DEFECTO) {
    $array = [];
    for ($i = 0; $i < $num_rows; $i++) {
        for ($j = 0; $j < $num_colums; $j++) {
            $array[$i][$j] = crearRandomDNI();
        }
    }
    return $array;
}

/* Crea dni personalizado entre 1 y 100M-1. La letra es la misma que la del DNI, pero desplazada una posición a la izquierda. */

function crearRandomDNI(): string {
    $num = mt_rand(DNI_MIN_VALUE, DNI_MAX_VALUE);
    $dni = str_pad($num, DNI_LENGTH - 1, '0', STR_PAD_LEFT) . "TRWAGMYFPDXBNJZSQVHLCKE"[(($num) % DNI_DIVISOR_LETRA) + DNI_LETRA_OFFSET];

    return $dni;
}


//Comprueba si cadena de entrada es un string asimilable a un número, sin puntos decimales y positivo
function isValidNumber(string $input): bool {
  
    return(is_numeric($input) && (strpos($input, ".")===false) && ($input > 0));
}
