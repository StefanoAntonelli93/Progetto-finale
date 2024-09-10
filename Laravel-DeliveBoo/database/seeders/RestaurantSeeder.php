<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Restaurant::truncate();

        // popolo i campi senza faker ma con array 
        // 100 phone_number
        $phone_numbers = [
            '06 9940123',
            '06 9940126',
            '06 9940127',
            '06 9940128',
            '06 9940129',
            '06 9940125',
            '06 9940124',
            '06 9940122',
            '06 9940121',
            '06 9940120',
            '06 8940123',


        ];

        // 100 restaurant_name 
        $restaurant_names = [
            'Crispy Parlor',
            'Charming Parlor',
            'Royal Diner',
            'Hearty Kitchen',
            'Lucky Palace',
            'Fresh Corner',
            'Secret Oven',
            'Fresh Diner',
            'Sunny Cantina',
            'Golden Cantina',


        ];
        // img restaurant
        $images = ['https://pixabay.com/photos/cafe-tables-and-chairs-bistro-5579069/', 'https://unsplash.com/it/foto/ristorante-vuoto-Yx-lrVk1ZHY', 'https://unsplash.com/it/foto/sgabelli-e-tavolo-da-bar-in-legno-marrone-nx05CDCrfzM', 'https://unsplash.com/it/foto/un-tablet-e-tazze-di-caffe-su-un-tavolo-p7UtCeog33Q', 'https://unsplash.com/it/foto/una-persona-seduta-a-un-tavolo-con-un-piatto-di-cibo-6vfYbDwOuMo'];
        // description
        $descriptions = ['Ambiente accogliente con piatti italiani tradizionali, ingredienti freschi e vini locali.', 'Cucina moderna con vista sul giardino, atmosfera elegante e tranquilla.', 'Specialità di carne alla griglia in un contesto rustico e familiare.', 'Piccolo ristorante con tapas creative e una selezione di vini regionali.', 'Perfetto per brunch e dessert, con ampie vetrate che danno sulla città.'];
        // address
        $addresses = [
            'Via Roma',
            'Piazza Garibaldi',
            'Corso Umberto I',
            'Via XX Settembre',
            'Via della Libertà',
            'Via Leopardi',
            'Via Mazzini',
            'Via Trieste',
            'Viale delle Belle Arti',
            'Via Verdi',

        ];
        // p iva
        $p_iva = [
            '37892046501938475629',
            '37892046501938475628',
            '37892046501938475627',
            '37892046501938475626',
            '37892046501938475625',
            '37892046501938475624',
            '37892046501938475623',
            '37892046501938475622',
            '37892046501938475621',
            '37892046501938475620',
            '35892046501938475628',


        ];
        $numRecords = 10;

        for ($i = 0; $i < $numRecords; $i++) {
            $new_restaurant = new Restaurant();
            $new_restaurant->phone_number = $phone_numbers[$i % count($phone_numbers)];
            $new_restaurant->restaurant_name = $restaurant_names[$i % count($restaurant_names)];
            $new_restaurant->img = $images[$i % count($images)];
            $new_restaurant->description = $descriptions[$i % count($descriptions)];
            $new_restaurant->address = $addresses[$i % count($addresses)];
            $new_restaurant->p_iva = $p_iva[$i % count($p_iva)];
            $new_restaurant->save();
        }

        Schema::enableForeignKeyConstraints();
    }
}
