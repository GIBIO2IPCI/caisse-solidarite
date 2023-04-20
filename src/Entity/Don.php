<?php

namespace App\Entity;

use App\Repository\DonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonRepository::class)]
class Don
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $montant_don = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_don = null;

    #[ORM\ManyToOne(inversedBy: 'dons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeDon $type_don = null;

    #[ORM\ManyToOne(inversedBy: 'dons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adherent $donnateur = null;

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

    public function getMontantDon(): ?string
    {
        return $this->montant_don;
    }

    public function setMontantDon(string $montant_don): self
    {
        $this->montant_don = $montant_don;

        return $this;
    }

    public function getDateDon(): ?\DateTimeImmutable
    {
        return $this->date_don;
    }

    public function setDateDon(\DateTimeImmutable $date_don): self
    {
        $this->date_don = $date_don;

        return $this;
    }

    public function getTypeDon(): ?TypeDon
    {
        return $this->type_don;
    }

    public function setTypeDon(?TypeDon $type_don): self
    {
        $this->type_don = $type_don;

        return $this;
    }

    public function getDonnateur(): ?Adherent
    {
        return $this->donnateur;
    }

    public function setDonnateur(?Adherent $donnateur): self
    {
        $this->donnateur = $donnateur;

        return $this;
    }
}
