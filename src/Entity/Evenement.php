<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $montant_event = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAssistance $type_assistance = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Assistance::class)]
    private Collection $assistances;

    public function __construct()
    {
        $this->assistances = new ArrayCollection();
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

    public function getMontantEvent(): ?string
    {
        return $this->montant_event;
    }

    public function setMontantEvent(string $montant_event): self
    {
        $this->montant_event = $montant_event;

        return $this;
    }

    public function getTypeAssistance(): ?TypeAssistance
    {
        return $this->type_assistance;
    }

    public function setTypeAssistance(?TypeAssistance $type_assistance): self
    {
        $this->type_assistance = $type_assistance;

        return $this;
    }

    /**
     * @return Collection<int, Assistance>
     */
    public function getAssistances(): Collection
    {
        return $this->assistances;
    }

    public function addAssistance(Assistance $assistance): self
    {
        if (!$this->assistances->contains($assistance)) {
            $this->assistances->add($assistance);
            $assistance->setEvenement($this);
        }

        return $this;
    }

    public function removeAssistance(Assistance $assistance): self
    {
        if ($this->assistances->removeElement($assistance)) {
            // set the owning side to null (unless already changed)
            if ($assistance->getEvenement() === $this) {
                $assistance->setEvenement(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}
