<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Product::class;

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

    final public function configure(): ProductFactory|Factory
    {
        return $this->afterCreating(function (Product $product) {
            $product->attributes()->create($this->attributes());
            $product->meta()->create($this->meta());
            $product->availability()->create($this->availability());
        });
    }

    private function availability(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(0, 1000)
        ];
    }

    private function attributes(): array
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'content' => $this->faker->text(400),
        ];
    }

    private function meta(): array
    {
        return [
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
        ];
    }
}
