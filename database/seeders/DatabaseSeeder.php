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
                'level' => 'admin',
                'name' => 'admin',
                'email' => 'admin@cajuput.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '2',
                'level' => 'staff',
                'name' => 'staff',
                'email' => 'staff@cajuput.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '3',
                'level' => 'customer',
                'name' => 'Ariana Kjelberg',
                'email' => 'ariana@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '4',
                'level' => 'customer',
                'name' => 'Mayrika Diva',
                'email' => 'diva@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '5',
                'level' => 'customer',
                'name' => 'Iqbal Fauzi',
                'email' => 'fauzi@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '6',
                'level' => 'customer',
                'name' => 'Richard Felix',
                'email' => 'richard@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '7',
                'level' => 'customer',
                'name' => 'Bella Hadid',
                'email' => 'bella@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
            [
                'id' => '8',
                'level' => 'customer',
                'name' => 'Gigi Sulaiman',
                'email' => 'gigi@gmail.com',
                'email_verified_at' => '2024-03-22 00:19:40',
                'password' => '$2y$10$5HCFfkAVeH5uwQQ2sMCLRu6PEX8JMiQianfoCktyxVk6MNyxXDpDe' //12345678
            ],
        ]);

        DB::table('staff')->insert([
            [
                'id' => '1',
                'phone' => '081123456789',
                'id_users' => '2'
            ]
        ]);

        DB::table('customer')->insert([
            [
                'id' => '1',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Kuta No. 1, Badung, Bali',
                'country' => 'Indonesia',
                'id_users' => '3'
            ],
            [
                'id' => '2',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Renon No. 1, Denpasar, Bali',
                'country' => 'Indonesia',
                'id_users' => '4'
            ],
            [
                'id' => '3',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Badung No. 1, Badung, Bali',
                'country' => 'Indonesia',
                'id_users' => '5'
            ],
            [
                'id' => '4',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Sesetan No. 1, Denpasar, Bali',
                'country' => 'Indonesia',
                'id_users' => '6'
            ],
            [
                'id' => '5',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Denpasar No. 1, Denpasar, Bali',
                'country' => 'Indonesia',
                'id_users' => '7'
            ],
            [
                'id' => '6',
                'phone' => '081123456789',
                'address' => 'Jl. Raya Unud No. 1, Jimbaran, Bali',
                'country' => 'Indonesia',
                'id_users' => '8'
            ],
        ]); 


        DB::table('rooms')->insert([
            [
                'id' => '1',
                'room_name' => 'The Cave',
                'category' => 'Max 1 Person',
                'description' => 'is a tranquil sanctuary within the spa, designed to immerse customers in a serene ambiance reminiscent of a natural cavern, evoking a sense of calm and relaxation through its industrial-inspired design. With dim lighting and textured walls reminiscent of stone formations, "The Cave" offers a rejuvenating escape where guests can unwind and indulge in blissful tranquility amidst the soothing ambiance.'
            ],
            [
                'id' => '2',
                'room_name' => 'The Tropical',
                'category' => 'Max 2 Person',
                'description' => 'is a blissful retreat within the spa, boasting panoramic views of lush greenery and azure waters, while its incorporation of warm wood accents creates an inviting atmosphere that transports guests to a tranquil paradise, offering a rejuvenating escape from the hustle and bustle of daily life. With its vibrant foliage and earthy tones, this room exudes a sense of serenity, inviting guests to unwind and bask in the natural beauty that surrounds them, while indulging in a pampering experience that rejuvenates both body and soul.'
            ],
        ]);

        DB::table('image_rooms')->insert([
            [
                'imgdir' => 'thecave_20240324_034831.webp',
                'id_room' => '1'
            ],
            [
                'imgdir' => 'thetropical_20240324_034844.webp',
                'id_room' => '2'
            ],
        ]);

        DB::table('services')->insert([
            [
                'id' => '1',
                'service_name' => 'Body Treatment',
                'type' => 'TREATMENT',
                'service_duration' => '30',
                'details' => 'Indulge in the ultimate self-care experience with our rejuvenating body treatment services! Step into a world of relaxation and wellness as our skilled therapists pamper you with luxurious treatments designed to nourish your body and soothe your senses.',
                'price' => '100000',
            ],
            [
                'id' => '2',
                'service_name' => 'Massage',
                'type' => 'TREATMENT',
                'service_duration' => '30',
                'details' => 'Embark on a journey of serenity and rejuvenation with our exceptional massage services. Unwind, relax, and let the stresses of the day melt away as our skilled therapists expertly address your unique needs.',
                'price' => '150000',
            ],
            [
                'id' => '3',
                'service_name' => 'Hair Treatment',
                'type' => 'TREATMENT',
                'service_duration' => '30',
                'details' => 'Revitalize your locks and unleash the full potential of your hair with our exceptional hair treatment services. Step into a world of beauty and self-care where our expert stylists are dedicated to enhancing the health, shine, and overall allure of your hair.',
                'price' => '200000',
            ],
            [
                'id' => '4',
                'service_name' => 'Manicure',
                'type' => 'TREATMENT',
                'service_duration' => '30',
                'details' => 'Treat yourself to a moment of luxury and care that extends beyond aesthetics to promote healthier, more radiant hands. Our wide selection of high-quality nail colors and products ensures that your manicure is not only visually stunning but also long-lasting.',
                'price' => '50000',
            ],
            [
                'id' => '5',
                'service_name' => 'Relaxed Package',
                'type' => 'PACKAGE',
                'service_duration' => '120',
                'details' => 'Indulge in our exclusive Cajuput Signature Rejuvenation, a harmonious blend of exfoliation and hydration. This treatment starts with a gentle body scrub, followed by a nourishing wrap infused with essential oils derived from the Cajuput tree. Surrender to the soothing ambiance as our therapists work their magic, leaving your skin revitalized and your senses refreshed.',
                'price' => '300000',
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
            [
                'imgdir' => 'relaxedpackage_20240324_034946.webp',
                'service_id' => '5'
            ],
        ]);

        DB::table('booking')->insert([
            [
                'id' => '1',
                'total' => '100000',
                'pax' => '1',
                'date' => '2024-07-05 09:00:00',
                'expired_date' => '2024-07-06 03:16:47',
                'external_id' => 'ENV-20240705-6687659d631dd',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/6687659f93cc438a399602d7',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '1',
                'id_room' => '1',
            ],
            [
                'id' => '2',
                'total' => '250000',
                'pax' => '1',
                'date' => '2024-03-29 09:00:00',
                'expired_date' => '2024-07-06 03:16:47',
                'external_id' => 'ENV-20240329-66068d4a55a6f',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/66068d4d591bace01ca8ed17',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '2',
                'id_room' => '1',
            ],
            [
                'id' => '3',
                'total' => '500000',
                'pax' => '2',
                'date' => '2024-03-29 09:00:00',
                'expired_date' => '2024-03-30 09:41:43',
                'external_id' => 'ENV-20240403-660ca997cbfa7',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/660ca99a256f656e42303f09',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '3',
                'id_room' => '2',
            ],
            [
                'id' => '4',
                'total' => '500000',
                'pax' => '1',
                'date' => '2024-03-29 09:00:00',
                'expired_date' => '2024-07-06 03:16:47',
                'external_id' => 'ENV-20240417-661f214ba623d',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/661f214f4701c10cee3a277a',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '4',
                'id_room' => '2',
            ],
            [
                'id' => '5',
                'total' => '50000',
                'pax' => '1',
                'date' => '2024-03-29 09:00:00',
                'expired_date' => '2024-07-06 03:16:47',
                'external_id' => 'ENV-20240708-668b3a6edfe88',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/668b3a702cfef181dba33a6b',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '5',
                'id_room' => '1',
            ],
            [
                'id' => '6',
                'total' => '200000',
                'pax' => '1',
                'date' => '2024-03-29 09:00:00',
                'expired_date' => '2024-07-06 03:16:47',
                'external_id' => 'ENV-20240709-668cce033b3c3',
                'payment_url' => 'https://checkout-staging.xendit.co/v2/668cce04f77de5fbaf34a638',
                'booking_status' => 'TRANSACTION COMPLETE',
                'payment_status' => 'PAID',
                'id_customer' => '6',
                'id_room' => '1',
            ],
        ]);

        DB::table('order_services')->insert([
            [
                'id_booking' => '1',
                'id_services' => '1',
            ],
            // 1
            [
                'id_booking' => '2',
                'id_services' => '1',
            ],
            [
                'id_booking' => '2',
                'id_services' => '2',
            ],
            //2
            [
                'id_booking' => '3',
                'id_services' => '1',
            ],
            [
                'id_booking' => '3',
                'id_services' => '2',
            ],
            [
                'id_booking' => '3',
                'id_services' => '3',
            ],
            [
                'id_booking' => '3',
                'id_services' => '4',
            ],
            //3
            [
                'id_booking' => '4',
                'id_services' => '1',
            ],
            [
                'id_booking' => '4',
                'id_services' => '2',
            ],
            [
                'id_booking' => '4',
                'id_services' => '3',
            ],
            [
                'id_booking' => '4',
                'id_services' => '4',
            ],
            //4
            [
                'id_booking' => '5',
                'id_services' => '4',
            ],
            //5
            [
                'id_booking' => '6',
                'id_services' => '3',
            ],
        ]);
        
        DB::table('feedback')->insert([
            [
                'id_booking' => '1',
                'rate' => '5',
                'title' => 'Pure Bliss',
                'message' => "The massage services at The Cajuput Spa are pure bliss! The therapist's skilled touch and the tranquil ambiance create an unparalleled relaxation experience. It's a sanctuary for rejuvenation I left feeling utterly refreshed. Highly recommended!",
                'created_at' => '2024-07-05 09:00:00',
                'updated_at' => '2024-07-05 09:00:00',
            ],
            [
                'id_booking' => '2',
                'rate' => '4',
                'title' => 'Great Feelings',
                'message' => 'The body treatment services are a true escape to serenity. The tailored approach and luxurious ambiance elevate the experience. From soothing wraps to invigorating scrubs, each session is a journey to relaxation and radiant well-being. A must-try for anyone seeking ultimate pampering!',
                'created_at' => '2024-07-13 09:00:00',
                'updated_at' => '2024-07-13 09:00:00',
            ],
            [
                'id_booking' => '3',
                'rate' => '5',
                'title' => 'Excellent Service',
                'message' => 'I had an excellent experience with the service. The staff was very friendly and professional. I would definitely recommend this place to my friends and family.',
                'created_at' => '2024-03-29 09:00:00',
                'updated_at' => '2024-03-29 09:00:00',
            ],
            [
                'id_booking' => '4',
                'rate' => '5',
                'title' => 'The Best Spa in Bali',
                'message' => "Every time I visit The Cajuput Spa, I'm blown away by the exceptional service and luxurious treatments. The staff is friendly and attentive, and the ambiance is serene and inviting. I always leave feeling relaxed, rejuvenated, and pampered. It's truly the best spa in Bali!",
                'created_at' => '2024-04-15 09:00:00',
                'updated_at' => '2024-04-15 09:00:00',
            ],
            [
                'id_booking' => '5',
                'rate' => '4',
                'title' => 'Great Service',
                'message' => "The manicure services at The Cajuput Spa are top-notch! The nail technicians are skilled and meticulous, ensuring that every detail is perfect. The wide selection of colors and designs is impressive, and the results are always stunning. I'm always thrilled with the outcome!",
                'created_at' => '2024-04-18 09:00:00',
                'updated_at' => '2024-04-18 09:00:00',
            ],
            [
                'id_booking' => '6',
                'rate' => '4',
                'title' => 'Awesome Works',
                'message' => "Hair Treatment services at The Cajuput Spa are exceptional! The stylists are talented and attentive, and the results are always fabulous. From cuts to colors, they offer a wide range of services that cater to every need. I always leave feeling like a new person!",
                'created_at' => '2024-03-21 09:00:00',
                'updated_at' => '2024-03-21 09:00:00',
            ],
        ]);
    }
}
