<?php

namespace App;

use App\Product;

class Order
{
    protected $products = [];

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function products(): Iterable
    {
        return $this->products;
    }

    public function price(): float
    {
        return (float) array_reduce($this->products, function($carry, $item) {
            return $carry + $item->cost();
        }, 0);
    }
}