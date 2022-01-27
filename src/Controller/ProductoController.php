<?php
namespace App\Controller;

use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductoController extends AbstractController
{
    /**
     * @Route("/producto/{nombre}/{precio}/{categoria_id}", name="create_producto")
     */
    public function createProducto(ManagerRegistry $doctrine, string $nombre, int $precio, int $categoria_id): Response
    {
        $entityManager = $doctrine->getManager();

        // Hay que manejar la fecha string de la url y tal. Ya veremos cómo hacerlo.
        $producto = new Producto();
        $producto->setNombre($nombre);
        $producto->setPrecio($precio);
        $categoria = $doctrine->getRepository(Categoria::class)->find($categoria_id);
        $producto->setCategoria($categoria);

        $entityManager->persist($producto);
        $entityManager->flush();

        return new Response('Guardado producto con id '.$producto->getId());

    }

    /**
     * @Route("/producto", name="muestra_productos")
     */
    public function muestraProducto(ManagerRegistry $doctrine): Response
    {
        $listaProductos = $doctrine->getRepository(Producto::class)->findAll();

        return new Response(var_dump($listaProductos));

    }
}

// Figure out how to make a form and use it here would be very beneficial I guess