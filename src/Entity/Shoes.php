<?php

namespace App\Entity;

use App\Repository\ShoesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ShoesRepository::class)]
#[Broadcast]
class Shoes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $SaleDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getSaleDate(): ?\DateTimeImmutable
    {
        return $this->SaleDate;
    }

    public function setSaleDate(?\DateTimeImmutable $SaleDate): static
    {
        $this->SaleDate = $SaleDate;

        return $this;
    }
}
