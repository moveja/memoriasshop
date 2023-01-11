<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'AGUJAS',
            'image' => 'https://dummyimage.com/200x150/b714cc/fff'
        ]);
        Category::create([
            'name' => 'PIGMENTOS',
            'image' => 'https://dummyimage.com/200x150/b714cc/fff'
        ]);
        Category::create([
            'name' => 'MAQUINAS',
            'image' => 'https://dummyimage.com/200x150/b714cc/fff'
        ]);
        Category::create([
            'name' => 'PIELES',
            'image' => 'https://dummyimage.com/200x150/b714cc/fff'
        ]);
        Category::create([
            'name' => 'FUENTES',
            'image' => 'https://dummyimage.com/200x150/b714cc/fff'
        ]);
    }
}
