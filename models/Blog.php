<?php

namespace Model;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'imagen', 'entrada', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $imagen;
    public $entrada;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->entrada = $args['entrada'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (strlen($this->entrada) < 50) {
            self::$errores[] = 'La entrada es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$this->vendedorId) {
            self::$errores[] = 'Elige un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La Imagen de la propiedad es obligatoria';
        }

        return self::$errores;
    }
}
