<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
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
}
