<?php

namespace Widget\Basket;

class Catalogue
{
    public function __construct(private array $products)
    {

    }

    public function find(string $code): ?Product
    {
        $productsCount = count($this->products);

        for ($i = 0; $i < $productsCount; $i++) {
            if ($this->products[$i]->code() === $code) {
                return $this->products[$i];
            }
        }

        return null;
    }
}
