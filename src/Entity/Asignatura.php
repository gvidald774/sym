<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsignaturaRepository::class)
 */
class Asignatura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $curso;

    /**
     * @ORM\ManyToMany(targetEntity=Alumno::class, inversedBy="asignaturas")
     */
    private $Alumnos;

    public function __construct()
    {
        $this->Alumnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCurso(): ?int
    {
        return $this->curso;
    }

    public function setCurso(int $curso): self
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * @return Collection|Alumno[]
     */
    public function getAlumnos(): Collection
    {
        return $this->Alumnos;
    }

    public function addAlumno(Alumno $alumno): self
    {
        if (!$this->Alumnos->contains($alumno)) {
            $this->Alumnos[] = $alumno;
            $alumno->addAsignatura($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumno): self
    {
        $this->Alumnos->removeElement($alumno);

        return $this;
    }
}
