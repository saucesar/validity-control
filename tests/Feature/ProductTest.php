<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    public function testNotLogedUser()
    {
        $response = $this->get('products');
        $response->assertStatus(302);
    }

    public function testCreateProduct()
    {
        $countBefore = \App\Models\Product::all()->count();
        $product = \App\Models\Product::create(['barcode' => '7891010223355', 'description' => 'PRODUCT TEST', 'company_id' => 1, 'category_id' => 1]);
        $countAfter = \App\Models\Product::all()->count();

        $this->assertNotNull($product);
        $this->assertEquals(++$countBefore, $countAfter);
    }

    public function testSearchProductByBarcode()
    {
        $product = \App\Models\Product::where('barcode', '7891010223344')->first();
        $this->assertNotNull($product);
    }

    protected function setUp(): void
    {
        parent::setUp();
        \App\Models\User::factory()->times(2)->create();
        \App\Models\Company::factory()->times(2)->create();
        \App\Models\Category::factory()->times(2)->create();
        \App\Models\Product::create(['barcode' => '7891010223344', 'description' => 'PRODUCT TEST', 'company_id' => 1, 'category_id' => 1]);
    }
}
