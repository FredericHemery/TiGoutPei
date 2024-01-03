<?php

namespace App\Entity;

use App\Repository\StatusCliRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusCliRepository::class)]
class StatusCli
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelleStatus = null;

    #[ORM\OneToMany(mappedBy: 'statusCli', targetEntity: Commande::class, orphanRemoval: true)]
    private Collection $numCom;

    public function __construct()
    {
        $this->numCom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleStatus(): ?string
    {
        return $this->libelleStatus;
    }

    public function setLibelleStatus(string $libelleStatus): static
    {
        $this->libelleStatus = $libelleStatus;

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
            $numCom->setStatusCli($this);
        }

        return $this;
    }

    public function removeNumCom(Commande $numCom): static
    {
        if ($this->numCom->removeElement($numCom)) {
            // set the owning side to null (unless already changed)
            if ($numCom->getStatusCli() === $this) {
                $numCom->setStatusCli(null);
            }
        }

        return $this;
    }
}
