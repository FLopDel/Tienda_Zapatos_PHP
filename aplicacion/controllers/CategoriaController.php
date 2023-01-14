<?php
namespace Controllers;
use Models\Categoria;
use Models\Productos;
use Lib\Pages;
use Utils\Utils;

class CategoriaController{

    public function __construct(){
        $this->pages=new Pages();
    }

    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        $this->pages->render('categoria/index',['categorias'=>$categorias]);
    }

    public function crear(){
        Utils::isAdmin();
        $this->pages->render('categoria/crear');
    }

    public function save(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $this->pages->render('categoria/crear');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $categoria->save($nombre);
        }
    }


    public function ver() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $categoria = $categoria->getOne();
            
            $producto = new Productos();
            
            $productos = $producto->setProductoIdCategoria($categoria->id);
            
        }
        $this->pages->render('productos/index', ['categoria' => $categoria, 'productos' => $productos]);
    }

    
}