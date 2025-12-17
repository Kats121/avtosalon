<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $customer_id = null;

    #[ORM\Column(name: 'customer_name', type: 'string', length: 255)]
    private ?string $name = null;
    #[ORM\Column(length: 255)]
    private ?string $email = null;
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'customer')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->customer_id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
         $this->email = $email;
        return $this;
    }

     public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrder(Order $order): static
    {
           $this->$order = $order;
        return $this;
    }
}