<?php

namespace App\Entity;

use App\Repository\AdherentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AdherentRepository::class)]
class Adherent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields: ['nom', 'telephone'], style: 'upper', separator: "")]
    private ?string $identifiant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    private ?StatutAdherent $statut = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SiteAdherent $site = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fonction $fonction = null;

    #[ORM\OneToMany(mappedBy: 'adherent', targetEntity: Cotisation::class, cascade: ['remove'])]
    private Collection $cotisations;

    #[ORM\OneToMany(mappedBy: 'adherent', targetEntity: DroitAdhesion::class, cascade: ['remove'])]
    private Collection $droit_adhesion;

    #[ORM\OneToMany(mappedBy: 'donnateur', targetEntity: Don::class, cascade: ['remove'])]
    private Collection $dons;

    #[ORM\OneToMany(mappedBy: 'adherent', targetEntity: Assistance::class, cascade: ['remove'])]
    private Collection $assistance;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\ManyToOne(inversedBy: 'adherents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sexe $sexe = null;

    #[ORM\OneToMany(mappedBy: 'adherent', targetEntity: AutreDepense::class, cascade: ['remove'])]
    private Collection $autreDepenses;

    public function __construct()
    {
        $this->cotisations = new ArrayCollection();
        $this->droit_adhesion = new ArrayCollection();
        $this->dons = new ArrayCollection();
        $this->assistance = new ArrayCollection();
        $this->autreDepenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getStatut(): ?StatutAdherent
    {
        return $this->statut;
    }

    public function setStatut(?StatutAdherent $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSite(): ?SiteAdherent
    {
        return $this->site;
    }

    public function setSite(?SiteAdherent $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * @return Collection<int, Cotisation>
     */
    public function getCotisations(): Collection
    {
        return $this->cotisations;
    }

    public function addCotisation(Cotisation $cotisation): self
    {
        if (!$this->cotisations->contains($cotisation)) {
            $this->cotisations->add($cotisation);
            $cotisation->setAdherent($this);
        }

        return $this;
    }

    public function removeCotisation(Cotisation $cotisation): self
    {
        if ($this->cotisations->removeElement($cotisation)) {
            // set the owning side to null (unless already changed)
            if ($cotisation->getAdherent() === $this) {
                $cotisation->setAdherent(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->identifiant;
    }

    /**
     * @return Collection<int, DroitAdhesion>
     */
    public function getDroitAdhesion(): Collection
    {
        return $this->droit_adhesion;
    }

    public function addDroitAdhesion(DroitAdhesion $droitAdhesion): self
    {
        if (!$this->droit_adhesion->contains($droitAdhesion)) {
            $this->droit_adhesion->add($droitAdhesion);
            $droitAdhesion->setAdherent($this);
        }

        return $this;
    }

    public function removeDroitAdhesion(DroitAdhesion $droitAdhesion): self
    {
        if ($this->droit_adhesion->removeElement($droitAdhesion)) {
            // set the owning side to null (unless already changed)
            if ($droitAdhesion->getAdherent() === $this) {
                $droitAdhesion->setAdherent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Don>
     */
    public function getDons(): Collection
    {
        return $this->dons;
    }

    public function addDon(Don $don): self
    {
        if (!$this->dons->contains($don)) {
            $this->dons->add($don);
            $don->setDonnateur($this);
        }

        return $this;
    }

    public function removeDon(Don $don): self
    {
        if ($this->dons->removeElement($don)) {
            // set the owning side to null (unless already changed)
            if ($don->getDonnateur() === $this) {
                $don->setDonnateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Assistance>
     */
    public function getAssistance(): Collection
    {
        return $this->assistance;
    }

    public function addAssistance(Assistance $assistance): self
    {
        if (!$this->assistance->contains($assistance)) {
            $this->assistance->add($assistance);
            $assistance->setAdherent($this);
        }

        return $this;
    }

    public function removeAssistance(Assistance $assistance): self
    {
        if ($this->assistance->removeElement($assistance)) {
            // set the owning side to null (unless already changed)
            if ($assistance->getAdherent() === $this) {
                $assistance->setAdherent(null);
            }
        }

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSexe(): ?Sexe
    {
        return $this->sexe;
    }

    public function setSexe(?Sexe $sexe): self
    {
        $this->sexe = $sexe;

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
            $autreDepense->setAdherent($this);
        }

        return $this;
    }

    public function removeAutreDepense(AutreDepense $autreDepense): self
    {
        if ($this->autreDepenses->removeElement($autreDepense)) {
            // set the owning side to null (unless already changed)
            if ($autreDepense->getAdherent() === $this) {
                $autreDepense->setAdherent(null);
            }
        }

        return $this;
    }
   
}
