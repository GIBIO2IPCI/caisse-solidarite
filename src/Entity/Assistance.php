<?php

namespace App\Entity;

use App\Repository\AssistanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AssistanceRepository::class)]
class Assistance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $date_assistance = null;

    #[ORM\ManyToOne(inversedBy: 'assistance')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $adherent = null;

    #[ORM\ManyToOne(inversedBy: 'assistances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evenement $evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAssistance(): ?\DateTimeImmutable
    {
        return $this->date_assistance;
    }

    public function setDateAssistance(\DateTimeImmutable $date_assistance): self
    {
        $this->date_assistance = $date_assistance;

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

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function __toString()
    {
        return $this->evenement;
    }
}
