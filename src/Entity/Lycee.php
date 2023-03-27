<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LyceeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LyceeRepository::class)]
#[ApiResource]
class Lycee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'lycee', targetEntity: Enseigant::class)]
    private Collection $enseigants;

    #[ORM\OneToMany(mappedBy: 'lycee', targetEntity: Classe::class)]
    private Collection $classes;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?directeur $diecteur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?coordinateur $coordinateur = null;

    public function __construct()
    {
        $this->enseigants = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Enseigant>
     */
    public function getEnseigants(): Collection
    {
        return $this->enseigants;
    }

    public function addEnseigant(Enseigant $enseigant): self
    {
        if (!$this->enseigants->contains($enseigant)) {
            $this->enseigants->add($enseigant);
            $enseigant->setLycee($this);
        }

        return $this;
    }

    public function removeEnseigant(Enseigant $enseigant): self
    {
        if ($this->enseigants->removeElement($enseigant)) {
            // set the owning side to null (unless already changed)
            if ($enseigant->getLycee() === $this) {
                $enseigant->setLycee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setLycee($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getLycee() === $this) {
                $class->setLycee(null);
            }
        }

        return $this;
    }

    public function getDiecteur(): ?directeur
    {
        return $this->diecteur;
    }

    public function setDiecteur(?directeur $diecteur): self
    {
        $this->diecteur = $diecteur;

        return $this;
    }

    public function getCoordinateur(): ?coordinateur
    {
        return $this->coordinateur;
    }

    public function setCoordinateur(?coordinateur $coordinateur): self
    {
        $this->coordinateur = $coordinateur;

        return $this;
    }
}
