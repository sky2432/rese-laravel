<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'owner_id' => rand(1, 20),
            'area_id' => rand(1, 3),
            'genre_id' => rand(1, 5),
            'overview' => $this->faker->realText(50),
            'image_url' => $this->faker->url()
        ];
    }
}
