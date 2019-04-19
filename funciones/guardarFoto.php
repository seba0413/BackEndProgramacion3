<?php
    require_once "../clases/alumno.php";

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $legajo = $_POST['legajo'];
    $foto = $_FILES['foto'];

    $alumno = new Alumno($nombre, $edad, $dni, $legajo);

    $alumno->guardarFoto($foto);

?>