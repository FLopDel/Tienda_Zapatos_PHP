<h1>Gestion producto</h1>

<?php if(isset($_SESSION['admin'])):?>
    <a href="<?=base_url?>productos/crear">
    Crear producto
</a>
<?php endif;?>



<table border="1">
    <tr>
        <th>NOMBRE</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>IMAGEN</th>
        <th>COMPRAR</th>
    </tr>
    <?php while($cat = $productos->fetch(PDO::FETCH_OBJ)):?>
        <tr>
            <td><?=$cat->nombre;?></td>
            <td><?=$cat->descripcion;?></td>
            <td><?=$cat->precio;?></td>
            <td><?=$cat->stock;?></td>
            <td><img width="100px" src='<?=base_url?>img/<?=$cat->imagen;?>'/></td>
            <td>
                <form action='añadir.php' method="POST"> 
                    <input name="unidades" type="number" min="1" value="1">
                    <input type="submit" value="Comprar">
                    <input name="cod" type="hidden" value='$cod'>
                </form>
            </td>
        </tr>
        
        <?php endwhile;?>
</table>