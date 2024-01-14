<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('services')->insert([
            ['service_name' => 'Body Treatment',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'price' => 'Rp. 100.000',],
            ['service_name' => 'Massage',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'price' => 'Rp. 150.000',],
            ['service_name' => 'Hair Treatment',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'price' => 'Rp. 200.000',],
            ['service_name' => 'Manicure',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'price' => 'Rp. 50.000',],
        ]);
        DB::table('rooms')->insert([
            ['room_name' => 'Room 1',
            'category' => '3 Person max',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'],
            ['room_name' => 'Room 2',
            'category' => '1 Person max',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'],
            ['room_name' => 'Room 3',
            'category' => '2 Person max',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'],
        ]);
    }
}
