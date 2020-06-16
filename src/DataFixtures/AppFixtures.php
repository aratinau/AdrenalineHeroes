<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Promotion;
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
            $quantity = ($i % 3 === 0) ? 0 : random_int(1, 100);
            $product = new Product();
            $product->setName($fakeProduct['name']);
            $product->setPrice($fakeProduct['price']);
            $product->setRentTimeByMinute($fakeProduct['rent_time_by_minute']);
            $product->setQuantity($quantity);
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

    private function getFakeProducts()
    {
        return array(
            array(
                "name" => "trekking backpack",
                "price" => 4,
                "rent_time_by_minute" => self::MINUTE_BY_DAY,
            ),
            array(
                "name" => "tent",
                "price" => 4.5,
                "rent_time_by_minute" => self::MINUTE_BY_DAY
            ),
            array(
                "name" => "sleeping bag",
                "price" => 2.5,
                "rent_time_by_minute" => self::MINUTE_BY_DAY
            ),
            array(
                "name" => "sleeping mattress",
                "price" => 1.5,
                "rent_time_by_minute" => self::MINUTE_BY_DAY
            ),
            array(
                "name" => "frontal headlamp",
                "price" => 0.5,
                "rent_time_by_minute" => self::MINUTE_BY_DAY
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
