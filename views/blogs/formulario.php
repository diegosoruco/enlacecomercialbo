<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo Entrada" value="<?php echo s($blog->titulo); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="imagen/jpeg, imagen/png" name="blog[imagen]">

    <?php if ($blog->imagen) { ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="entrada">Entrada</label>
    <textarea id="entrada" name="blog[entrada]"><?php echo s($blog->entrada); ?></textarea>
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>
    <select name="blog[vendedorId]" id="vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach ($vendedores as $vendedor) { ?>
            <option <?php echo $blog->vendedorId === $vendedor->id ? 'selected' : ''; ?> value="<?php echo s($vendedor->id); ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </option>
        <?php } ?>
    </select>
</fieldset>