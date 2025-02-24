<?php

namespace Generico;

use Tablas\Articulo;

class Linea extends Modelo
{
    private Articulo $articulo;
    private int $cantidad;
    private  $precio;

    public function __construct(Articulo $articulo, int $cantidad = 1)
    {
        $this->setArticulo($articulo);
        $this->setCantidad($cantidad);
        $this->setPrecio($precio);
    }

    public function getArticulo(): Articulo
    {
        return $this->articulo;
    }

    public function getPrecio() 
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setArticulo(Articulo $articulo)
    {
        $this->articulo = $articulo;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function incrCantidad()
    {
        $this->cantidad++;
    }

    public function decrCantidad()
    {
        $this->cantidad--;
    }
}
