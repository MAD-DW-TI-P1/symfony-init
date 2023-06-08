<?php

namespace App\Entity;

use App\Repository\CursosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursosRepository::class)]
class Cursos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Coder::class, inversedBy: 'cursos')]
    private Collection $coder;

    public function __construct()
    {
        $this->coder = new ArrayCollection();
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

    /**
     * @return Collection<int, Coder>
     */
    public function getCoder(): Collection
    {
        return $this->coder;
    }

    public function addCoder(Coder $coder): self
    {
        if (!$this->coder->contains($coder)) {
            $this->coder->add($coder);
        }

        return $this;
    }

    public function removeCoder(Coder $coder): self
    {
        $this->coder->removeElement($coder);

        return $this;
    }
}
