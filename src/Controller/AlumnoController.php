<?php
namespace App\Controller;

use App\Entity\Alumno;
use App\Entity\Asignatura;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlumnoController extends AbstractController
{

    /**
     * @Route("/listaAlumnos", name="show_alumnos")
     */
    public function showAlumnos(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $alumnos = $doctrine->getRepository(Alumno::class)->findAll();

        if(!$alumnos) {
            throw $this->createNotFoundException(
                'No hay ningún alumno'
            );
        }
        else
        {
            return $this->render('table.html.twig', [
                'titulo' => "Lista de alumnos",
                'tabla' => $alumnos
            ]);
        }
    }

    /**
     * @Route("/alumno/crea/{dni}/{nombreasig}"), name="asignalumno")
     */
    public function asignaTuraAlumno(ManagerRegistry $doctrine, string $dni, string $nombreasig): Response
    {
        $entityManager = $doctrine->getManager();

        $alumno = $doctrine->getRepository(Alumno::class)->findByDni($dni);

        $asignatura = $doctrine->getRepository(Asignatura::class)->findByNombre($nombreasig);

        $alumno->addAsignatura($asignatura);

        $entityManager->persist($alumno);
        $entityManager->persist($asignatura);
        $entityManager->flush();

        return new Response('Se ha añadido la asignatura '.$asignatura->getNombre().' al alumno '.$alumno->getNombre().' '.$alumno->getApellidos());
    }

    /**
     * @Route ("/alumno/quita/{dni}/{asignombre}"), name="quita_asignatura")
     */
    public function quitaAsignatura(ManagerRegistry $doctrine, string $dni, string $asignombre): Response
    {
        $entityManager = $doctrine->getManager();
        $alumno = $doctrine->getRepository(Alumno::class)->findByDni($dni);
        $asignatura = $doctrine->getRepository(Asignatura::class)->findByNombre($asignombre);

        $alumno->removeAsignatura($asignatura);

        $entityManager->flush();

        return new Response("El alumno ".$alumno->getNombre()." ".$alumno->getApellidos()." ya no está matriculado en la asignatura ".$asignatura->getNombre());
    }

    /**
     * @Route("/alumno/{dni}"), name="ficha_alumno")
     */
    public function fichaAlumno(ManagerRegistry $doctrine, string $dni): Response
    {
        $entityManager = $doctrine->getManager();
        $alumno = $doctrine->getRepository(Alumno::class)->findByDni($dni);
        $html = "<table>
            <tr>
                <th>DNI: </th>
                <td>".$alumno->getDni()."</td>
            </tr>
            <tr>
                <th>Nombre: </th>
                <td>".$alumno->getNombre()."</td>
            </tr>
            <tr>
                <th>Apellidos: </th>
                <td>".$alumno->getApellidos()."</td>
            </tr>
            <tr>
                <th>Fecha nacimiento: </th>
                <td>".$alumno->getFechaNacimiento()->format('d/m/Y')."</td>
            </tr>
            <tr>
                <th>Población: </th>
                <td>".$alumno->getLocalidad()."</td>
            </tr>
            <tr>
                <th>Asignaturas: </th>
                <td><ul>";

        foreach($alumno->getAsignaturas() as $asignatura)
        {
            $html = $html."<li><a href=\"http://localhost:8000/asignatura/".$asignatura->getNombre()."\">".$asignatura->getNombre()."</a></li>";
        }

        $html = $html."</ul></td></tr></table><a href=\"http://localhost:8000/listaAlumnos\">Volver a la lista de alumnos</a>";

        return new Response($html);
    }

    /**
     * @Route("/alumno/crea/{dni}/{nombre}/{apellidos}/{f_nac}/{loc}", name="create_alumno")
     */
    public function createAlumno(ManagerRegistry $doctrine, string $dni, string $nombre, string $apellidos, \DateTime $f_nac, string $loc): Response
    {
        $entityManager = $doctrine->getManager();

        // Hay que manejar la fecha string de la url y tal. Ya veremos cómo hacerlo.
        $alumno = new Alumno();
        $alumno->setDni($dni);
        $alumno->setNombre($nombre);
        $alumno->setApellidos($apellidos);
        $alumno->setFechaNacimiento($f_nac);
        $alumno->setLocalidad($loc);

        $entityManager->persist($alumno);

        $entityManager->flush();

        return new Response('Guardado alumno con id '.$alumno->getId());

    }

    /**
     * @Route ("alumno/borra/{dni}"), name="borra_alumno")
     */
    public function borraAlumno(ManagerRegistry $doctrine, string $dni): Response
    {
        $entityManager = $doctrine->getManager();

        $alumno = $doctrine->getRepository(Alumno::class)->findByDni($dni);

        $entityManager->remove($alumno);
        $entityManager->flush();

        return new Response("Alumno borrado con éxito? no sé");

    }
}

// Figure out how to make a form and use it here would be very beneficial I guess