<?php

namespace App\Entity;

use App\Repository\AutreDepenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutreDepenseRepository::class)]
class AutreDepense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'autreDepenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $adherent = null;

    #[ORM\ManyToOne(inversedBy: 'autreDepenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AutreEvenement $evenement = null;

    #[ORM\Column]
    private ?int $montant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getEvenement(): ?AutreEvenement
    {
        return $this->evenement;
    }

    public function setEvenement(?AutreEvenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
