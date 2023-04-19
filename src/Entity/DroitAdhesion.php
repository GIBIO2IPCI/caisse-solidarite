<?php

namespace App\Entity;

use App\Repository\DroitAdhesionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DroitAdhesionRepository::class)]
class DroitAdhesion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $montant = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_adhesion = null;

    #[ORM\ManyToOne(inversedBy: 'droit_adhesion')]
    private ?Adherent $adherent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateAdhesion(): ?\DateTimeImmutable
    {
        return $this->date_adhesion;
    }

    public function setDateAdhesion(\DateTimeImmutable $date_adhesion): self
    {
        $this->date_adhesion = $date_adhesion;

        return $this;
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
}
