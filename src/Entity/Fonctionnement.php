<?php

namespace App\Entity;

use App\Repository\FonctionnementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FonctionnementRepository::class)]
class Fonctionnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'fonctionnements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeFonctionnement $type_fonctionnement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fonctionnement = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeFonctionnement(): ?TypeFonctionnement
    {
        return $this->type_fonctionnement;
    }

    public function setTypeFonctionnement(?TypeFonctionnement $type_fonctionnement): self
    {
        $this->type_fonctionnement = $type_fonctionnement;

        return $this;
    }

    public function getDateFonctionnement(): ?\DateTimeInterface
    {
        return $this->date_fonctionnement;
    }

    public function setDateFonctionnement(\DateTimeInterface $date_fonctionnement): self
    {
        $this->date_fonctionnement = $date_fonctionnement;

        return $this;
    }
}
