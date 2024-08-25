<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
#[Broadcast]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: ChambreLocataire::class, inversedBy: 'paiements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ChambreLocataire $chambreLocataire = null;

    #[ORM\Column(type: "float")]
    private ?float $montant = null;

    #[ORM\ManyToOne(targetEntity: Tranche::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tranche $tranche = null;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateEncaissement = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $dateDePaiementBanque = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: AnneeAcademiques::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeAcademiques $anneeAcademique = null;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChambreLocataire(): ?ChambreLocataire
    {
        return $this->chambreLocataire;
    }

    public function setChambreLocataire(?ChambreLocataire $chambreLocataire): self
    {
        $this->chambreLocataire = $chambreLocataire;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTranche(): ?Tranche
    {
        return $this->tranche;
    }

    public function setTranche(?Tranche $tranche): self
    {
        $this->tranche = $tranche;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateEncaissement(): ?\DateTimeInterface
    {
        return $this->dateEncaissement;
    }

    public function setDateEncaissement(\DateTimeInterface $dateEncaissement): self
    {
        $this->dateEncaissement = $dateEncaissement;

        return $this;
    }

    public function getDateDePaiementBanque(): ?\DateTimeInterface
    {
        return $this->dateDePaiementBanque;
    }

    public function setDateDePaiementBanque(\DateTimeInterface $dateDePaiementBanque): self
    {
        $this->dateDePaiementBanque = $dateDePaiementBanque;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAnneeAcademique(): ?AnneeAcademiques
    {
        return $this->anneeAcademique;
    }

    public function setAnneeAcademique(?AnneeAcademiques $anneeAcademique): self
    {
        $this->anneeAcademique = $anneeAcademique;

        return $this;
    }
}
