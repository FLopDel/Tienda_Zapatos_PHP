<h1>Crear Cuentas</h1>
<?php use Utils\Utils;?>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] && $_SESSION['register'] == 'failed'):?>
    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>

<?php endif;?>
<?php Utils::deleteSession('registro');?>


<form action="<?=base_url?>Usuario/registro" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="data[nombre]" required/>

    <label for="nombre">Apellidos</label>
    <input type="text" name="data[apellidos]" required/>

    <label for="email">Email</label>
    <input type="email" name="data[email]" required/>

    <label for="contraseña">Contraseña</label>
    <input type="password" name="data[password]" required/>

    <input type="submit" name="data[]" value="Registrarse" required/>
</form>