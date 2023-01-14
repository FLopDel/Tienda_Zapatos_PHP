<h1>Crear Categoria</h1>
        <form action="<?=base_url?>categoria/save" method="POST">
            <label for="text">Nombre</label>
            <input type="text" name="nombre" required/>

            <input type="submit" value="Guardar"/>
        </form>