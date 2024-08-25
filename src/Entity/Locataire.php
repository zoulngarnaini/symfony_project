<?php
namespace App\Entity;
use App\Entity\Chambre;
use App\Repository\LocataireRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: LocataireRepository::class)]
class Locataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private ?int $user_id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $prenom = null;
    #[ORM\Column(type: "string", length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: "string", length: 10)]
    private ?string $genre = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: "string", length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $niveau = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $filiere = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $updated_at = null;
    //
    #[ORM\OneToMany(mappedBy: 'locataire', targetEntity: ChambreLocataire::class)]
    private Collection $chambreLocataires;



    // Mes Getters et setters
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

public function getPrenom(): ?string
{
    return $this->prenom;
}
public function setEmail(string $email): self
{
    $this->email = $email;
    return $this;
}

public function getEmail(): ?string
{
    return $this->email;
}

public function setPrenom(string $prenom): self
{
    $this->prenom = $prenom;
    return $this;
}

public function getGenre(): ?string
{
    return $this->genre;
}

public function setGenre(string $genre): self
{
    $this->genre = $genre;
    return $this;
}

public function getAdresse(): ?string
{
    return $this->adresse;
}

public function setAdresse(string $adresse): self
{
    $this->adresse = $adresse;
    return $this;
}

public function getTelephone(): ?string
{
    return $this->telephone;
}

public function setTelephone(string $telephone): self
{
    $this->telephone = $telephone;
    return $this;
}

public function getDateNaissance(): ?\DateTimeInterface
{
    return $this->date_naissance;
}

public function setDateNaissance(\DateTimeInterface $date_naissance): self
{
    $this->date_naissance = $date_naissance;
    return $this;
}

public function getLieuNaissance(): ?string
{
    return $this->lieu_naissance;
}

public function setLieuNaissance(string $lieu_naissance): self
{
    $this->lieu_naissance = $lieu_naissance;
    return $this;
}

public function getNiveau(): ?string
{
    return $this->niveau;
}

public function setNiveau(string $niveau): self
{
    $this->niveau = $niveau;
    return $this;
}

public function getFiliere(): ?string
{
    return $this->filiere;
}

public function setFiliere(string $filiere): self
{
    $this->filiere = $filiere;
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
        $chambreLocataire->setLocataire($this);
    }

    return $this;
}

public function removeChambreLocataire(ChambreLocataire $chambreLocataire): self
{
    if ($this->chambreLocataires->removeElement($chambreLocataire)) {
        // set the owning side to null (unless already changed)
        if ($chambreLocataire->getLocataire() === $this) {
            $chambreLocataire->setLocataire(null);
        }
    }

    return $this;
}

}
