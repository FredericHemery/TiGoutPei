<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelleCat = null;

    #[ORM\ManyToMany(targetEntity: Plats::class, inversedBy: 'categories')]
    private Collection $numPlat;

    public function __construct()
    {
        $this->numPlat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleCat(): ?string
    {
        return $this->libelleCat;
    }

    public function setLibelleCat(string $libelleCat): static
    {
        $this->libelleCat = $libelleCat;

        return $this;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getNumPlat(): Collection
    {
        return $this->numPlat;
    }

    public function addNumPlat(Plats $numPlat): static
    {
        if (!$this->numPlat->contains($numPlat)) {
            $this->numPlat->add($numPlat);
        }

        return $this;
    }

    public function removeNumPlat(Plats $numPlat): static
    {
        $this->numPlat->removeElement($numPlat);

        return $this;
    }
}
