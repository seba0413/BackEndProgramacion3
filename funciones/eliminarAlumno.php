<?php
    require_once "./clases/alumno.php";

    $datosPUT = fopen("php://input", "r");
    $fp = fopen("./archivos/eliminarAlumno.json", "w");    
    while ($datos = fread($datosPUT, 1024))
        var_dump(fwrite($fp, $datos));   
    
    // fclose($fp);
    // fclose($datosPUT);

    // $id = json_decode("./archivos/eliminarAlumno.json");

    // Alumno::eliminarAlumno("../archivos/alumnos.json", $id);

?>