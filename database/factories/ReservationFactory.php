<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{

    // protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function ($reservation) {
    //         $reservation->price = $reservation->calculatePrice();
    //         $reservation->save();
    //     });
    // }
}
