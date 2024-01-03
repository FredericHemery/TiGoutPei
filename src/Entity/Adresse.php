<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $rue = null;

    #[ORM\Column(length: 150)]
    private ?string $commune = null;

    #[ORM\Column(length: 5)]
    private ?string $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'adresse', targetEntity: Client::class)]
    private Collection $idClient;

    public function __construct()
    {
        $this->idClient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getIdClient(): Collection
    {
        return $this->idClient;
    }

    public function addIdClient(Client $idClient): static
    {
        if (!$this->idClient->contains($idClient)) {
            $this->idClient->add($idClient);
            $idClient->setAdresse($this);
        }

        return $this;
    }

    public function removeIdClient(Client $idClient): static
    {
        if ($this->idClient->removeElement($idClient)) {
            // set the owning side to null (unless already changed)
            if ($idClient->getAdresse() === $this) {
                $idClient->setAdresse(null);
            }
        }

        return $this;
    }
}
