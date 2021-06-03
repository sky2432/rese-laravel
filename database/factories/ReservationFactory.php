<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'shop_id' => rand(1, 20),
            'visited_on' => $this->faker->dateTimeBetween('-1week', '1week'),
            'number_of_visiters' => rand(1, 5),
            'status' => $this->faker->randomElement(['reserving', 'visited' ,'cancelled']),
        ];
    }
}
