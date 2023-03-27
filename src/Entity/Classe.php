<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
#[ApiResource]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $order_genre_gym = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?lycee $lycee = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Eleve::class)]
    private Collection $eleves;

    #[ORM\ManyToMany(targetEntity: Section::class, mappedBy: 'classe')]
    private Collection $sections;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->sections = new ArrayCollection();
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

    public function getOrderGenreGym(): ?string
    {
        return $this->order_genre_gym;
    }

    public function setOrderGenreGym(string $order_genre_gym): self
    {
        $this->order_genre_gym = $order_genre_gym;

        return $this;
    }

    public function getLycee(): ?lycee
    {
        return $this->lycee;
    }

    public function setLycee(?lycee $lycee): self
    {
        $this->lycee = $lycee;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setClasse($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getClasse() === $this) {
                $elefe->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->addClasse($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->removeElement($section)) {
            $section->removeClasse($this);
        }

        return $this;
    }
}
