<?php

    $dato = $_SERVER['REQUEST_METHOD'];

    switch($dato)
    {
        case "POST":
            require_once "./funciones/crearAlumno.php";
            break;
        case "GET":
            require_once "./funciones/listarAlumnos.php";
            break;
        case "PUT":
            require_once "./funciones/modificarAlumno.php";
            break;
        case "DELETE":
            require_once "./funciones/eliminarAlumno.php";
            break;
    }


?>