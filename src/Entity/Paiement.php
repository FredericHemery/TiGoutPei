<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datePaie = null;

    #[ORM\ManyToMany(targetEntity: Commande::class, inversedBy: 'paiements')]
    private Collection $numCom;

    public function __construct()
    {
        $this->numCom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePaie(): ?\DateTimeInterface
    {
        return $this->datePaie;
    }

    public function setDatePaie(?\DateTimeInterface $datePaie): static
    {
        $this->datePaie = $datePaie;

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
}
