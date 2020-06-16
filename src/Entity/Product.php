<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource()
 * @ApiFilter(DateFilter::class, properties={"rent_from", "rent_to"})
 * @ApiFilter(RangeFilter::class, properties={"quantity"})
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rent_from;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rent_to;

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

    public function getRentFrom(): ?\DateTimeInterface
    {
        return $this->rent_from;
    }

    public function setRentFrom(?\DateTimeInterface $rent_from): self
    {
        $this->rent_from = $rent_from;

        return $this;
    }

    public function getRentTo(): ?\DateTimeInterface
    {
        return $this->rent_to;
    }

    public function setRentTo(?\DateTimeInterface $rent_to): self
    {
        $this->rent_to = $rent_to;

        return $this;
    }
}
