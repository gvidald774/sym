<?php
namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria/crea/{nombre}", name="create_categoria")
     */
    public function createCategoria(ManagerRegistry $doctrine, string $nombre): Response
    {
        $entityManager = $doctrine->getManager();

        // Hay que manejar la fecha string de la url y tal. Ya veremos cómo hacerlo.
        $categoria = new Categoria();
        $categoria->setNombre($nombre);

        $entityManager->persist($categoria);

        $entityManager->flush();

        return new Response('Guardada categoría con id '.$categoria->getId());

    }

    /**
     * @Route("/categoria", name="muestra_categorias")
     */
    public function muestraCategoria(ManagerRegistry $doctrine): Response
    {
        $listaCategorias = $doctrine->getRepository(Categoria::class)->findAll();

        return new Response(var_dump($listaCategorias));

    }

    /**
     * @Route("/categoria/{id}", name="muestra_productos_categoria")
     */
    public function muestraCategoriaID(ManagerRegistry $doctrine, int $id): Response
    {
        $listaProductos = $doctrine->getRepository(Categoria::class)->find($id)->getProductos();

        $html = "<ul>";

        $html = $html.$doctrine->getRepository(Categoria::class)->find($id)->getNombre();

        for($i = 0; $i < count($listaProductos); $i++)
        {
            $html = $html."<li>".$listaProductos[$i]->getNombre()." - ".$listaProductos[$i]->getPrecio()."</>";
        }

        $html = $html."</ul>";

        return new Response($html);
    }
}