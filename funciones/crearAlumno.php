<?php
    require_once "./clases/alumno.php";

    //Recepcion de datos
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $legajo = $_POST['legajo'];
    $foto = $_FILES['foto'];

    //Creacion objeto alumno
    $alumno = new Alumno();
    $alumno->constructorSinId($nombre, $edad, $dni, $legajo);

    //Guardar
    //En base de datos
    Alumno::Guardar($alumno, $foto);
    //En archivo JSON
    $alumno->guardarAlumnoJSON("./archivos/alumnos.json");
    //En archivo TXT
    $alumno->guardarAlumnoTXT("./archivos/alumnos.txt");

?>