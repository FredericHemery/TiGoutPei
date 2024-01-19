<?php
//
//namespace App\Entity;
//
//use App\Repository\ClientRepository;
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
//use Symfony\Component\Security\Core\User\UserInterface;
//
//#[ORM\Entity(repositoryClass: ClientRepository::class)]
//class Client implements UserInterface, PasswordAuthenticatedUserInterface
//{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    #[ORM\Column(length: 180, unique: true)]
//    private ?string $email = null;
//
//    #[ORM\Column]
//    private array $roles = [];
//
//    /**
//     * @var string The hashed password
//     */
//    #[ORM\Column]
//    private ?string $password = null;
//
//    #[ORM\Column(length: 50)]
//    private ?string $nom = null;
//
//    #[ORM\Column(length: 50)]
//    private ?string $prenom = null;
//
//    #[ORM\Column(length: 20)]
//    private ?string $numTel = null;
//
//    #[ORM\Column(length: 10)]
//    private ?string $role = null;
//
//    #[ORM\ManyToOne(inversedBy: 'idClient')]
//    #[ORM\JoinColumn(nullable: false)]
//    private ?Adresse $adresse = null;
//
//    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commentaires::class)]
//    private Collection $idCom;
//
//    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class, orphanRemoval: true)]
//    private Collection $numCommande;
//
//    public function __construct()
//    {
//        $this->idCom = new ArrayCollection();
//        $this->numCommande = new ArrayCollection();
//    }
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    public function getEmail(): ?string
//    {
//        return $this->email;
//    }
//
//    public function setEmail(string $email): static
//    {
//        $this->email = $email;
//
//        return $this;
//    }
//
//    /**
//     * A visual identifier that represents this user.
//     *
//     * @see UserInterface
//     */
//    public function getUserIdentifier(): string
//    {
//        return (string) $this->email;
//    }
//
//    /**
//     * @see UserInterface
//     */
//    public function getRoles(): array
//    {
//        $roles = $this->roles;
//        // guarantee every user at least has ROLE_USER
//        $roles[] = 'ROLE_USER';
//
//        return array_unique($roles);
//    }
//
//    public function setRoles(array $roles): static
//    {
//        $this->roles = $roles;
//
//        return $this;
//    }
//
//    /**
//     * @see PasswordAuthenticatedUserInterface
//     */
//    public function getPassword(): string
//    {
//        return $this->password;
//    }
//
//    public function setPassword(string $password): static
//    {
//        $this->password = $password;
//
//        return $this;
//    }
//
//    /**
//     * @see UserInterface
//     */
//    public function eraseCredentials(): void
//    {
//        // If you store any temporary, sensitive data on the user, clear it here
//        // $this->plainPassword = null;
//    }
//
//    public function getNom(): ?string
//    {
//        return $this->nom;
//    }
//
//    public function setNom(string $nom): static
//    {
//        $this->nom = $nom;
//
//        return $this;
//    }
//
//    public function getPrenom(): ?string
//    {
//        return $this->prenom;
//    }
//
//    public function setPrenom(string $prenom): static
//    {
//        $this->prenom = $prenom;
//
//        return $this;
//    }
//
//    public function getNumTel(): ?string
//    {
//        return $this->numTel;
//    }
//
//    public function setNumTel(string $numTel): static
//    {
//        $this->numTel = $numTel;
//
//        return $this;
//    }
//
//    public function getRole(): ?string
//    {
//        return $this->role;
//    }
//
//    public function setRole(string $role): static
//    {
//        $this->role = $role;
//
//        return $this;
//    }
//
//    public function getAdresse(): ?Adresse
//    {
//        return $this->adresse;
//    }
//
//    public function setAdresse(?Adresse $adresse): static
//    {
//        $this->adresse = $adresse;
//
//        return $this;
//    }
//
//    /**
//     * @return Collection<int, Commentaires>
//     */
//    public function getIdCom(): Collection
//    {
//        return $this->idCom;
//    }
//
//    public function addIdCom(Commentaires $idCom): static
//    {
//        if (!$this->idCom->contains($idCom)) {
//            $this->idCom->add($idCom);
//            $idCom->setClient($this);
//        }
//
//        return $this;
//    }
//
//    public function removeIdCom(Commentaires $idCom): static
//    {
//        if ($this->idCom->removeElement($idCom)) {
//            // set the owning side to null (unless already changed)
//            if ($idCom->getClient() === $this) {
//                $idCom->setClient(null);
//            }
//        }
//
//        return $this;
//    }
//
//    /**
//     * @return Collection<int, Commande>
//     */
//    public function getNumCommande(): Collection
//    {
//        return $this->numCommande;
//    }
//
//    public function addNumCommande(Commande $numCommande): static
//    {
//        if (!$this->numCommande->contains($numCommande)) {
//            $this->numCommande->add($numCommande);
//            $numCommande->setClient($this);
//        }
//
//        return $this;
//    }
//
//    public function removeNumCommande(Commande $numCommande): static
//    {
//        if ($this->numCommande->removeElement($numCommande)) {
//            // set the owning side to null (unless already changed)
//            if ($numCommande->getClient() === $this) {
//                $numCommande->setClient(null);
//            }
//        }
//
//        return $this;
//    }
//}
namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
//class Client implements UserInterface, PasswordAuthenticatedUserInterface
class Client extends  Utilisateur
{
    #[ORM\Column(length: 20)]
    private ?string $numTel = null;

    #[ORM\ManyToOne(inversedBy: 'idClient')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commentaires::class)]
    private Collection $idCom;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class, orphanRemoval: true)]
    private Collection $numCommande;

    public function __construct()
    {
        $this->idCom = new ArrayCollection();
        $this->numCommande = new ArrayCollection();
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getIdCom(): Collection
    {
        return $this->idCom;
    }

    public function addIdCom(Commentaires $idCom): static
    {
        if (!$this->idCom->contains($idCom)) {
            $this->idCom->add($idCom);
            $idCom->setClient($this);
        }

        return $this;
    }

    public function removeIdCom(Commentaires $idCom): static
    {
        if ($this->idCom->removeElement($idCom)) {
            // set the owning side to null (unless already changed)
            if ($idCom->getClient() === $this) {
                $idCom->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getNumCommande(): Collection
    {
        return $this->numCommande;
    }

    public function addNumCommande(Commande $numCommande): static
    {
        if (!$this->numCommande->contains($numCommande)) {
            $this->numCommande->add($numCommande);
            $numCommande->setClient($this);
        }

        return $this;
    }

    public function removeNumCommande(Commande $numCommande): static
    {
        if ($this->numCommande->removeElement($numCommande)) {
            // set the owning side to null (unless already changed)
            if ($numCommande->getClient() === $this) {
                $numCommande->setClient(null);
            }
        }

        return $this;
    }
}