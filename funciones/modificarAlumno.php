<?php
    require_once "./clases/alumno.php";

    $datosPUT = fopen("php://input", "r");
    $datos = fread($datosPUT, 1024);
    $datosAlumno = json_decode($datos);

    $alumno = new Alumno();
    $alumno->constructor($datosAlumno->nombre, $datosAlumno->edad, $datosAlumno->dni, $datosAlumno->legajo, $datosAlumno->id);

    Alumno::Guardar($alumno);

?>