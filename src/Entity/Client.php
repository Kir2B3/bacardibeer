<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Adresse $adresse = null;

    #[ORM\ManyToMany(targetEntity: Bar::class, inversedBy: 'clients')]
    private Collection $bars;

    #[ORM\ManyToMany(targetEntity: Biere::class, inversedBy: 'clients')]
    private Collection $bieres;

    public function __construct()
    {
        $this->bars = new ArrayCollection();
        $this->bieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Bar>
     */
    public function getBars(): Collection
    {
        return $this->bars;
    }

    public function addBar(Bar $bar): static
    {
        if (!$this->bars->contains($bar)) {
            $this->bars->add($bar);
        }

        return $this;
    }

    public function removeBar(Bar $bar): static
    {
        $this->bars->removeElement($bar);

        return $this;
    }

    /**
     * @return Collection<int, Biere>
     */
    public function getBieres(): Collection
    {
        return $this->bieres;
    }

    public function addBiere(Biere $biere): static
    {
        if (!$this->bieres->contains($biere)) {
            $this->bieres->add($biere);
        }

        return $this;
    }

    public function removeBiere(Biere $biere): static
    {
        $this->bieres->removeElement($biere);

        return $this;
    }
}
