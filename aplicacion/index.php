<?php
session_start();
    require_once "autoloader.php";
    require_once './config/config.php';
    require_once 'views/layout/header.php';

    require_once 'Controllers/FrontController.php';
    use controllers\FrontController;
    FrontController::main();


?>