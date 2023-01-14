<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    //clase categoria(modelo)
    class Categoria{
        private string $id;
        private string $nombre;
        private BaseDatos $db;

        public function __construct() {
            $this->db = new BaseDatos();
        }

        public function getId(){
                return $this->id;
        }

        public function setId($id){
                $this->id = $id;
                return $this;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

        public function getAll(){
            $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
            return $categorias;
        }

        public static function obtenerCategorias(){
            $categoria = new Categoria();
            $categorias = $categoria->db->query("SELECT * FROM categorias ORDER BY id DESC;");
            return $categorias;
        }

        public function getOne() {
            $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->id}");
            return $categoria->fetch(PDO::FETCH_OBJ);
        }

        public function save($name): bool{

            $ins=$this->db->prepare("INSERT INTO categorias (nombre) VALUES(:nombre)");

            $ins->bindParam(':nombre',$nombre,PDO::PARAM_STR);
            
            $nombre=$name;
            
            try{
                $ins->execute();
                $result=true;
            }catch(PDOException $err){
                echo "Algo ha salido mal";
                $result=false;
            }

            return $result;

        }
    }