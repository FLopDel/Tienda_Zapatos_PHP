<?php
use Models\Categoria;
use Models\Productos;
?>

<?php if(isset($_SESSION['identity'])):?>
    <!-- <li><a href="<?=base_url?>pedido/mispedidos">Mis pedidos</a></li> -->
    <li><a href="<?=base_url?>usuario/logout">Cerrar sesion</a></li>
<?php endif;?>

<?php if(isset($_SESSION['admin'])):?>
    <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
    <li><a href="<?=base_url?>productos/index">Gestionar productos</a></li>
    <!-- <li><a href="<?=base_url?>pedido/index">Gestionar pedidos</a></li> -->
<?php endif;?>

<?php
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Zapatos - Inicio</title>
</head>
<body>
<header>
        <a href="index.php">
            <h1>TIENDA DE ZAPATOS</h1>
        </a>
        <nav class="navbar">
            <ul class="opciones-sesion">
                <li>
                <a href="<?=base_url?>">Inicio</a>
                </li>
                <li>
                    <a href="<?=base_url?>usuario/identifica">Identificarse</a>
                </li>
                <li>
                    <a href="<?=base_url?>usuario/registro">Crear Cuenta</a>
                </li>
                <li>
                    <a href="<?=base_url?>carrito/index">Cesta</a>
                </li>
            </ul>
        </nav>
        
        <?php $categorias = Categoria::obtenerCategorias();?>
        
        <nav id="menu_cat">
            <ul>
                <h1>Categorias</h1>
                <?php while($cat = $categorias->fetch(PDO::FETCH_OBJ)):?>
                    <li>
                        Id:<?=$cat->id?>  <a href="<?=base_url?>Categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>

                    <?php endwhile;?>
            </ul>
        </nav>

    </header>