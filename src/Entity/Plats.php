<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PlatsRepository::class)]
#[UniqueEntity(fields: ['nomPlat'], message: 'Le plat existe déja')]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    #[Assert\NotBlank (message: "veuillez remplir ce champ")]
    #[Assert\NotNull (message: "null n'est pas recevable")]
    #[Assert\Length(min: "2", max: "100",minMessage:"au moins deux caractères", maxMessage: "maximum 100 caractères" )]
    #[Assert\Regex('/^[a-zA-Z0-9\s\']+$/u',message: "Veuillez ne pas entrer de caracteres speciaux")]
    #[Assert\NoSuspiciousCharacters]
    private ?string $nomPlat = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    private ?float $prixVenteHTPlat = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\NoSuspiciousCharacters]
    #[Assert\Regex('/^[a-zA-Z0-9\sàâäçéèêëîïôöùûüÿ.,;:!?"\'()\-]+$/',message: "Veuillez ne pas entrer de caracteres speciaux")]
    private ?string $descriptionPlat = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero (message: "Veuillez entrer un nombre positif")]
    private ?float $prixRevient;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero (message: "Veuillez entrer un nombre positif")]
    private ?float $prixVenteTTCPlat;

    #[ORM\ManyToMany(targetEntity: Constitue::class, mappedBy: 'numPlat')]
    private Collection $constitues;

    #[ORM\Column(length: 50,nullable: true)]
    #[Assert\NoSuspiciousCharacters]
    #[Assert\Regex('/^[a-zA-Z0-9\sàâäçéèêëîïôöùûüÿ.,;:!?"\'()\-]+$/',message: "Veuillez éviter les caracteres speciaux")]
    private ?string $nomImage = null;

    #[ORM\Column(length: 50,nullable: true)]
    #[Assert\NoSuspiciousCharacters]
    #[Assert\Regex('/^[a-zA-Z0-9\sàâäçéèêëîïôöùûüÿ.,;:!?"\'()\-]+$/',message: "Veuillez ne pas entrer de caracteres speciaux")]
    private ?string $imgDescription = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Regex('/^\d+$/',message: "Veuillez entrer un entier positif")]
    private ?int $quantite = null;


    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categoriePlat = null;

    public function __construct()
    {
        $this->constitues = new ArrayCollection();
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


    public function getCategoriePlat(): ?Categorie
    {
        return $this->categoriePlat;
    }

    public function setCategoriePlat(?Categorie $categoriePlat): static
    {
        $this->categoriePlat = $categoriePlat;

        return $this;
    }
}
