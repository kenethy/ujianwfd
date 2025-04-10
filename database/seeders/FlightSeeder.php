<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flights')->insert([
        [
            'flight_number' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'JKT',
            'departure_time' => '2024-10-16 08:00:00',
            'arrival_time' => '2024-10-16 10:00:00',
            'created_at' => now(),
            'updated_at' => now()

        ],
        [
            'flight_number' => 'GA202',
            'origin' => 'CGK',
            'destination' => 'DPS',
            'departure_time' => '2024-10-16 12:00:00',
            'arrival_time' => '2024-10-16 14:00:00',
            'created_at' => now(),
            'updated_at' => now()

        ],
        [
            'flight_number' => 'QZ501',
            'origin' => 'DPS',
            'destination' => 'SUB',
            'departure_time' => '2024-10-17 18:00:00',
            'arrival_time' => '2024-10-17 19:30:00',
            'created_at' => now(),
            'updated_at' => now()

        ],
        [
            'flight_number' => 'ID654',
            'origin' => 'UPG',
            'destination' => 'SUB',
            'departure_time' => '2024-10-18 7:30:00',
            'arrival_time' => '2024-10-18 09:00:00',
            'created_at' => now(),
            'updated_at' => now()

        ],
        [
            'flight_number' => 'SQ315',
            'origin' => 'SIN',
            'destination' => 'CGK',
            'departure_time' => '2024-10-19 15:00:00',
            'arrival_time' => '2024-10-19 17:00:00',
            'created_at' => now(),
            'updated_at' => now()

        ]]
        );
    }
    }


        

