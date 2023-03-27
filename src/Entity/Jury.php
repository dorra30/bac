<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JuryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuryRepository::class)]
#[ApiResource]
class Jury
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'juries')]
    private ?epreuve $epreuve = null;

    #[ORM\OneToMany(mappedBy: 'jury', targetEntity: dateep::class)]
    private Collection $date;

    public function __construct()
    {
        $this->date = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEpreuve(): ?epreuve
    {
        return $this->epreuve;
    }

    public function setEpreuve(?epreuve $epreuve): self
    {
        $this->epreuve = $epreuve;

        return $this;
    }

    /**
     * @return Collection<int, dateep>
     */
    public function getDate(): Collection
    {
        return $this->date;
    }

    public function addDate(dateep $date): self
    {
        if (!$this->date->contains($date)) {
            $this->date->add($date);
            $date->setJury($this);
        }

        return $this;
    }

    public function removeDate(dateep $date): self
    {
        if ($this->date->removeElement($date)) {
            // set the owning side to null (unless already changed)
            if ($date->getJury() === $this) {
                $date->setJury(null);
            }
        }

        return $this;
    }
}
