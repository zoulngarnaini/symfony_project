<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $Etat = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $Statut = null;

    #[ORM\ManyToOne(targetEntity: Batiment::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Batiment $batiment = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $Localisation = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $Position = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updated_at = null;

 

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }
    #[ORM\OneToMany(mappedBy: 'chambre', targetEntity: ChambreLocataire::class)]
    private Collection $chambreLocataires;

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getBatiment(): ?Batiment
    {
        return $this->batiment;
    }

    public function setBatiment(?Batiment $batiment): self
    {
        $this->batiment = $batiment;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->Localisation;
    }

    public function setLocalisation(string $Localisation): self
    {
        $this->Localisation = $Localisation;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->Position;
    }

    public function setPosition(string $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

 

    public function __construct()
    {
        $this->chambreLocataires = new ArrayCollection();
    }

    /**
     * @return Collection<int, ChambreLocataire>
     */
    public function getChambreLocataires(): Collection
    {
        return $this->chambreLocataires;
    }

    public function addChambreLocataire(ChambreLocataire $chambreLocataire): self
    {
        if (!$this->chambreLocataires->contains($chambreLocataire)) {
            $this->chambreLocataires[] = $chambreLocataire;
            $chambreLocataire->setChambre($this);
        }

        return $this;
    }

    public function removeChambreLocataire(ChambreLocataire $chambreLocataire): self
    {
        if ($this->chambreLocataires->removeElement($chambreLocataire)) {
            
            if ($chambreLocataire->getChambre() === $this) {
                $chambreLocataire->setChambre(null);
            }
        }

        return $this;
    }
}


