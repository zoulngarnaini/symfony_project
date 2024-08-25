<?php

namespace App\Entity;

use App\Repository\AnneeAcademiquesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeAcademiquesRepository::class)]
class AnneeAcademiques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_rentree = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $evenements = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updated_at = null;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateRentree(): ?\DateTimeInterface
    {
        return $this->date_rentree;
    }

    public function setDateRentree(\DateTimeInterface $date_rentree): self
    {
        $this->date_rentree = $date_rentree;

        return $this;
    }

    public function getEvenements(): ?string
    {
        return $this->evenements;
    }

    public function setEvenements(?string $evenements): self
    {
        $this->evenements = $evenements;

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
}
