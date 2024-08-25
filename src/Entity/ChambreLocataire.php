<?php 
namespace App\Entity;

use App\Repository\ChambreLocataireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ChambreLocataireRepository::class)]
#[Broadcast]
class ChambreLocataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Chambre::class, inversedBy: 'ChambreLocataire')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chambre $chambre = null;

    #[ORM\ManyToOne(targetEntity: Locataire::class, inversedBy: 'ChambreLocataire')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locataire $locataire = null;

    #[ORM\ManyToOne(targetEntity: AnneeAcademiques::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?AnneeAcademiques $anneeAcademique = null;

    #[ORM\Column(type: "integer")]
    private ?int $dureeOccupation = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updatedAt = null;

    // Getters and setters...
    public function getId(): ?int
{
    return $this->id;
}

public function getChambre(): ?Chambre
{
    return $this->chambre;
}

public function setChambre(?Chambre $chambre): self
{
    $this->chambre = $chambre;

    return $this;
}

public function getLocataire(): ?Locataire
{
    return $this->locataire;
}

public function setLocataire(?Locataire $locataire): self
{
    $this->locataire = $locataire;

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

public function getDureeOccupation(): ?int
{
    return $this->dureeOccupation;
}

public function setDureeOccupation(?int $dureeOccupation): self
{
    $this->dureeOccupation = $dureeOccupation;

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

}
