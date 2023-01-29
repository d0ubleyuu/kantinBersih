<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ayam = new Ingredient();
        $ayam->name = 'Ayam';
        $ayam->stock = 10;
        $ayam->capital_price = 43000;
        $ayam->measurement_id = 1;
        $ayam->save();

        $susu = new Ingredient();
        $susu->name = 'Susu';
        $susu->stock = 15;
        $susu->capital_price = 18000;
        $susu->measurement_id = 3;
        $susu->save();
    }
}