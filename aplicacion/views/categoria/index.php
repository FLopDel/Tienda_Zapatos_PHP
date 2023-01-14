<h1>Gestion categorias</h1>

<?php if(isset($_SESSION['admin'])):?>
    <a href="<?=base_url?>categoria/crear">
    Crear categoria
</a>
<?php endif;?>



<table>
    <tr>
        <th>NOMBRE</th>
    </tr>
    <?php while($cat = $categorias->fetch(PDO::FETCH_OBJ)):?>
        <tr>
            <td><?=$cat->nombre;?></td>
        </tr>
        <?php endwhile;?>
</table>