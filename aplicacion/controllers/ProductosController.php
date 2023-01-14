<?php
namespace Controllers;
use Models\Categoria;
use Models\Productos;
use Lib\Pages;
use Utils\Utils;

class ProductosController{

    public function __construct(){
        $this->pages=new Pages();
    }

    public function index(){
        Utils::isAdmin();
        $producto = new Productos();
        $productos = $producto->getAll();

        $this->pages->render('productos/index',['productos'=>$productos]);
    }

    public function crear(){
        Utils::isAdmin();
        $this->pages->render('productos/crear');
    }

    public function save(){
        Utils::isAdmin();
        $producto = new Productos();
        $this->pages->render('productos/crear');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['data']) && isset($_FILES['imagen'])){
                $product = $_POST['data'];
                $img = $_FILES['imagen'];

                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if($mimetype == "imagen/jpg"){
                    if(!is_dir('img/')){
                        mkdir('img/',0777,true);
                    }
                    $producto->setImagen($filename);
                    move_uploaded_file($file['tmp_name'],'img/'.$filename);
                }
                
                $producto->save($product,$img);
            }

            
            
        }
    }

    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Productos();
            $producto->setId();
            $product = $producto->getOne();
        }
        $this->pages->render('productos/index', ['product' => $product]);
    }

    
}