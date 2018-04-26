<?php

namespace App;

class Product
{
    protected $name;
    protected $cost;

    public function __construct(string $name, float $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cost(): float
    {
       return $this->cost;
    }
}