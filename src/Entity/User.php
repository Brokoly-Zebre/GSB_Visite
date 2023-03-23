<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VisiteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteursRepository::class)]
#[ApiResource]
class User implements \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\ManyToOne(inversedBy: 'User')]
    private ?Visite $visite = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Practiciens::class)]
    private Collection $practiciens;

    public function __construct()
    {
        $this->practiciens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getVisite(): ?Visite
    {
        return $this->visite;
    }

    public function setVisite(?Visite $visite): self
    {
        $this->visite = $visite;

        return $this;
    }

    /**
     * @return Collection<int, Practiciens>
     */
    public function getPracticiens(): Collection
    {
        return $this->practiciens;
    }

    public function addPracticien(Practiciens $practicien): self
    {
        if (!$this->practiciens->contains($practicien)) {
            $this->practiciens->add($practicien);
            $practicien->setUser($this);
        }

        return $this;
    }

    public function removePracticien(Practiciens $practicien): self
    {
        if ($this->practiciens->removeElement($practicien)) {
            // set the owning side to null (unless already changed)
            if ($practicien->getUser() === $this) {
                $practicien->setUser(null);
            }
        }

        return $this;
    }
}
