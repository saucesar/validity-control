<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductsIndexTest extends DuskTestCase
{
    use DatabaseMigrations;

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

        \App\Models\User::factory()->times(1)->create();
        $this->user = \App\Models\User::first();

        \App\Models\Company::factory()->times(1)->create();
        $this->company = \App\Models\Company::first();
    }
}
