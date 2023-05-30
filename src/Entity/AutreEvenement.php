<?php

namespace App\Entity;

use App\Repository\AutreEvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutreEvenementRepository::class)]
class AutreEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'autreEvenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAssistance $type = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: AutreDepense::class)]
    private Collection $autreDepenses;

    public function __construct()
    {
        $this->autreDepenses = new ArrayCollection();
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

    public function getType(): ?TypeAssistance
    {
        return $this->type;
    }

    public function setType(?TypeAssistance $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, AutreDepense>
     */
    public function getAutreDepenses(): Collection
    {
        return $this->autreDepenses;
    }

    public function addAutreDepense(AutreDepense $autreDepense): self
    {
        if (!$this->autreDepenses->contains($autreDepense)) {
            $this->autreDepenses->add($autreDepense);
            $autreDepense->setEvenement($this);
        }

        return $this;
    }

    public function removeAutreDepense(AutreDepense $autreDepense): self
    {
        if ($this->autreDepenses->removeElement($autreDepense)) {
            // set the owning side to null (unless already changed)
            if ($autreDepense->getEvenement() === $this) {
                $autreDepense->setEvenement(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->libelle;
    }
}
