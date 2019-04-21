<?php
    require_once "./clases/alumno.php";

    //Recepcion de datos
    $datosPUT = fopen("php://input", "r");
    $datos = fread($datosPUT, 1024);
    $datosAlumno = json_decode($datos);

    //Creacion objeto alumno
    $alumno = new Alumno();
    $alumno->constructor($datosAlumno->nombre, $datosAlumno->edad, $datosAlumno->dni, $datosAlumno->legajo, $datosAlumno->id);

    //Guardar
    //En base de datos
    Alumno::Guardar($alumno,null);
    //En archivo JSON
    $alumno->modificarAlumnoJSON("./archivos/alumnos.json");
    //En archivo TXT
    $alumno->modificarAlumnoTXT("./archivos/alumnos.txt");


?>