<?php

    namespace Models;
    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    //clase categoria(modelo)
    class Productos{
        public string $id;
        private string $categoria_id;
        private string $nombre;
        private string $descripcion;
        private string $precio;
        private string $stock;
        private string $fecha;
        private string $imagen;


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

        public function getCategoria_id(){
            return $this->categoria_id;
        }

        public function setCategoria_id($categoria_id){
            $this->categoria_id->$categoria_id;
            return $this;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($descripcion){
            $this->descripcion->$descripcion;
            return $this;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function setPrecio($precio){
            $this->precio->$precio;
            return $this;
        }

        public function getStock(){
            return $this->stock;
        }

        public function setStock($stock){
            $this->stock->$stock;
            return $this;
        }

        public function getOferta(){
            return $this->oferta;
        }

        public function setOferta($oferta){
            $this->oferta->$oferta;
            return $this;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha->$fecha;
            return $this;
        }

        public function getImagen(){
            return $this->$imagen;
        }

        public function setImagen($imagen){
            $this->imagen->$imagen;
            return $this;
        }

        public function getAll(){
            $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
            return $productos;
        }

        public function obtenerId(){
            $productos = $this->db->query("SELECT id FROM productos");
            return $productos;
        }

        public static function obtenerProductos(){
            $producto = new Productos();
            $productos = $producto->db->query("SELECT nombre,id,descripcion,precio,stock,imagen FROM productos ORDER BY id DESC;");
            return $productos;
        }
    
        public function getAllCategory() {
            $productos = $this->db->query("SELECT * FROM productos WHERE categoria_id={$this->categoria_id} ORDER BY id DESC;");
            return $productos;
        }

        public function save($product,$img): bool{

            $ins=$this->db->prepare("INSERT INTO productos (categoria_id,nombre,descripcion,precio,stock,fecha,imagen) VALUES(:categoria_id,:nombre,:descripcion,:precio,:stock,:fecha,:imagen)");
          
            $ins->bindParam(':categoria_id',$categoria_id);
            $ins->bindParam(':nombre',$nombre,PDO::PARAM_STR);
            $ins->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
            $ins->bindParam(':precio',$precio,PDO::PARAM_STR);
            $ins->bindParam(':stock',$stock,PDO::PARAM_STR);
            $ins->bindParam(':fecha',$fecha);
            $ins->bindParam(':imagen',$imagen);

            $categoria_id=$product['categoria_id'];
            $nombre=$product['nombre'];
            $descripcion=$product['descripcion'];
            $precio=$product['precio'];
            $stock=$product['stock'];
            $fecha=$product['fecha'];
            $imagen=$img['name'];

            
            try{
                $ins->execute();
                $result=true;
            }catch(PDOException $err){
                echo "Algo ha salido mal";
                $result=false;
            }

            return $result;

        }

        public function setProductoIdCategoria($id) {
            $categoria_id = $this->db->query("SELECT * FROM productos WHERE categoria_id={$id};");
            return $categoria_id;
        }
    }