<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    final public function testCategoryList(): void
    {
        $count = 10;
        $category = Category::factory()->count($count)->create();

        $data = [
            'with' => [
                'attributes:title,slug,category_id',
                'meta:taggable_id,title,description'
            ],
            'select' => ['id', 'created_at'],
            'orderType' => 'desc',
        ];

        $response = $this->call('GET', route('api.categories.list'), $data);

        $response->assertStatus(200);
        $response->assertJsonCount($count, 'data');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'attributes',
                    'meta',
                    'created_at',
                ]
            ]
        ]);
    }

    final public function testCategoryCanBeCreated(): void
    {
        $data = [
            'attributes' => [
                'title' => $this->faker->title,
                'slug' => $this->faker->slug
            ],
            'meta' => [
                'title' => $this->faker->title,
            ]
        ];

        $response = $this->postJson(route('api.categories.create'), $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('category_attributes', [
            'category_id' => $response['data']['id'],
            'title' => $data['attributes']['title'],
            'slug' => $data['attributes']['slug'],
        ]);
        $this->assertDatabaseHas('meta_tags', [
            'title' => $data['meta']['title'],
            'taggable_id' => $response['data']['id'],
        ]);
    }

    final public function testCategoryCanBeUpdated(): void
    {
        $category = Category::factory()->create();

        $data = [
            'attributes' => [
                'title' => 'test title',
                'slug' => 'test-slug'
            ],
            'meta' => [
                'title' => 'asdas',
            ]
        ];

        $response = $this->putJson(route('api.categories.update', $category->id), $data);
        $response->assertStatus(200);

        $this->assertDatabaseHas('category_attributes', [
            'category_id' => $response['data']['id'],
            'title' => $data['attributes']['title'],
            'slug' => $data['attributes']['slug'],
        ]);
        $this->assertDatabaseHas('meta_tags', [
            'title' => $data['meta']['title'],
            'taggable_id' => $response['data']['id'],
        ]);
    }

    final public function testCategoryCanBeDestroyed(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(route('api.categories.destroy', ['id' => $category->id]));
        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);

        $this->assertDatabaseMissing('category_attributes', [
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseMissing('meta_tags', [
            'taggable_id' => $category->id,
            'taggable_type' => Category::class
        ]);
    }

    final public function testCategoryCanBeShowed(): void
    {
        $category = Category::factory()->create();

        $data = [
            'with' => ['meta', 'attributes']
        ];
        $response = $this->getJson(route('api.categories.show', $category->id), $data);
        $response->assertStatus(200);
    }

}

