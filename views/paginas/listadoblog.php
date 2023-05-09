<?php use Model\Vendedor; ?>

<article class="entrada-blog contenedor seccion contenido-centrado">
    <?php foreach ($blogs as $blog) { ?>
        <?php $vendedor = Vendedor::find($blog->vendedorId);
        ?>
        <div class="imagen">
            <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">
        </div>

        <div class="texto-entrada">
            <a href="/blog?id=<?php echo $blog->id; ?>">
                <h4><?php echo $blog->titulo; ?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></span> </p>

                <p><?php echo substr($blog->entrada, 0, 200); ?>...</p>
            </a>
        </div>
    <?php } ?>
</article>