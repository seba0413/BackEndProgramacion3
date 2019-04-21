<?php
    require_once "./clases/alumno.php";

    //Recepcion de datos
    $datosDELETE = fopen("php://input", "r");
    $datos = fread($datosDELETE, 1024);
    $datosAlumno = json_decode($datos);
    
    //Creacion de objeto Alumno
    $alumno = new Alumno();
    $alumno->id = $datosAlumno->id;
    $alumno->legajo = $datosAlumno->legajo;
    
    //Eliminar 
    //De base de datos
    $alumno->BorrarAlumno();

    //De archivo Json
    $alumno->eliminarAlumnoJSON("./archivos/alumnos.json");

    //De archivo txt
    $alumno->eliminarAlumnoTXT("./archivos/alumnos.txt");

?>