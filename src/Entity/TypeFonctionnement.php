<?php

namespace App\Entity;

use App\Repository\TypeFonctionnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeFonctionnementRepository::class)]
class TypeFonctionnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'type_fonctionnement', targetEntity: Fonctionnement::class)]
    private Collection $fonctionnements;

    public function __construct()
    {
        $this->fonctionnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Fonctionnement>
     */
    public function getFonctionnements(): Collection
    {
        return $this->fonctionnements;
    }

    public function addFonctionnement(Fonctionnement $fonctionnement): self
    {
        if (!$this->fonctionnements->contains($fonctionnement)) {
            $this->fonctionnements->add($fonctionnement);
            $fonctionnement->setTypeFonctionnement($this);
        }

        return $this;
    }

    public function removeFonctionnement(Fonctionnement $fonctionnement): self
    {
        if ($this->fonctionnements->removeElement($fonctionnement)) {
            // set the owning side to null (unless already changed)
            if ($fonctionnement->getTypeFonctionnement() === $this) {
                $fonctionnement->setTypeFonctionnement(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;

    }
}
