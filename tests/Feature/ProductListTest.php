<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;

class ProductListTest extends TestCase
{
    public function test_it_can_filter_products_by_name()
    {
        $category = Category::factory()->create();

        $brand = Brand::factory()->create();

        Product::factory()->create(['name' => 'Product 1', 'category_id' => $category->id, 'brand_id' => $brand->id]);
        Product::factory()->create(['name' => 'Product 2', 'category_id' => $category->id, 'brand_id' => $brand->id]);

        Livewire::test('product-list')
            ->set('search', 'Product 1')
            ->assertSee('Product 1')
            ->assertDontSee('Product 2');
    }

    public function test_it_can_filter_products_by_brand()
    {
        $category = Category::factory()->create();

        $brand1 = Brand::factory()->create();
        $brand2 = Brand::factory()->create();

        Product::factory()->create(['name' => 'Product 1', 'category_id' => $category->id, 'brand_id' => $brand1->id]);
        Product::factory()->create(['name' => 'Product 2', 'category_id' => $category->id, 'brand_id' => $brand2->id]);

        Livewire::test('product-list')
            ->set('selectedBrands', [$brand1->id])
            ->assertSee('Product 1')
            ->assertDontSee('Product 2');
    }

    public function test_it_can_filter_products_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $brand = Brand::factory()->create();

        Product::factory()->create(['name' => 'Product 1', 'category_id' => $category1->id, 'brand_id' => $brand->id]);
        Product::factory()->create(['name' => 'Product 2', 'category_id' => $category2->id, 'brand_id' => $brand->id]);

        Livewire::test('product-list')
            ->set('selectedCategories', [$category1->id])
            ->assertSee('Product 1')
            ->assertDontSee('Product 2');
    }
}
