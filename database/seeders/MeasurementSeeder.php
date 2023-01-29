<?php

namespace Database\Seeders;

use App\Models\Measurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kg = new Measurement();
        $kg->long_name = 'Kilogram';
        $kg->short_name = 'Kg';
        $kg->save();

        $g = new Measurement();
        $g->long_name = 'Gram';
        $g->short_name = 'G';
        $g->save();

        $l = new Measurement();
        $l->long_name = 'Liter';
        $l->short_name = 'L';
        $l->save();

        $ml = new Measurement();
        $ml->long_name = 'Mililiter';
        $ml->short_name = 'Ml';
        $ml->save();
    }
}