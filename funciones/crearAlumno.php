<?php
    require_once "./clases/alumno.php";

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $legajo = $_POST['legajo'];

    $alumno = new Alumno($nombre, $edad, $dni, $legajo);

    $alumno->guardarAlumnoJSON("./archivos/alumnos.json");

    // $alumno->guardarAlumno("../archivos/alumnos.txt");

?>