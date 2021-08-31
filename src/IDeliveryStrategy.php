<?php

namespace Widget\Basket;

interface IDeliveryStrategy
{
    public function resolve(float $total): float;
}
