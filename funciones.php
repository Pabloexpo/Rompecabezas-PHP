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
            $valor = 1; //Valor a comparar con el array
            for ($i = 0; $i < $filas; $i++) {
                $columnas = count($array[$i]); //contamos las columnas
                for ($j = 0; $j < $columnas; $j++) {
                    //Ahora comparamos entre $valor y el valor del array en dónde estemos
                    if ($i == $filas - 1 && $j == $columnas - 1) {
                        //Si estamos en el último valor del array significa que
//                        hemos llegado al final comparando todos los valores
//                        y que estos han resultado iguales, como el último valor estará en blanco
//                        no habrá nada que comparar, devolvemos true y salimos

                        return true;
                    } else if ($valor == $array[$i][$j]) {
                        $valor++;
                    } else {
                        //Si no es igual, retornamos false y salimos de la función
                        return false;
                    }
                }
            }
            // Si todos los elementos están ordenados
            return true;
        }

//        $array = [];
//        $contador = 1;
//
//        for ($i = 0; $i < 3; $i++) {
//            for ($j = 0; $j < 3; $j++) {
//                if ($contador <= 8) {
//                    $array[$i][$j] = $contador++;
//                } else {
//                    $array[$i][$j] = ""; 
//                }
//            }
//        }
//        
//        
//        $boolean = compruebaArray($array); 
//        
//        echo $boolean;
        ?>
        
        
    </body>
</html>
