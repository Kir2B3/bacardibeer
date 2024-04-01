<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Biere::class, mappedBy: 'marque')]
    private Collection $bieres;

    public function __construct()
    {
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
            $biere->setMarque($this);
        }

        return $this;
    }

    public function removeBiere(Biere $biere): static
    {
        if ($this->bieres->removeElement($biere)) {
            // set the owning side to null (unless already changed)
            if ($biere->getMarque() === $this) {
                $biere->setMarque(null);
            }
        }

        return $this;
    }
}
