<?php

namespace Widget\Basket;

interface ISpecialOffer
{
    public function isApplicable(OrderItem $orderItem): bool;

    public function apply(OrderItem $orderItem): float;
}
