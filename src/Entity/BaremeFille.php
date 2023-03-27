<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BaremeFilleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaremeFilleRepository::class)]
#[ApiResource]
class BaremeFille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $performance = null;

    #[ORM\Column]
    private ?float $valeur = null;

    #[ORM\ManyToOne(inversedBy: 'baremeFilles')]
    private ?specialite $specialite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerformance(): ?float
    {
        return $this->performance;
    }

    public function setPerformance(float $performance): self
    {
        $this->performance = $performance;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

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
