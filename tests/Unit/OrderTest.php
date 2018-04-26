<?php

namespace Tests\Unit;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_order_can_contains_products()
    {
        $order = new Order;

        $product1 = new Product('Playstation 4', 299);
        $product2 = new Product('Gyroscooter', 199);

        $order->add($product1);
        $order->add($product2);

        $this->assertCount(2, $order->products());
    }

    public function test_order_can_count_his_total_products_price()
    {
        $order = new Order;

        $product1 = new Product('Playstation 4', 299);
        $product2 = new Product('Gyroscooter', 199);

        $order->add($product1);
        $order->add($product2);
        $order->add($product2);

        $this->assertEquals(199+299+199, $order->price());
    }
}
