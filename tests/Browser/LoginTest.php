<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $company;
    private $user;

    public function testLogin()
    {
        $user = $this->user;

        $this->browse(function ($browser) use ($user) {
            $browser->maximize();
            $browser->visit('/')
                    ->type('email', $user->email)
                    ->type('password', '123456')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        \App\Models\User::factory()->times(1)->create();
        $this->user = \App\Models\User::first();

        \App\Models\Company::factory()->times(1)->create();
        $this->company = \App\Models\Company::first();
    }
}
