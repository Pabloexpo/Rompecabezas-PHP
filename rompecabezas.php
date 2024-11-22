<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start(); //Empezamos la sesión
        require_once 'funciones.php'; //Llamamos al php que tiene la funcion de intercambiar valores del array

        if (isset($_POST['eleccion'])) { //Si hay post, le damos el valor de la eleccion de index.php
            $eleccion = $_POST['eleccion'];
        } else if (isset($_SESSION['eleccion'])) { //pero si hay sesión, le adjudicamos lo que tengamos en la session
            $eleccion = $_SESSION['eleccion'];
        }


//        filas y columnas dependiendo de la elección
        $filas = $eleccion;
        $columnas = $eleccion;

//        máximo de los valores que van a ir dentro del array
        $maximo = (($eleccion * $eleccion) - 1);
        $minimo = 1;

//        elaboramos un array con los valores del 1 al máximo establecido
        $rango = range($minimo, $maximo);
//        desordenamos los valores del $rango
        shuffle($rango);

//        Rellenamos el array final en el caso de que no tengamos session        
        if (isset($_SESSION['tablero'])) {
            //si hay tablero, este será el FINAL, dado ya la vuelta
            $arrayFinal = $_SESSION['tablero'];
        } else {
            $array = Array();
            for ($i = 0; $i < $filas; $i++) {
                $fila = []; //reiniciamos la fila
                $filaUltima = []; //solo la utilizamos en la última fila
                for ($j = 0; $j < $columnas; $j++) {
                    if ($i == $filas - 1) {
                        $filaUltima[] = array_pop($rango);
                        $fila = array_reverse($filaUltima); //ponemos el espacio en blanco de primera posición
                    } else {
                        //si no estamos en la última fila, añadimos normal
                        $fila[] = array_pop($rango);
                    }
                }
                $array[] = $fila;
            }
            //le damos la vuelta al array
            $arrayFinal = array_reverse($array);
        }

//        mostramos elementos si pulsamos en el tablero

        if (isset($_POST['valor'])) {
            //Recuperamos las posiciones cardinales del botón que hemos pulsado
            $posI = substr($_POST['valor'], 0, 1);
            $posJ = substr($_POST['valor'], 1, 1);

            
            //recuperamos el valor anterior
            $valorAnterior= $_SESSION['valorElegido'];

            //encontramos el indice de la posición anterior
            foreach ($arrayFinal as $fila => $subarray) {
//            Vamos a buscar por fila y columna en un foreach, es decir, vamos
//              a pasar fila a fila buscando el valor, si se encuentra, en 
//              un array_search indicamos la columna, la fila ya la tendríamos 
//              en el foreach
                $columna = array_search($valorAnterior, $subarray);
                if ($columna !== false) {
                    $columnaAnterior = $columna;
                    $filaAnterior = $fila; 
                    break;
                }
            }
            //Hacemos un método burbuja para intercambiar las posiciones
            $arrayTemporal = $arrayFinal[$posI][$posJ];
            $arrayFinal[$posI][$posJ]=$arrayFinal[$filaAnterior][$columnaAnterior];
            $arrayFinal[$filaAnterior][$columnaAnterior]=$arrayTemporal;
            
            //Una vez hecho, nuestro session cambia al post
            $valorElegido=$arrayFinal[$posI][$posJ];
            $_SESSION['valorElegido'] = $valorElegido;
            
        } else {
//            si no hemos picado nada por post, estaremos en la posición inicial
            $posI = 0;
            $posJ = 0;
            $valorElegido = $arrayFinal[$posI][$posJ];
//        lo metemos en una sesión para trabajar con él al pulsar el botón
            $_SESSION['valorElegido'] = $valorElegido;
        }
        
//        Ahora tenemos que comprobar que el array esté ordenado
        $ordenado = compruebaArray($arrayFinal); 
        echo $ordenado;
//        Tendremos un booleano que nos dirá si el array está ordenado o no
        
//        mostramos como tabla
        echo "<table border='1'>";

//        TENEMOS QUE EMPEZAR EN MENOS UNO PORQUE AL RECORRER EL ARRAY HACIA ATRÁS
//        EMPEZAREMOS EN EL ÍNDICE FINAL MENOS UNO, SI NO ESTARÍAMOS ABORDANDO 
//        EL BUCLE FUERA DEL ARRAY
        for ($i = 0; $i < $filas; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $columnas; $j++) {
                $valor = $arrayFinal[$i][$j];
                echo "<form method='post'>";
                if (($i == $posI) && ($j == $posJ)) {
                    echo "<td>$valorElegido</td>";
                //TODAS ESTAS POSICIONES VAN DESDE LA POSICION QUE TENGAMOS ACTUALMENTE 
                } else if (($i == ($posI + 1)) && ($j == $posJ)) { //posicion 1,0
                    echo "<td><button type='submit' value='$i$j' " . ($ordenado ? "disabled" : "") . " name='valor' style='background-color:red'>$valor</button></td>";
                } else if (($i == ($posI - 1)) && ($j == $posJ)) { //posicion -1,0
                    echo "<td><button type='submit' value='$i$j' " . ($ordenado ? "disabled" : "") . " name='valor' style='background-color:red'>$valor</button></td>";
                } else if (($i == $posI) && ($j == ($posJ - 1))) { //posicion 0. -1
                    echo "<td><button type='submit' value='$i$j' " . ($ordenado ? "disabled" : "") . " name='valor' style='background-color:red'>$valor</button></td>";
                } else if (($i == $posI) && ($j == ($posJ + 1))) { //posicion 0,1
                    echo "<td><button type='submit' value='$i$j' " . ($ordenado ? "disabled" : "") . " name='valor' style='background-color:red'>$valor</button></td>";
                } else {
                    echo "<td><button type='submit' value='$i$j' name='valor' disabled>$valor</button></td>";
                }
                echo "</form>";
            }
            echo "</tr>";
        }
        echo "</table>";

        $_SESSION['tablero'] = $arrayFinal;
        $_SESSION['eleccion'] = $eleccion;
        ?>
        <!--        Volvemos hacia atrás-->
        <form action="index.php" method="post"> 
            <input type="submit" name="volver" value="Volver">  
        </form>

    </body>
</html>