<?php
    require_once "./clases/alumno.php";

    //Listar desde Base de datos
    $alumnosBD = Alumno::TraerTodoLosAlumnos();
    Alumno::mostrarDatos($alumnosBD);

    //Listar desde archivo JSON
    $alumnosJSON = Alumno::listarAlumnosJSON("./archivos/alumnos.json");
    Alumno::mostrarDatosDesdeArchivo($alumnosJSON);

    //Listar desde archivo TXT
    $alumnosTXT = Alumno::listarAlumnosTXT("./archivos/alumnos.txt");
    Alumno::mostrarDatosDesdeArchivo($alumnosTXT);


?> 