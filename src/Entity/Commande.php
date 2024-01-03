<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $etatCommande = null;

    #[ORM\ManyToOne(inversedBy: 'numCommande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToOne(inversedBy: 'commande', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Facture $numFact = null;

    #[ORM\ManyToMany(targetEntity: Paiement::class, mappedBy: 'numCom')]
    private Collection $paiements;

    #[ORM\ManyToOne(inversedBy: 'numCom')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatusCli $statusCli = null;

    #[ORM\ManyToMany(targetEntity: Constitue::class, mappedBy: 'numCom')]
    private Collection $constitues;

    public function __construct()
    {
        $this->paiements = new ArrayCollection();
        $this->constitues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtatCommande(): ?int
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(int $etatCommande): static
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getNumFact(): ?Facture
    {
        return $this->numFact;
    }

    public function setNumFact(Facture $numFact): static
    {
        $this->numFact = $numFact;

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): static
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements->add($paiement);
            $paiement->addNumCom($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): static
    {
        if ($this->paiements->removeElement($paiement)) {
            $paiement->removeNumCom($this);
        }

        return $this;
    }

    public function getStatusCli(): ?StatusCli
    {
        return $this->statusCli;
    }

    public function setStatusCli(?StatusCli $statusCli): static
    {
        $this->statusCli = $statusCli;

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
            $constitue->addNumCom($this);
        }

        return $this;
    }

    public function removeConstitue(Constitue $constitue): static
    {
        if ($this->constitues->removeElement($constitue)) {
            $constitue->removeNumCom($this);
        }

        return $this;
    }
}
