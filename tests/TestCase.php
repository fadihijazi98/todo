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

    protected function handleResponseRequest($endpoint, $method, $data, $response_key)
    {
        $request = $this->sendRequest($endpoint, $method, $data);

        $request->assertOk();

        return $this->getResponse($request, $response_key);
    }

    protected function sendRequest($endpoint, $method, $data)
    {
        $request = $this->$method($endpoint, $data);

        return $request;
    }

    protected function getResponse($request, $response_key)
    {
        return ($request->getOriginalContent()->getData()[$response_key] ?? null);
    }
}
