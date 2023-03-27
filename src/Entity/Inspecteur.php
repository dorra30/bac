<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InspecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InspecteurRepository::class)]
#[ApiResource]
class Inspecteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\OneToMany(mappedBy: 'inspecteur', targetEntity: Enseigant::class)]
    private Collection $enseigants;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?center $center = null;

    public function __construct()
    {
        $this->enseigants = new ArrayCollection();
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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

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
            $enseigant->setInspecteur($this);
        }

        return $this;
    }

    public function removeEnseigant(Enseigant $enseigant): self
    {
        if ($this->enseigants->removeElement($enseigant)) {
            // set the owning side to null (unless already changed)
            if ($enseigant->getInspecteur() === $this) {
                $enseigant->setInspecteur(null);
            }
        }

        return $this;
    }

    public function getCenter(): ?center
    {
        return $this->center;
    }

    public function setCenter(?center $center): self
    {
        $this->center = $center;

        return $this;
    }
}
