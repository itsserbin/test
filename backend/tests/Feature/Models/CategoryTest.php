<?php

namespace Feature\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    final public function test_category_created(): void
    {
        // Create a new category using the factory
        $category = Category::factory()->create();

        // Assert that the category was created successfully
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);

        // Assert the creation of related attributes
        $this->assertDatabaseHas('category_attributes', [
            'category_id' => $category->id,
        ]);

        // Assert the creation of related meta tags
        $this->assertDatabaseHas('meta_tags', [
            'taggable_id' => $category->id,
            'taggable_type' => Category::class,
        ]);
    }

}
