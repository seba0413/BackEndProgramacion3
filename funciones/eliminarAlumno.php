<?php

    require_once "../clases/alumno.php";

    $legajo = $_POST['legajo'];

    Alumno::eliminarAlumno("../archivos/alumnos.json", $legajo);

?>