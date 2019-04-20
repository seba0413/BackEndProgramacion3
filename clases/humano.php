<?php

class Humano
{
    public $nombre;
    public $edad;
    
    public function retornarJson(){
        //json_encode retorna la representacion JSON del valor dado
        $datos =  json_encode($this) . PHP_EOL;
        return $datos;
    }
}

?>