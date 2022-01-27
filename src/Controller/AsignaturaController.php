<?php

namespace App\Controller;

use App\Entity\Asignatura;
use App\Entity\Alumno;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AsignaturaController extends AbstractController
{
    /**
     * @Route("/asignatura/{nombre}/{curso}"), name="create_categoria")
     */
    public function createAsignatura(ManagerRegistry $doctrine, string $nombre, int $curso): Response
    {
        $entityManager = $doctrine->getManager();

        $asignatura = new Asignatura();
        $asignatura->setNombre($nombre);
        $asignatura->setCurso($curso);

        $entityManager->persist($asignatura);
        $entityManager->flush();

        return new Response('Guardada asignatura con id '.$asignatura->getId());

    }

    /**
     * @Route("/asignatura", name="muestra_asignaturas")
     */
    public function muestraAsignaturas(ManagerRegistry $doctrine): Response
    {
        $listaAsignaturas = $doctrine->getRepository(Asignatura::class)->findAll();

        return new Response(var_dump($listaAsignaturas));

    }

    /**
     * @Route("/asignatura/{nombre}", name="muestra_alumnos_asignatura")
     */
    public function muestraAsignatura(ManagerRegistry $doctrine, string $nombre): Response
    {
        $entityManager = $doctrine->getManager();
        $asignatura = $doctrine->getRepository(Asignatura::class)->findByNombre($nombre);

        $html = "<table>
            <tr>
                <th>Nombre: </th>
                <td>".$asignatura->getNombre()."</td>
            </tr>
            <tr>
                <th>Curso: </th>
                <td>".$asignatura->getCurso()."º</td>
            </tr>
            <tr>
                <th>Alumnos: </th>
                <td><ul>";
        foreach($asignatura->getAlumnos() as $alumno)
        {
            $html = $html."<li><a href=\"http://localhost:8000/alumno/".$alumno->getDni()."\">".$alumno->getNombre()." ".$alumno->getApellidos()."</a></li>";
        }

        $html = $html."</ul></td></tr></table>";

        return new Response($html);
    }

    /**
     * @Route("/listaAsignaturas", name="show_asignaturas")
     */
    public function showAsignaturas(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $asignaturas = $doctrine->getRepository(Asignatura::class)->findAll();

        if(!$asignaturas) {
            throw $this->createNotFoundException(
                'No hay ninguna asignatura'
            );
        }
        else
        {
            return $this->render('table.html.twig', [
                'titulo' => 'Lista de asignaturas',
                'tabla' => $asignaturas
            ]);
        }
    }
}