<?php

    namespace Lib;
    use PDO;
    use PDOException;

    class BaseDatos extends PDO{

        private PDO $conexion;
        private mixed $resultado;

        public function __construct(
            private $tipo_de_base = 'mysql',
            private string $servidor = SERVIDOR,
            private string $usuario= USUARIO,
            private string $pass=PASS,
            private string $base_datos=BASE_DATOS
        )
        {
            try{
                $opciones=array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    PDO::MYSQL_ATTR_FOUND_ROWS=>true
                );
                parent::__construct("{$this->tipo_de_base}:dbname={$this->base_datos};host={$this->servidor}",$this->usuario,$this->pass,$opciones);

            }catch(PDOException $err){
                echo "Ha surgido un error y no se puede conectar a la base datos.Detalle: ".$err->getMessage();
                exit;
            }
        }
        
     
    }