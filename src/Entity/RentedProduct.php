<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use App\Repository\RentedProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RentedProductRepository::class)
 * @ApiResource()
 * @ApiFilter(DateFilter::class, properties={"rent_from", "rent_to"})
 * @ApiFilter(RangeFilter::class, properties={"quantity"})
 */
class RentedProduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rent_from;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rent_to;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="rentedProducts")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
