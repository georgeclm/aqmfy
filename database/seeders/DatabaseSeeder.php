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
        DB::table('services')->insert([
            'name' => 'I will create your website',
            'category_id' => '3',
            'price' => '100000',
            'description' => 'I will create your website using laravel and react trust me it works',
            'delivery_time' => '3',
            'revision_time' => '5',
            'image' => 'Q9mKsJMGTeRbYwJiHxzT86lN4rZ5tTvjXdEeOLvp.jpg'
        ]);
    }
}
