<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity=RentedProduct::class, mappedBy="product")
     */
    private $rentedProducts;

    public function __construct()
    {
        $this->rentedProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection|RentedProduct[]
     */
    public function getRentedProducts(): Collection
    {
        return $this->rentedProducts;
    }

    public function addRentedProduct(RentedProduct $rentedProduct): self
    {
        if (!$this->rentedProducts->contains($rentedProduct)) {
            $this->rentedProducts[] = $rentedProduct;
            $rentedProduct->setProduct($this);
        }

        return $this;
    }

    public function removeRentedProduct(RentedProduct $rentedProduct): self
    {
        if ($this->rentedProducts->contains($rentedProduct)) {
            $this->rentedProducts->removeElement($rentedProduct);
            // set the owning side to null (unless already changed)
            if ($rentedProduct->getProduct() === $this) {
                $rentedProduct->setProduct(null);
            }
        }

        return $this;
    }
}
