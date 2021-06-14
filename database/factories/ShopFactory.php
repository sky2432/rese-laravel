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
            'genre_id' => rand(1, 5),
            'overview' => $this->faker->realText(50),
            'postal_code' => "1060032",
            'main_address' => "東京都港区六本木6-10",
            'option_address' => "六本木ヒルズ森タワー",
            'image_url' => $this->faker->url()
        ];
    }
}
