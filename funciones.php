<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

//      Vamos a ver una funcion para comprobar si un array está ordenado

        function compruebaArray(&$array) {
            $filas = count($array); //contamos las filas

            for ($i = 0; $i < $filas; $i++) {
                $columnas = count($array[$i]); //contamos las columnas

                for ($j = 0; $j < $columnas; $j++) {
                    // Comparamos con el número anterior
                    if ($j > 0 && $array[$i][$j] < $array[$i][$j - 1]) {
                        return false;
                    }

                    // Comparar con el último elemento de la fila anterior
//                    if ($i > 0 && $array[$i][$j] < $array[$i - 1][$columnas - 1]) {
//                        return false;
//                    }
                }
            }

            // Si todos los elementos están ordenados
            return true;
        }
        ?>
    </body>
</html>
