<?php
    require_once "./clases/alumno.php";

    $alumnos = Alumno::listarAlumnosJSON("./archivos/alumnos.json");
    Alumno::mostrarDatos($alumnos);

    // $alumnos = Alumno::listarAlumnos("../archivos/datosAlumnos.txt");
    // Alumno::mostrarDatos($alumnos);

?> 