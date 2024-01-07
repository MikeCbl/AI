<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;


class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $reservationData = [
            [
                'id' => 1,
                'user_id' => 2,
                'track_id' => 1,
                'reservation_date' => '2023-06-10',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'track_id' => 3,
                'reservation_date' => '2023-07-05',
                'start_time' => '14:30:00',
                'end_time' => '16:30:00',
            ],
        ];

        foreach ($reservationData as $data) {
            $reservation = new Reservation();
            $reservation->fill($data);
            // $reservation->price = $reservation->getPriceAttribute();
            $reservation->price = $reservation->getDiscountedPriceAttribute();
            $reservation->save();
        }


    }
}
