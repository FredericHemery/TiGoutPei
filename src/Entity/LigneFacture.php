<?php

namespace App\Entity;

use App\Repository\LigneFactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneFactureRepository::class)]
class LigneFacture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixHT = null;

    #[ORM\Column]
    private ?float $prixTTC = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $quantite = null;

    #[ORM\Column(length: 150)]
    private ?string $nomPlat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCrea = null;

    #[ORM\ManyToOne(inversedBy: 'ligneFactures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Facture $numFact = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
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

    public function getDateCrea(): ?\DateTimeInterface
    {
        return $this->dateCrea;
    }

    public function setDateCrea(\DateTimeInterface $dateCrea): static
    {
        $this->dateCrea = $dateCrea;

        return $this;
    }

    public function getNumFact(): ?Facture
    {
        return $this->numFact;
    }

    public function setNumFact(?Facture $numFact): static
    {
        $this->numFact = $numFact;

        return $this;
    }
}
