<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            '_unique' => substr($this->faker->sha1,0, 16),
            'description' => $this->faker->sentence(),
            'price' => rand(5, 50),
            'image' => 'https://picsum.photos/id/'. rand(1, 200) .'/420/420',
        ];
    }
}
