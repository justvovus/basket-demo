<?php

namespace Widget\Basket;

use Widget\Basket\Exceptions\ProductNotFoundException;

class Basket
{
    private array $order = [];

    public function __construct(
        private Catalogue         $catalogue,
        private array             $specialOffers,
        private IDeliveryStrategy $deliveryStrategy
    )
    {

    }

    public function add(string $productCode): void
    {
        if (isset($this->order[$productCode])) {
            $this->order[$productCode]->add();
            return;
        }

        $product = $this->catalogue->find($productCode);

        if (is_null($product)) {
            throw new ProductNotFoundException($productCode);
        }

        $this->order[$productCode] = new OrderItem($product);
    }

    public function total(): float
    {
        $subtotal = array_reduce($this->order, function (float $carry, OrderItem $orderItem) {
            return $carry + $this->applyOffers($orderItem);
        }, 0);

        $deliveryFee = $this->deliveryStrategy->resolve($subtotal);

        return round($subtotal + $deliveryFee, 2, PHP_ROUND_HALF_DOWN);
    }

    private function applyOffers(OrderItem $orderItem): float
    {
        return array_reduce($this->specialOffers, function ($carry, ISpecialOffer $specialOffer) use ($orderItem) {
            $price = $specialOffer->isApplicable($orderItem) ? $specialOffer->apply($orderItem) : $orderItem->total();

            return $carry + $price;
        }, 0);
    }
}
