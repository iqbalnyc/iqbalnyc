<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderMaster>
 */
class OrderMasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'orderDate' =>  now(),
            'orderId' => $this->faker->sentence,
            'userName' => $this->faker->sentence
        ];
    }
}
