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

    #[ORM\ManyToOne(inversedBy: 'cotisations')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updated_at = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
