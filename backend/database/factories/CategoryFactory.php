<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    final public function definition(): array
    {
        return [

        ];
    }

    final public function configure(): CategoryFactory|Factory
    {
        return $this->afterCreating(function (Category $category) {

            $category->attributes()->create([
                'title' => $this->faker->title(),
                'slug' => $this->faker->slug(),
                'description' => $this->faker->text(),
                'content' => $this->faker->text(400),
            ]);

            $category->meta()->create([
                'seo' => json_encode([
                    'title' => $this->faker->sentence,
                    'description' => $this->faker->paragraph,
                    'keywords' => null,
                    'canonical' => null,
                    'noindex' => false,
                ]),
                'og' => json_encode([
                    'title' => $this->faker->sentence,
                    'description' => $this->faker->paragraph,
                    'image' => null,
                    'type' => null,
                    'site_name' => null,
                ]),
            ]);
        });
    }
}
