<?php

namespace Widget\Basket;

class OrderItem
{
    private int $qty = 1;

    public function __construct(private Product $product)
    {

    }

    public function add()
    {
        ++$this->qty;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): int
    {
        return $this->qty;
    }

    public function total(): float
    {
        return $this->qty * $this->product->price();
    }
}
