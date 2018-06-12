<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    public function signIn($user = null)
    {
        $this->user = $user ?: factory(User::class)->create();
        $this->actingAs($this->user);

        return $this;
    }
}
