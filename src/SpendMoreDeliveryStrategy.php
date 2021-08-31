<?php

namespace Widget\Basket;

class SpendMoreDeliveryStrategy implements IDeliveryStrategy
{
    public function resolve(float $total): float
    {
        return match(true) {
            $total < 50 => 4.95,
            $total < 90 => 2.95,
            default => 0
        };
    }
}
