<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Laravel');
    }

    // public function testButtonClick()
    // {
        // 1. Visit home page
        // $response = $this->get('/home');

        // 2. Press "click me" button
        // $this->click('Click me');

        // 3. See Clicked

        // 4. Assert current url 
    // }
}
