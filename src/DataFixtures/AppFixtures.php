<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\RentedProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const MINUTE_BY_DAY = 60 * 24;

    public function load(ObjectManager $manager)
    {
        // Products
        $fakeProducts = $this->getFakeProducts();
        foreach ($fakeProducts as $i => $fakeProduct)
        {
            $quantity = ($i % 10 === 0) ? 0 : random_int(1, 100);
            $product = new Product();
            $product->setName($fakeProduct['name']);
            $product->setPrice($fakeProduct['price']);
            $product->setQuantity($quantity);
            if ($quantity > 1) {
                $rentedProduct = new RentedProduct();

                $dates = $this->getRentedDate();
                if ($i % 2 == 0) {
                    $rentedProduct->setRentFrom($dates["rented_now"]["from"]);
                    $rentedProduct->setRentTo($dates["rented_now"]["to"]);
                } else {
                    $rentedProduct->setRentFrom($dates["rented_next_month"]["from"]);
                    $rentedProduct->setRentTo($dates["rented_next_month"]["to"]);
                }

                $rentedProduct->setProduct($product);
                $manager->persist($rentedProduct);
            }
            $manager->persist($product);
        }

        // Promotions
        $fakePromotions = $this->getPromotions();
        foreach ($fakePromotions as $fakePromotion)
        {
            $promotion = new Promotion();
            $promotion->setPercentDiscount($fakePromotion['percent_discount']);
            $promotion->setMinimumRentTime($fakePromotion['minimum_rent_time']);
            $manager->persist($promotion);
        }

        $manager->flush();
    }

    private function getRentedDate()
    {
        $rented_now = new \DateTime();
        date_add($rented_now, date_interval_create_from_date_string('7 days'));
        $rented_next_month_from = new \DateTime();
        date_add($rented_next_month_from, date_interval_create_from_date_string('30 days'));
        $rented_next_month_to = new \DateTime();
        date_add($rented_next_month_to, date_interval_create_from_date_string('60 days'));

        return array(
            "rented_now" => array(
                "from" => (new \DateTime()),
                "to" => $rented_now
            ),
            "rented_next_month" => array(
                "from" => $rented_next_month_from,
                "to" => $rented_next_month_to
            )
        );
    }

    private function getFakeProducts()
    {
        return array(
            array(
                "name" => "trekking backpack",
                "price" => 4,
            ),
            array(
                "name" => "tent",
                "price" => 4.5,
            ),
            array(
                "name" => "sleeping bag",
                "price" => 2.5,
            ),
            array(
                "name" => "sleeping mattress",
                "price" => 1.5,
            ),
            array(
                "name" => "frontal headlamp",
                "price" => 0.5,
            ),
        );
    }

    private function getPromotions()
    {
        return array(
            array(
                "percent_discount" => 10,
                "minimum_rent_time" => self::MINUTE_BY_DAY * 3
            ),
            array(
                "percent_discount" => 20,
                "minimum_rent_time" => self::MINUTE_BY_DAY * 7
            ),
            array(
                "percent_discount" => 30,
                "minimum_rent_time" => self::MINUTE_BY_DAY * 14
            ),
            array(
                "percent_discount" => 50,
                "minimum_rent_time" => self::MINUTE_BY_DAY * 21
            )
        );
    }
}
