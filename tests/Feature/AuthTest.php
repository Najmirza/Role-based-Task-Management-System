<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_registration_and_login()
{
    $this->artisan('migrate:fresh');

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertRedirect('/dashboard');

    $this->post('/logout');

    $login = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);
    $login->assertRedirect('/dashboard');
}

}
