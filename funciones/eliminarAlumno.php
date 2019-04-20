<?php
    require_once "./clases/alumno.php";

    $datosDELETE = fopen("php://input", "r");
    $datos = fread($datosDELETE, 1024);
    $datosAlumno = json_decode($datos);   
    $alumno = new Alumno();

    $alumno->id = $datosAlumno->id;
    
    $alumno->BorrarAlumno();

    // Alumno::eliminarAlumno("../archivos/alumnos.json", $id);

?>