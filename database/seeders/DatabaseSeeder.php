<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Translator',
        ]);
        DB::table('categories')->insert([
            'name' => 'Designer',
        ]);
        DB::table('categories')->insert([
            'name' => 'Photographer',
        ]);
        DB::table('categories')->insert([
            'name' => 'Programming',
        ]);
    }
}
