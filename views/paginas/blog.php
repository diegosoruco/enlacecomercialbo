<?php

use Model\Vendedor; ?>

<?php $vendedor = Vendedor::find($blog->vendedorId); ?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la entrada">

    <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></span> </p>

    <div class="resumen-propiedad">

        <p><?php echo $blog->entrada; ?></p>
    </div>
</main>