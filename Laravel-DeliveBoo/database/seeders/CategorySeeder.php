<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // disabilito relazioni
        Schema::disableForeignKeyConstraints();

        // truncate
        Category::truncate();

        // categorie di ristoranti
        $categories = [
            'Pizza',
            'Burgers',
            'Sushi',
            'Chinese',
            'Vegetarian',
            'Desserts',

        ];

        // numero campi
        $numRecords = 20;

        // ciclo per popolare tabella categories
        for ($i = 0; $i < $numRecords; $i++) {
            $new_category = new Category();

            $new_category->name = $categories[$i];
            $new_category->slug = Str::of($new_category->name)->slug();

            $new_category->save();
        }

        // riabilito relazioni
        Schema::enableForeignKeyConstraints();
    }
}
