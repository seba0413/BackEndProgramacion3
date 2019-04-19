<?php
    require_once "./clases/Alumno.php";

    $nombre = $_PUT['nombre'];
    $edad = $_PUT['edad'];
    $dni = $_PUT['dni'];
    $legajo = $_PUT['legajo'];

    $alumno = new Alumno($nombre, $edad, $dni, $legajo);

    $alumno->modificarAlumno("./archivos/alumnos.json");

?>