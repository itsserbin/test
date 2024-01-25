<?php

namespace Feature\Models;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Product;
use App\Models\Property;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    final public function test_product_created(): void
    {
        $category = Category::factory()->create();
        $characteristic = Characteristic::factory()->create();
        $property = Property::factory()->create();

        // Create a new product using the factory
        $model = Product::factory()->create();
        $model->categories()->attach($category);
        $model->characteristics()->attach($characteristic);
        $model->properties()->create([
            'value' => 'test',
            'property_id' => $property->id
        ]);

        $this
            ->assertDatabaseHas('products', [
                'id' => $model->id,
            ])
            ->assertDatabaseHas('product_attributes', [
                'product_id' => $model->id,
            ])
            ->assertDatabaseHas('product_availabilities', [
                'product_id' => $model->id,
            ])
            ->assertDatabaseHas('meta_tags', [
                'taggable_id' => $model->id,
                'taggable_type' => Product::class,
            ])
            ->assertDatabaseHas('category_products', [
                'product_id' => $model->id,
                'category_id' => $category->id,
            ])
            ->assertDatabaseHas('product_characteristics', [
                'product_id' => $model->id,
                'characteristic_id' => $characteristic->id,
            ])
            ->assertDatabaseHas('product_properties', [
                'product_id' => $model->id,
                'property_id' => $property->id,
            ]);
    }

}
