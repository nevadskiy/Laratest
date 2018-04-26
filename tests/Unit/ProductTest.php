<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_product_can_get_name()
    {
        $product = new Product('Playstation 4', 299);

        $this->assertEquals('Playstation 4', $product->name());
    }

    public function test_product_has_cost()
    {
        $product = new Product('Playstation 4', 299);

        $this->assertEquals(299, $product->cost());
    }
}
