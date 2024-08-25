<?php
namespace App\Entity;

use App\Repository\DepenseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use DateTimeImmutable;

#[ORM\Entity(repositoryClass: DepenseRepository::class)]
#[Broadcast]
class Depense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column]
    private ?DateTimeImmutable $date = null;

    #[ORM\ManyToOne(targetEntity: Chambre::class, inversedBy: 'depenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chambre $chambre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
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
}
