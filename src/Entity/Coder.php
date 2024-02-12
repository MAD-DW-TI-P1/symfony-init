<?php

namespace App\Entity;

use App\Repository\CoderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoderRepository::class)]
class Coder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $edad = null;


    #[ORM\ManyToMany(targetEntity: Bootcamp::class, mappedBy: 'coder')]
    private Collection $bootcamps;

    #[ORM\ManyToMany(targetEntity: Cursos::class, mappedBy: 'coder')]
    private Collection $cursos;

    public function __construct()
    {
        $this->bootcamps = new ArrayCollection();
        $this->cursos = new ArrayCollection();
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

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    // public function getSede(): ?string
    // {
    //     return $this->sede;
    // }

    // public function setSede(string $sede): self
    // {
    //     $this->sede = $sede;

    //     return $this;
    // }

    /**
     * @return Collection<int, Bootcamp>
     */
    public function getBootcamps(): Collection
    {
        return $this->bootcamps;
    }

    public function addBootcamp(Bootcamp $bootcamp): self
    {
        if (!$this->bootcamps->contains($bootcamp)) {
            $this->bootcamps->add($bootcamp);
            $bootcamp->addCoder($this);
        }

        return $this;
    }

    public function removeBootcamp(Bootcamp $bootcamp): self
    {
        if ($this->bootcamps->removeElement($bootcamp)) {
            $bootcamp->removeCoder($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Cursos>
     */
    public function getCursos(): Collection
    {
        return $this->cursos;
    }

    public function addCurso(Cursos $curso): self
    {
        if (!$this->cursos->contains($curso)) {
            $this->cursos->add($curso);
            $curso->addCoder($this);
        }

        return $this;
    }

    public function removeCurso(Cursos $curso): self
    {
        if ($this->cursos->removeElement($curso)) {
            $curso->removeCoder($this);
        }

        return $this;
    }
}
