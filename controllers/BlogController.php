<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController
{
    public static function crear(Router $router)
    {
        $blog = new Blog;
        $vendedores = Vendedor::all();

        $errores = Blog::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $blog = new Blog($_POST['blog']);

            /** SUBIDA DE ARCHIVOS */

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            // Validar
            $errores = $blog->validar();


            if (empty($errores)) {


                // Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guarda en la base de datos
                $blog->guardar();
            }
        }

        $router->render('blogs/crear', [
            'blog' => $blog,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $blog = Blog::find($id);

        $vendedores = Vendedor::all();

        $errores = Blog::getErrores();

        // Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['blog'];

            $blog->sincronizar($args);

            // Validación
            $errores = $blog->validar();

            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $blog->guardar();
            }
        }

        $router->render('/blogs/actualizar', [
            'blog' => $blog,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $blog = Blog::find($id);
                    $blog->eliminar();
                }
            }
        }
    }
}
