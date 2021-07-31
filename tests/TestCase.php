<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->actingAs($user);

        return $user;
    }

    public function handleRequest($endpoint, $method, $data, $response_key)
    {
        $request = $this->$method($endpoint, $data);

        $request->assertOk();

        return $request->getOriginalContent()->getData()[$response_key];
    }
}
