<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name'=>'Html',
            'slug'=>'html',
        ]);
        Category::create([
            'name'=>'CSS',
            'slug'=>'css',
        ]);
        Category::create([
            'name'=>'JS',
            'slug'=>'js',
        ]);
    }
}
