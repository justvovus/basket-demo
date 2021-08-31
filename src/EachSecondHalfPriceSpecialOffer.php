<?php

namespace Widget\Basket;

class EachSecondHalfPriceSpecialOffer implements ISpecialOffer
{
    public function __construct(private array $productCodes)
    {

    }

    public function isApplicable(OrderItem $orderItem): bool
    {
        return $orderItem->quantity() >= 2 && in_array($orderItem->product()->code(), $this->productCodes);
    }

    public function apply(OrderItem $orderItem): float
    {
        $discountedQty = intdiv($orderItem->quantity(), 2);

        return $orderItem->total() - $discountedQty * $orderItem->product()->price() / 2;
    }
}
