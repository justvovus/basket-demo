<?php

namespace Widget\Basket;

class Product
{
    public function __construct(private string $code, private string $name, private float $price)
    {

    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }
}
