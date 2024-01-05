<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatsRepository::class)]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomPlat = null;

    #[ORM\Column]
    private ?float $prixVenteHTPlat = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionPlat = null;

    #[ORM\Column]
    private ?float $prixRevient = null;

    #[ORM\Column]
    private ?float $prixVenteTTCPlat = null;

    #[ORM\ManyToMany(targetEntity: Constitue::class, mappedBy: 'numPlat')]
    private Collection $constitues;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'numPlat')]
    private Collection $categories;

    #[ORM\Column(length: 50)]
    private ?string $nomImage = null;

    #[ORM\Column(length: 50)]
    private ?string $imgDescription = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $quantite = null;

    #[ORM\Column(length: 50)]
    private ?string $categorie = null;

    public function __construct()
    {
        $this->constitues = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlat(): ?string
    {
        return $this->nomPlat;
    }

    public function setNomPlat(string $nomPlat): static
    {
        $this->nomPlat = $nomPlat;

        return $this;
    }

    public function getPrixVenteHTPlat(): ?float
    {
        return $this->prixVenteHTPlat;
    }

    public function setPrixVenteHTPlat(float $prixVenteHTPlat): static
    {
        $this->prixVenteHTPlat = $prixVenteHTPlat;

        return $this;
    }

    public function getDescriptionPlat(): ?string
    {
        return $this->descriptionPlat;
    }

    public function setDescriptionPlat(string $descriptionPlat): static
    {
        $this->descriptionPlat = $descriptionPlat;

        return $this;
    }

    public function getPrixRevient(): ?float
    {
        return $this->prixRevient;
    }

    public function setPrixRevient(float $prixRevient): static
    {
        $this->prixRevient = $prixRevient;

        return $this;
    }

    public function getPrixVenteTTCPlat(): ?float
    {
        return $this->prixVenteTTCPlat;
    }

    public function setPrixVenteTTCPlat(float $prixVenteTTCPlat): static
    {
        $this->prixVenteTTCPlat = $prixVenteTTCPlat;

        return $this;
    }

    /**
     * @return Collection<int, Constitue>
     */
    public function getConstitues(): Collection
    {
        return $this->constitues;
    }

    public function addConstitue(Constitue $constitue): static
    {
        if (!$this->constitues->contains($constitue)) {
            $this->constitues->add($constitue);
            $constitue->addNumPlat($this);
        }

        return $this;
    }

    public function removeConstitue(Constitue $constitue): static
    {
        if ($this->constitues->removeElement($constitue)) {
            $constitue->removeNumPlat($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addNumPlat($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeNumPlat($this);
        }

        return $this;
    }

    public function getNomImage(): ?string
    {
        return $this->nomImage;
    }

    public function setNomImage(string $nomImage): static
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    public function getImgDescription(): ?string
    {
        return $this->imgDescription;
    }

    public function setImgDescription(string $imgDescription): static
    {
        $this->imgDescription = $imgDescription;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
