<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProductsIndexTest extends DuskTestCase
{
    private $company;
    private $user;

    public function testProductsIndex()
    {
        $user = $this->user;
        
        $this->browse(function (Browser $browser) use ($user) {
            $browser->maximize();
            $browser->loginAs($user)
                    ->visit('/products')
                    ->assertSee('Produtos');
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
