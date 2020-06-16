<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $percent_discount;

    /**
     * @ORM\Column(type="integer")
     */
    private $minimum_rent_time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercentDiscount(): ?int
    {
        return $this->percent_discount;
    }

    public function setPercentDiscount(int $percent_discount): self
    {
        $this->percent_discount = $percent_discount;

        return $this;
    }

    public function getMinimumRentTime(): ?int
    {
        return $this->minimum_rent_time;
    }

    public function setMinimumRentTime(int $minimum_rent_time): self
    {
        $this->minimum_rent_time = $minimum_rent_time;

        return $this;
    }
}
