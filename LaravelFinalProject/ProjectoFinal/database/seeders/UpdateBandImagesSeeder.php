<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateBandImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('bands')->whereNull('image')->update([
            'image' => DB::raw("CONCAT(LOWER(REPLACE(REPLACE(REPLACE(name, '/', '_'), ' ', '_'), ',', '')), '.jpg')")
        ]);
    }
}
