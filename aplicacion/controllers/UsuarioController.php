<?php
namespace Controllers;
use Models\Usuario;
use Lib\Pages;

class UsuarioController{
    private Pages $pages;

    public function __construct(){
        $this->pages=new Pages();
    }

    public function index(){}

    public function registro(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($_POST['data']){
                $registrado = $_POST['data'];

                $registrado['password'] = password_hash($registrado['password'], PASSWORD_BCRYPT, ['cost'=>4]);

                $usuario = Usuario::fromArray($registrado);

                $save=$usuario->save();
                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }


        $this->pages->render('usuario/registro');

    }

    public function identifica(){
        $this->pages->render('usuario/login');
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['data']){
                $auth = $_POST['data'];
                $usuario = Usuario::fromArray($auth);
            
                $identity = $usuario->login();
                
                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;
                
                    if($identity->rol == 'admin'){
                        $_SESSION['admin'] = true;
                       
                    }
                }else{
                    $_SESSION['error_login'] = 'Identificacion fallida';
                }
            }
            
            header('Location: ' . base_url);
        }
    }

    public function logout(){

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

    
}
