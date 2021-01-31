<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $company;
    private $user;

    public function testLogin()
    {
        $user = $this->user;

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')
                    ->type('email', $user->email)
                    ->type('password', 'testpass')
                    ->press('Login')
                    ->screenshot('home')
                    ->assertPathIs('/home');
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->company = \App\Models\Company::create([
            'name' => 'Test Company',
        ]);

        $this->user = \App\Models\User::create([
            'name' => 'User test',
            'email' => Str::random(10)."@test.com",
            'password' => Hash::make('testpass'),
            'company_id' => $this->company->id,
            'access_granted' => true,
            'access_denied' => false,
        ]);

        $this->user->email_verified_at = now();
        $this->user->save();

        $this->company->owner_id = $this->user->id;
        $this->company->save();
    }
}
