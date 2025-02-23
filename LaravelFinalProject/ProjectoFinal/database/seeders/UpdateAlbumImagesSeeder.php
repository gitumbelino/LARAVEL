<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateAlbumImagesSeeder extends Seeder
{
    public function run()
    {
        DB::table('albums')->whereNull('image')->update([
            'image' => DB::raw("CONCAT(LOWER(REPLACE(REPLACE(REPLACE(name, '/', '_'), ' ', '_'), ',', '')), '.jpg')")
        ]);
    }
}
