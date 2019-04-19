<?php

class Humano
{
    public $nombre;
    public $edad;

    function __construct($nombre, $edad) 
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
    
    public function retornarJson(){
        //json_encode retorna la representacion JSON del valor dado
        $datos =  json_encode($this) . PHP_EOL;
        return $datos;
    }
}

?>