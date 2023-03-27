<?php

namespace App\Entity;

use App\Repository\DateEpRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: DateEpRepository::class)]
#[ApiResource]
class DateEp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $lycee = null;

    #[ORM\Column]
    private ?int $center = null;

    #[ORM\Column(length: 255)]
    private ?string $enseigant1 = null;

    #[ORM\Column(length: 255)]
    private ?string $enseigant2 = null;

    #[ORM\Column(length: 255)]
    private ?string $enseigant3 = null;

    #[ORM\ManyToOne(inversedBy: 'date')]
    private ?Jury $jury = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLycee(): ?int
    {
        return $this->lycee;
    }

    public function setLycee(int $lycee): self
    {
        $this->lycee = $lycee;

        return $this;
    }

    public function getCenter(): ?int
    {
        return $this->center;
    }

    public function setCenter(int $center): self
    {
        $this->center = $center;

        return $this;
    }

    public function getEnseigant1(): ?string
    {
        return $this->enseigant1;
    }

    public function setEnseigant1(string $enseigant1): self
    {
        $this->enseigant1 = $enseigant1;

        return $this;
    }

    public function getEnseigant2(): ?string
    {
        return $this->enseigant2;
    }

    public function setEnseigant2(string $enseigant2): self
    {
        $this->enseigant2 = $enseigant2;

        return $this;
    }

    public function getEnseigant3(): ?string
    {
        return $this->enseigant3;
    }

    public function setEnseigant3(string $enseigant3): self
    {
        $this->enseigant3 = $enseigant3;

        return $this;
    }

    public function getJury(): ?Jury
    {
        return $this->jury;
    }

    public function setJury(?Jury $jury): self
    {
        $this->jury = $jury;

        return $this;
    }
}
