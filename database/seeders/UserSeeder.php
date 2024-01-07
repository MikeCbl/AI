<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name' => 'Grzegorz',
                    'last_name' => 'Floryda',
                    'gender' => 'M',
                    'birth_date' => '1990-01-01',
                    'birth_place' => 'Warszawa',
                    'email' => 'adam@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '123456789',
                    'residential_address' => 'ul. Kolorowa 1, 00-000 Warszawa',
                    'pesel' => '90010100000',
                    'admission_date' => '1990-01-01',
                    'password' => Hash::make('1234'), // bcrypt()
                    'role_id' => 1,
                ],
                [
                    'name' => 'Klaudia',
                    'last_name' => 'Kier',
                    'gender' => 'F',
                    'birth_date' => '1994-05-10',
                    'birth_place' => 'Warszawa',
                    'email' => 'KKier@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '694202137',
                    'residential_address' => 'ul. Morska 4, 60-000 Poznań',
                    'pesel' => '94051001341',
                    'admission_date' => '2020-09-01',
                    'password' => Hash::make('1234'),
                    'role_id' => 2,
                ],
                [
                    'name' => 'Anna',
                    'last_name' => 'Kowalska',
                    'gender' => 'F',
                    'birth_date' => '1995-05-05',
                    'birth_place' => 'Kraków',
                    'email' => 'anna@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '987654321',
                    'residential_address' => 'ul. Kwiatowa 2, 30-000 Kraków',
                    'pesel' => '95050500000',
                    'admission_date' => '2020-10-01',
                    'password' => Hash::make('abcd'),
                    'role_id' => 2,
                ],
                [
                    'name' => 'Jan',
                    'last_name' => 'Kowalski',
                    'gender' => 'M',
                    'birth_date' => '1985-12-20',
                    'birth_place' => 'Gdańsk',
                    'email' => 'jan.kowalski@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '111222333',
                    'residential_address' => 'ul. Zielona 3, 80-000 Gdańsk',
                    'pesel' => '85122000000',
                    'admission_date' => '2021-02-15',
                    'password' => Hash::make('qwerty'),
                    'role_id' => 2,
                ],
                [
                    'name' => 'Maria',
                    'last_name' => 'Nowakowska',
                    'gender' => 'F',
                    'birth_date' => '2000-06-10',
                    'birth_place' => 'Poznań',
                    'email' => 'maria.nowakowska@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '444555666',
                    'residential_address' => 'ul. Morska 4, 60-000 Poznań',
                    'pesel' => '00061000000',
                    'admission_date' => '2019-09-01',
                    'password' => Hash::make('zxcvb'),
                    'role_id' => 3,
                ],
                [
                    'name' => 'Karol',
                    'last_name' => 'Nowakowski',
                    'gender' => 'M',
                    'birth_date' => '1986-06-10',
                    'birth_place' => 'Radom',
                    'email' => 'K.now@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '444777666',
                    'residential_address' => 'ul. Morska 4, 60-000 Poznań',
                    'pesel' => '86061001311',
                    'admission_date' => '2019-09-01',
                    'password' => Hash::make('1234'),
                    'role_id' => 3,
                ],
                [
                    'name' => 'Adam',
                    'last_name' => 'Kowalski',
                    'gender' => 'M',
                    'birth_date' => '1986-05-10',
                    'birth_place' => 'Radom',
                    'email' => 'KowalA@email.com',
                    'email_verified_at' => Carbon::now(),
                    'phone' => '444555777',
                    'residential_address' => 'ul. Morska 4, 60-000 Poznań',
                    'pesel' => '86051001311',
                    'admission_date' => '2019-09-01',
                    'password' => Hash::make('1234'),
                    'role_id' => 3,
                ],
            ]
        );

        //jezeli obrazek jest null dodaj defaultowe zdj na podstawie płci
        $users = User::whereNull('image')->get();

        foreach ($users as $user) {
            // Assign default profile picture based on gender
            if ($user->gender === 'M') {
                $user->image = 'img/user/default/male.jpg';
            } else {
                $user->image = 'img/user/default/female.jpg';
            }
            if ($user->role_id === 1) {
                $user->image = 'img/user/default/admin.jpg';
            }

            $user->save();
        }
    }
}
