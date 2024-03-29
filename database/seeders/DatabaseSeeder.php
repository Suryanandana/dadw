<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'admin',
                'email' => 'admin@cajuput.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ]
        ]);

        DB::table('package')->insert([
            [
                'package_name' => 'Body Treatment',
                'package_duration' => '120', //minutes
                'price' => '300000',
                'detail' => 'Indulge in the ultimate self-care experience with our rejuvenating body treatment services! Step into a world of relaxation and wellness as our skilled therapists pamper you with luxurious treatments designed to nourish your body and soothe your senses.',
            ],
            [
                'package_name' => 'Hair Treatment',
                'package_duration' => '120', //minutes
                'price' => '300000',
                'details' => 'Revitalize your locks and unleash the full potential of your hair with our exceptional hair treatment services. Step into a world of beauty and self-care where our expert stylists are dedicated to enhancing the health, shine, and overall allure of your hair.',
            ],
        ]);

        DB::table('package_image')->insert([
            [
                'imgdir' => 'bodytreatment_20240324_034859.webp',
                'id_package' => '1'
            ],
            [
                'imgdir' => 'hairtreatment_20240324_034915.webp',
                'id_package' => '2'
            ],
        ]);


        DB::table('rooms')->insert([
            [
                'room_name' => 'The Cave',
                'category' => 'Max 1 Person',
                'description' => 'is a tranquil sanctuary within the spa, designed to immerse customers in a serene ambiance reminiscent of a natural cavern, evoking a sense of calm and relaxation through its industrial-inspired design. With dim lighting and textured walls reminiscent of stone formations, "The Cave" offers a rejuvenating escape where guests can unwind and indulge in blissful tranquility amidst the soothing ambiance.'
            ],
            [
                'room_name' => 'The Tropical',
                'category' => 'Max 2 Person',
                'description' => 'is a blissful retreat within the spa, boasting panoramic views of lush greenery and azure waters, while its incorporation of warm wood accents creates an inviting atmosphere that transports guests to a tranquil paradise, offering a rejuvenating escape from the hustle and bustle of daily life. With its vibrant foliage and earthy tones, this room exudes a sense of serenity, inviting guests to unwind and bask in the natural beauty that surrounds them, while indulging in a pampering experience that rejuvenates both body and soul.'
            ],
        ]);

        DB::table('services')->insert([
            [
                'service_name' => 'Body Treatment',
                'service_duration' => '30',
                'details' => 'Indulge in the ultimate self-care experience with our rejuvenating body treatment services! Step into a world of relaxation and wellness as our skilled therapists pamper you with luxurious treatments designed to nourish your body and soothe your senses.',
                'price' => '100000',
            ],
            [
                'service_name' => 'Massage',
                'service_duration' => '30',
                'details' => 'Embark on a journey of serenity and rejuvenation with our exceptional massage services. Unwind, relax, and let the stresses of the day melt away as our skilled therapists expertly address your unique needs.',
                'price' => '150000',
            ],
            [
                'service_name' => 'Hair Treatment',
                'service_duration' => '30',
                'details' => 'Revitalize your locks and unleash the full potential of your hair with our exceptional hair treatment services. Step into a world of beauty and self-care where our expert stylists are dedicated to enhancing the health, shine, and overall allure of your hair.',
                'price' => '200000',
            ],
            [
                'service_name' => 'Manicure',
                'service_duration' => '30',
                'details' => 'Treat yourself to a moment of luxury and care that extends beyond aesthetics to promote healthier, more radiant hands. Our wide selection of high-quality nail colors and products ensures that your manicure is not only visually stunning but also long-lasting.',
                'price' => '50000',
            ],
        ]);

        DB::table('image_services')->insert([
            [
                'imgdir' => 'bodytreatment_20240324_034859.webp',
                'service_id' => '1'
            ],
            [
                'imgdir' => 'massage_20240324_034928.webp',
                'service_id' => '2'
            ],
            [
                'imgdir' => 'hairtreatment_20240324_034915.webp',
                'service_id' => '3'
            ],
            [
                'imgdir' => 'manicure_20240324_034931.webp',
                'service_id' => '4'
            ],
        ]);
    }
}
