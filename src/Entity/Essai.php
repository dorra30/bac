<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EssaiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EssaiRepository::class)]
#[ApiResource]
class Essai
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num_essai = null;

    #[ORM\Column]
    private ?float $performance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEssai(): ?int
    {
        return $this->num_essai;
    }

    public function setNumEssai(int $num_essai): self
    {
        $this->num_essai = $num_essai;

        return $this;
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
}
