<?php

namespace App\Entity;

use App\Repository\ConstitueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConstitueRepository::class)]
class Constitue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $quantite = null;

//    #[ORM\ManyToMany(targetEntity: Commande::class, inversedBy: 'constitues')]
    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: "num_com_id", referencedColumnName: "id")]
    private Collection $numCom;

//    #[ORM\ManyToMany(targetEntity: Plats::class, inversedBy: 'constitues')]
    #[ORM\ManyToOne(targetEntity: Plats::class)]
    #[ORM\JoinColumn(name: "num_plat_id", referencedColumnName: "id")]
    private Collection $numPlat;

    #[ORM\Column]
    private ?float $prixHT = null;

    #[ORM\Column]
    private ?float $prixTTC = null;

    public function __construct()
    {
        $this->numCom = new ArrayCollection();
        $this->numPlat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getNumCom(): Collection
    {
        return $this->numCom;
    }

    public function addNumCom(Commande $numCom): static
    {
        if (!$this->numCom->contains($numCom)) {
            $this->numCom->add($numCom);
        }

        return $this;
    }

    public function removeNumCom(Commande $numCom): static
    {
        $this->numCom->removeElement($numCom);

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

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): static
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): static
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }
}
