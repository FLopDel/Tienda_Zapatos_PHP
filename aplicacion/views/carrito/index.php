<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrito de la compra</title>
    </head>
    <body>
        <?php
            // $productos = anadir_carrito(array_keys($_SESSION['carrito']));
            if($productos === FALSE){
                echo "<p>No hay productos en el pedido</p>";
                exit;
            }
            echo "<h2>Carrito de la compra</h2>";
            echo "<table border='1'>";
            echo"<tr><th>Nombre</th><th>Descripción</th><th>Precio</th>
            <th>Eliminar</th></tr>";
            foreach($productos as $producto){
                $cod = $producto['id'];
                $nom = $producto['nombre'];
                $des = $producto['descripcion'];
                $precio = $producto['precio']; 

                echo "<tr><td>$nom</td><td>$des</td><td>$precio</td>
                <td>
                    <form action = 'carritoController.php' method = 'POST'>
                        <input name = 'stock' type='number' min = '1' value = '1'>
                        <input type = 'submit' value= 'Eliminar'></td>
                        <input name= 'cod' type='hidden' value ='$cod'>
                    </form>
                </td>
            </tr>";
            }
            echo "</table>";
        ?>
        <hr>
        <a href = '<?=base_url?>views/pedido/index.php'>Realizar pedido</a>
    </body>
</html>