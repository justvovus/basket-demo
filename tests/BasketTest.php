<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Widget\Basket\Basket;

final class BasketTest extends TestCase
{
    private Basket $basket;

    /**
     * @before
     */
    public function setUpBasket(): void
    {
        $dummyProducts = array_map(
            function ($productDto) {
                return new \Widget\Basket\Product($productDto['code'], $productDto['name'], $productDto['price']);
            },
            [
                ['code' => 'R01', 'name' => 'Red Widget', 'price' => 32.95],
                ['code' => 'G01', 'name' => 'Green Widget', 'price' => 24.95],
                ['code' => 'B01', 'name' => 'Blue Widget', 'price' => 7.95],
            ]
        );


        $specialOffers = [
            new \Widget\Basket\EachSecondHalfPriceSpecialOffer(['R01'])
        ];

        $this->basket = new \Widget\Basket\Basket(new \Widget\Basket\Catalogue($dummyProducts), $specialOffers, new \Widget\Basket\SpendMoreDeliveryStrategy());
    }

    /**
     * @dataProvider basketsProvider
     */
    public function testBasketTotal($order, $expectedTotal): void
    {
        $orderItemsCount = count($order);
        for ($i = 0; $i < $orderItemsCount; $i++) {
            $this->basket->add($order[$i]);
        }

        $this->assertSame($this->basket->total(), $expectedTotal);
    }

    public function basketsProvider(): array
    {
        return [
            [['B01', 'G01'], 37.85],
            [['R01', 'R01'], 54.37],
            [['R01', 'G01'], 60.85],
            [['B01', 'B01', 'R01', 'R01', 'R01'], 98.27]
        ];
    }
}
