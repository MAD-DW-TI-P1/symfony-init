<?php

namespace App\Entity;

use App\Repository\BootcampRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BootcampRepository::class)]
class Bootcamp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $sede = null;

    #[ORM\ManyToMany(targetEntity: Coder::class, inversedBy: 'bootcamps')]
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

    public function getSede(): ?string
    {
        return $this->sede;
    }

    public function setSede(string $sede): self
    {
        $this->sede = $sede;

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
