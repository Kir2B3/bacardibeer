<?php

namespace App\Entity;

use App\Repository\TarifRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifRepository::class)]
class Tarif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'tarifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Biere $biere = null;

    #[ORM\ManyToOne(inversedBy: 'tarifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bar $bar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getBiere(): ?Biere
    {
        return $this->biere;
    }

    public function setBiere(?Biere $biere): static
    {
        $this->biere = $biere;

        return $this;
    }

    public function getBar(): ?Bar
    {
        return $this->bar;
    }

    public function setBar(?Bar $bar): static
    {
        $this->bar = $bar;

        return $this;
    }
}
