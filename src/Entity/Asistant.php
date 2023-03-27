<?php

namespace App\Entity;

use App\Repository\AsistantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsistantRepository::class)]
class Asistant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $responsable1 = null;

    #[ORM\Column(length: 255)]
    private ?string $responsable2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable1(): ?string
    {
        return $this->responsable1;
    }

    public function setResponsable1(string $responsable1): self
    {
        $this->responsable1 = $responsable1;

        return $this;
    }

    public function getResponsable2(): ?string
    {
        return $this->responsable2;
    }

    public function setResponsable2(string $responsable2): self
    {
        $this->responsable2 = $responsable2;

        return $this;
    }
}
