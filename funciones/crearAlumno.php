<?php
    require_once "./clases/alumno.php";

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $legajo = $_POST['legajo'];

    $alumno = new Alumno();
    $alumno->constructor($nombre, $edad, $dni, $legajo);
    Alumno::Guardar($alumno);

    //$alumno->guardarAlumnoJSON("./archivos/alumnos.json");

    // $alumno->guardarAlumnoTXT("../archivos/alumnos.txt");

?>