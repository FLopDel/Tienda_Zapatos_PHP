<h1>Crear Productos</h1>
        <form action="<?=base_url?>productos/save" method="POST" enctype="multipart/form-data">
            <label for="categoria">Categoria_id</label>
            <input type="text" name="data[categoria_id]" required/>
            <br><br>

            <label for="nombre">Nombre</label>
            <input type="text" name="data[nombre]" required/>
            <br><br>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="data[descripcion]" required/>
            <br><br>

            <label for="precio">Precio</label>
            <input type="textarea" name="data[precio]" required/>
            <br><br>

            <label for="stock">Stock</label>
            <input type="text" name="data[stock]" required/>
            <br><br>

            <label for="fecha">Fecha</label>
            <input type="date" name="data[fecha]" required/>
            <br><br>

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" required/>
            <br><br>

            <input type="submit" value="Guardar"/>
        </form>