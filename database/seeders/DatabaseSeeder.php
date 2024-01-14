<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
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
            'details' => 'Indulge in the ultimate self-care experience with our rejuvenating body treatment services! Step into a world of relaxation and wellness as our skilled therapists pamper you with luxurious treatments designed to nourish your body and soothe your senses.',
            'price' => '100.000',],
            ['service_name' => 'Massage',
            'details' => 'Embark on a journey of serenity and rejuvenation with our exceptional massage services. Unwind, relax, and let the stresses of the day melt away as our skilled therapists expertly address your unique needs.',
            'price' => '150.000',],
            ['service_name' => 'Hair Treatment',
            'details' => 'Revitalize your locks and unleash the full potential of your hair with our exceptional hair treatment services. Step into a world of beauty and self-care where our expert stylists are dedicated to enhancing the health, shine, and overall allure of your hair.',
            'price' => '200.000',],
            ['service_name' => 'Manicure',
            'details' => 'Treat yourself to a moment of luxury and care that extends beyond aesthetics to promote healthier, more radiant hands. Our wide selection of high-quality nail colors and products ensures that your manicure is not only visually stunning but also long-lasting.',
            'price' => '50.000',],
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
        DB::table('image_services')->insert([
            ['imgdir' => 'body.png',
            'service_id' => '1'],
            ['imgdir' => 'massage.png',
            'service_id' => '2'],
            ['imgdir' => 'hair.png',
            'service_id' => '3'],
            ['imgdir' => 'manicure.webp',
            'service_id' => '4'],
        ]);
        
    }
}
