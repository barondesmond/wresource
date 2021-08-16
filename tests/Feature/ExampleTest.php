<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $token = hash('sha256', env('TOKEN'));

        $response = $this->withHeaders([
                       'Authorization' => 'Bearer '. $token,
                       'Accept' => 'application/json'
                   ])->get('/api/widget/');

        $response->assertStatus(200);
    }
}
