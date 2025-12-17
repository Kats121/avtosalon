<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'cars')]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Avto = null;

    #[ORM\Column]
    private ?int $price = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvto(): ?string
    {
        return $this->Avto;
    }

    public function setAvto(string $Avto): static
    {
        $this->Avto = $Avto;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }
}
