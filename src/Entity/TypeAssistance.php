<?php

namespace App\Entity;

use App\Repository\TypeAssistanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeAssistanceRepository::class)]
class TypeAssistance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: AutreEvenement::class)]
    private Collection $autreEvenements;

    public function __construct()
    {
        $this->autreEvenements = new ArrayCollection();
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

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return Collection<int, AutreEvenement>
     */
    public function getAutreEvenements(): Collection
    {
        return $this->autreEvenements;
    }

    public function addAutreEvenement(AutreEvenement $autreEvenement): self
    {
        if (!$this->autreEvenements->contains($autreEvenement)) {
            $this->autreEvenements->add($autreEvenement);
            $autreEvenement->setType($this);
        }

        return $this;
    }

    public function removeAutreEvenement(AutreEvenement $autreEvenement): self
    {
        if ($this->autreEvenements->removeElement($autreEvenement)) {
            // set the owning side to null (unless already changed)
            if ($autreEvenement->getType() === $this) {
                $autreEvenement->setType(null);
            }
        }

        return $this;
    }
}
