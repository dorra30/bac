<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialiteRepository::class)]
#[ApiResource]
class Specialite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $nbre_essai = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'specialite', targetEntity: Epreuve::class)]
    private Collection $epreuves;

    #[ORM\OneToMany(mappedBy: 'specialite', targetEntity: BaremeFille::class)]
    private Collection $baremeFilles;

    #[ORM\OneToMany(mappedBy: 'specialite', targetEntity: BaremeGarcon::class)]
    private Collection $baremeGarcons;

    #[ORM\Column(length: 255)]
    private ?string $choix1 = null;

    #[ORM\Column(length: 255)]
    private ?string $choix2 = null;

    #[ORM\Column(length: 255)]
    private ?string $choix3 = null;

    public function __construct()
    {
        $this->epreuves = new ArrayCollection();
        $this->baremeFilles = new ArrayCollection();
        $this->baremeGarcons = new ArrayCollection();
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

    public function getNbreEssai(): ?int
    {
        return $this->nbre_essai;
    }

    public function setNbreEssai(int $nbre_essai): self
    {
        $this->nbre_essai = $nbre_essai;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Epreuve>
     */
    public function getEpreuves(): Collection
    {
        return $this->epreuves;
    }

    public function addEpreufe(Epreuve $epreufe): self
    {
        if (!$this->epreuves->contains($epreufe)) {
            $this->epreuves->add($epreufe);
            $epreufe->setSpecialite($this);
        }

        return $this;
    }

    public function removeEpreufe(Epreuve $epreufe): self
    {
        if ($this->epreuves->removeElement($epreufe)) {
            // set the owning side to null (unless already changed)
            if ($epreufe->getSpecialite() === $this) {
                $epreufe->setSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BaremeFille>
     */
    public function getBaremeFilles(): Collection
    {
        return $this->baremeFilles;
    }

    public function addBaremeFille(BaremeFille $baremeFille): self
    {
        if (!$this->baremeFilles->contains($baremeFille)) {
            $this->baremeFilles->add($baremeFille);
            $baremeFille->setSpecialite($this);
        }

        return $this;
    }

    public function removeBaremeFille(BaremeFille $baremeFille): self
    {
        if ($this->baremeFilles->removeElement($baremeFille)) {
            // set the owning side to null (unless already changed)
            if ($baremeFille->getSpecialite() === $this) {
                $baremeFille->setSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BaremeGarcon>
     */
    public function getBaremeGarcons(): Collection
    {
        return $this->baremeGarcons;
    }

    public function addBaremeGarcon(BaremeGarcon $baremeGarcon): self
    {
        if (!$this->baremeGarcons->contains($baremeGarcon)) {
            $this->baremeGarcons->add($baremeGarcon);
            $baremeGarcon->setSpecialite($this);
        }

        return $this;
    }

    public function removeBaremeGarcon(BaremeGarcon $baremeGarcon): self
    {
        if ($this->baremeGarcons->removeElement($baremeGarcon)) {
            // set the owning side to null (unless already changed)
            if ($baremeGarcon->getSpecialite() === $this) {
                $baremeGarcon->setSpecialite(null);
            }
        }

        return $this;
    }

    public function getChoix1(): ?string
    {
        return $this->choix1;
    }

    public function setChoix1(string $choix1): self
    {
        $this->choix1 = $choix1;

        return $this;
    }

    public function getChoix2(): ?string
    {
        return $this->choix2;
    }

    public function setChoix2(string $choix2): self
    {
        $this->choix2 = $choix2;

        return $this;
    }

    public function getChoix3(): ?string
    {
        return $this->choix3;
    }

    public function setChoix3(string $choix3): self
    {
        $this->choix3 = $choix3;

        return $this;
    }
}
