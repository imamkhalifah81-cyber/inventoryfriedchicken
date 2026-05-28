<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

        public function run()
        {
            Category::create(['name_kategori' => 'Makanan']);
            Category::create(['name_kategori' => 'Minuman']);
            Category::create(['name_kategori' => 'Snack']);
            Category::create(['name_kategori' => 'Daging']);
            Category::create(['name_kategori' => 'Bumbu']);
            Category::create(['name_kategori' => 'Sayuran']);
        }
}