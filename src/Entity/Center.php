<?php

namespace App\Entity;

use App\Repository\CenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CenterRepository::class)]
class Center
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?inspecteur $inspecteur = null;

    #[ORM\OneToMany(mappedBy: 'responsable1', targetEntity: Assistant::class)]
    private Collection $assistants;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    public function __construct()
    {
        $this->assistants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInspecteur(): ?inspecteur
    {
        return $this->inspecteur;
    }

    public function setInspecteur(?inspecteur $inspecteur): self
    {
        $this->inspecteur = $inspecteur;

        return $this;
    }

    /**
     * @return Collection<int, Assistant>
     */
    public function getAssistants(): Collection
    {
        return $this->assistants;
    }

    public function addAssistant(Assistant $assistant): self
    {
        if (!$this->assistants->contains($assistant)) {
            $this->assistants->add($assistant);
            $assistant->setResponsable1($this);
        }

        return $this;
    }

    public function removeAssistant(Assistant $assistant): self
    {
        if ($this->assistants->removeElement($assistant)) {
            // set the owning side to null (unless already changed)
            if ($assistant->getResponsable1() === $this) {
                $assistant->setResponsable1(null);
            }
        }

        return $this;
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
}
