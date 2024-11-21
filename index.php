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
        session_start();
        if(isset($_POST['volver'])){ 
        //si pinchamos en volver en rompecabezas.php, 
        //destruimos la sesión para volver a jugar
            session_destroy();
        }
        ?>
        
        <form action="rompecabezas.php" method="post">
            Elige el tamaño del rompecabezas
            <br>
            <input type="submit" name="eleccion" value="3">
            <input type="submit" name="eleccion" value="4">
            <input type="submit" name="eleccion" value="5">
        </form>
    </body>
</html>
