<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    protected \App\Models\User $user;

    public function testCreateUser()
    {
        $this->user = \App\Models\User::factory()->create();
        $this->assertNotNull($this->user);
    }

    public function testAcessHomeWithoutAuth()
    {
        $response = $this->get(route('home.index'));
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testRedirectToLogin()
    {
        $response = $this->get(route('home.index'));
        $response->assertRedirect('login');
    }

    public function testUserRegistrationNameError()
    {
        $response = $this->post('users/create', ['name' => 'ce', 'email' => 'testemail@test.com', 'password' => '111111', 'password_confirmation' => '111111']);
        $response->assertSee('The name must be at least');
    }

    public function testUserRegistrationEmailError()
    {
        $response = $this->post('users/create', ['name' => 'cesar', 'email' => 'cesar@vc.com', 'password' => '111111', 'password_confirmation' => '111111']);
        $response->assertSee('The email has already been taken.');
    }

    public function testUserRegistrationPassworErrorError()
    {
        $response = $this->post('users/create', ['name' => 'cesar', 'email' => 'cesarcesar@vc.com', 'password' => '111111', 'password_confirmation' => '111121']);
        $response->assertSee('The password confirmation does not match.');
    }
}