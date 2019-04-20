<?php
    require_once "./clases/alumno.php";

    // $alumnos = Alumno::TraerTodoLosAlumnos();
    // Alumno::mostrarDatos($alumnos);

    $alumnos = Alumno::listarAlumnosJSON("./archivos/alumnos.json");
    Alumno::mostrarDatos($alumnos);

?> 