<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EpreuveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpreuveRepository::class)]
#[ApiResource]
class Epreuve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\ManyToOne(inversedBy: 'epreuves')]
    private ?centre $center = null;

    #[ORM\OneToMany(mappedBy: 'epreuve', targetEntity: Jury::class)]
    private Collection $juries;

    #[ORM\ManyToOne(inversedBy: 'epreuves')]
    private ?specialite $specialite = null;

    public function __construct()
    {
        $this->juries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCenter(): ?centre
    {
        return $this->center;
    }

    public function setCenter(?centre $center): self
    {
        $this->center = $center;

        return $this;
    }

    /**
     * @return Collection<int, Jury>
     */
    public function getJuries(): Collection
    {
        return $this->juries;
    }

    public function addJury(Jury $jury): self
    {
        if (!$this->juries->contains($jury)) {
            $this->juries->add($jury);
            $jury->setEpreuve($this);
        }

        return $this;
    }

    public function removeJury(Jury $jury): self
    {
        if ($this->juries->removeElement($jury)) {
            // set the owning side to null (unless already changed)
            if ($jury->getEpreuve() === $this) {
                $jury->setEpreuve(null);
            }
        }

        return $this;
    }

    public function getSpecialite(): ?specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(?specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }
}
