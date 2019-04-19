<?php
    include "persona.php";

    class Alumno extends Persona{
    
        public $legajo;

        function __construct($nombre, $edad, $dni, $legajo) 
        {
            parent::__construct($nombre, $edad, $dni);
            $this->legajo = $legajo;
        }

        public function guardarAlumno($path)
        {
            $datosAlumno = "{$this->nombre};{$this->edad};{$this->dni};{$this->legajo}".PHP_EOL;

            if (file_exists($path))
            {
                //EL modo "a" coloca el puntero al fichero al final de mismo. Si no existe, se intenta crear
                $file = fopen($path, "a");
                fwrite($file, $datosAlumno);// datosAlumno es un string con los datos del alumno
                fclose($file);
            }  
            else
            {
                //El modo "w" coloca el puntero al fichero al principio del fichero. Si no existe, se intenta crear
                $file = fopen($path, "w");
                fwrite($file, $datosAlumno);
                fclose($file);
            }
        }

        
        public function guardarAlumnoJSON($path)
        {
            if (file_exists($path))
            {
                $file = fopen($path, "a");
                fwrite($file, $this->retornarJson());
                fclose($file);
            }  
            else
            {
                $file = fopen($path, "w");
                fwrite($file, $this->retornarJson());
                fclose($file);
            }
        }

        public static function listarAlumnos($path)
        {
            if (file_exists($path))
            {
                $gestor = fopen($path, "r");
                while(!feof($gestor))
                {
                    //fgets retorna un string con una linea desde el puntero a un fichero
                    $datosAlumno = fgets($gestor, filesize($path));
                    //explode divide un string en varios strings mediante el delimitador indicado como parametro
                    $arrayDatosAlumno = explode(";", $datosAlumno);
                    $alumno = new Alumno($arrayDatosAlumno[0], $arrayDatosAlumno[1], $arrayDatosAlumno[2], $arrayDatosAlumno[3]);
                    $arrayAlumnos[] = $alumno;
                }            
                fclose($gestor);
            }  
            return $arrayAlumnos;
        }

        public static function mostrarDatos($alumnos)
        {
            foreach($alumnos as $alumno)
            {
                echo "Nombre: {$alumno->nombre}, Edad: {$alumno->edad}, Dni: {$alumno->dni}, Legajo: {$alumno->legajo}".PHP_EOL;
            }
        }

        public static function listarAlumnosJSON($path)
        {
            if (file_exists($path))
            {
                $gestor = fopen($path, "r");
                while(!feof($gestor))
                {
                    $contenido = fgets($gestor, filesize($path));
                    $datosAlumno = json_decode($contenido, true);
                    $alumno = new Alumno($datosAlumno['nombre'], $datosAlumno['edad'], $datosAlumno['dni'], $datosAlumno['legajo']);
                    $arrayAlumnos[] = $alumno;
                } 
                array_pop($arrayAlumnos);           
                fclose($gestor);
            }
        return $arrayAlumnos;
        }

        public function modificarAlumno($path)
        {
            $alumnosArray = Alumno::listarAlumnosJSON($path);
            foreach($alumnosArray as $alumno)
            {
                if($alumno->legajo == $this->legajo)
                {
                    $alumno->nombre = $this->nombre;
                    $alumno->edad = $this->edad;
                    $alumno->dni = $this->dni;
                    break;
                }
            }

            $file = fopen($path, "w");
            foreach ($alumnosArray as $alumno)
            {
                fwrite($file, $alumno->retornarJson());
            }
                
            fclose($file); 
        }

        public static function eliminarAlumno($path, $legajo)
        {
            $alumnosArray = Alumno::listarAlumnosJSON($path);
            for($i = 0; $i<count($alumnosArray); $i++)
            {
                if($alumnosArray[$i]->legajo == $legajo)
                {
                    while($i < count($alumnosArray)-1)
                    {
                        $alumnosArray[$i] = $alumnosArray[$i+1];
                        $i++;
                    }
                }
            }
            array_pop($alumnosArray);

            $file = fopen($path, "w");
            foreach ($alumnosArray as $alumno)
            {
                fwrite($file, $alumno->retornarJson());
            }
            fclose($file);
        }

        public function guardarFoto($foto)
        {        
            //Ruta temporal de la foto.
            $ruta = $foto['tmp_name'];
            //Separo el string del nombre de la foto por puntos y me quedo con la ultima parte que es la extension
            $extension = explode(".",$foto['name']);
            $index = count($extension) - 1;
            //Guardo la ruta del servidor donde se va a guardar la foto. 
            $rutafoto = "../fotos/{$this->legajo}{$this->nombre}.{$extension[$index]}";
            //Obtengo la fecha de hoy
            $fecha = date("d") . "-" . date("m") . "-" . date("Y");
            //Guardo la ruta del servidor donde voy a backupear las fotos viejas
            $rutaBackup = "../fotosBackup/{$this->legajo}{$this->nombre}{$fecha}.{$extension[$index]}";
            //Ruta de la imagen png
            $estampa = "../fotos/estampa.png";
            
            if(!$this->backupFoto($ruta, $rutafoto, $rutaBackup))
            {
                move_uploaded_file($ruta, $rutafoto);            
            }  

            $this->insertarEstampa($rutafoto, $estampa);        
        }

        function backupFoto($rutaTemporal, $rutaOriginal, $rutaDestino)
        {
            if(file_exists($rutaOriginal))
            {
                rename($rutaOriginal, $rutaDestino);
                move_uploaded_file($rutaTemporal, $rutaOriginal);
                return true;
            }

            return false;  
        }

        function insertarEstampa($urlimagen, $urlestampa)
        {
            // Cargar la estampa y la foto para aplicarle la marca de agua
            $estampa = imagecreatefrompng($urlestampa);
            $im = imagecreatefromjpeg($urlimagen);
            // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
            $margen_dcho = 10;
            $margen_inf = 10;
            $sx = imagesx($estampa);
            $sy = imagesy($estampa);
            // Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
            // ancho de la foto para calcular la posición de la estampa. 
            imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));
            // Imprimir y liberar memoria
            imagejpeg($im, $urlimagen);
            imagedestroy($im);
        }
    }
?>