<?php

namespace App\Entity;

use App\Repository\CotisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CotisationRepository::class)]
class Cotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $montant_cotisation = 1000;


    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $adherent = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cotisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantCotisation(): ?string
    {
        return $this->montant_cotisation;
    }

    public function setMontantCotisation(string $montant_cotisation): self
    {
        $this->montant_cotisation = $montant_cotisation;

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

    public function getDateCotisation(): ?\DateTimeInterface
    {
        return $this->date_cotisation;
    }

    public function setDateCotisation(\DateTimeInterface $date_cotisation): self
    {
        $this->date_cotisation = $date_cotisation;

        return $this;
    }
}
