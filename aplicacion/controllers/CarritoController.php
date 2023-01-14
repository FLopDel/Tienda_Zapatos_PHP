<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Productos;
    use Models\Categoria;
    use Utils\Utils;


    
    class CarritoController{
        private Productos $producto;
        private Pages $pages;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> producto = new Productos();
            $this -> utils = new Utils();
        }

        public function index(){
            $producto = new Productos();
            $productos = $producto->getAll();
    
            $this->pages->render('carrito/index',['productos'=>$productos]);
        }


        public function anadir_carrito(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cod = $_POST['cod'];
                $stock = $_POST['stock'];
                if(isset($_SESSION['carrito'][$cod])){
                    $_SESSION['carrito'][$cod] += $stock; 
                }else{
                    $_SESSION['carrito'][$cod] = $stock; 
                }
                $productos = $this-> producto -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);

            }else{
                $productos = $this-> producto -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            } 
        }

        public function borrar_elementos(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cod = $_POST['cod'];
                $stock = intval($_POST['stock']);
                if(isset($_SESSION['carrito'][$cod])){
                    $_SESSION[ 'carrito'][$cod] -= $stock;
                    if($_SESSION['carrito'][$cod] <= 0){
                        unset($_SESSION['carrito'][$cod]);
                    }
                }
                $productos = $this-> producto -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            }else{
                $productos = $this-> producto -> getAll();
                $this -> pages -> render('productos/carrito',["productos" => $productos]);
            } 
        }
    }