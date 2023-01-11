<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'PIGMENTO DYNAMIC',
            'cost' => 380,
            'price' => 450,
            'barcode' => '34567654781',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'pigmento.png'
        ]);
        Product::create([
            'name' => 'CARTUCHOS SPARK',
            'cost' => 80,
            'price' => 155,
            'barcode' => '44567654781',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'cartucho.png'
        ]);
        Product::create([
            'name' => 'BLACK BIRD NEEDLE',
            'cost' => 90,
            'price' => 110,
            'barcode' => '54567654781',
            'stock' => 100,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'varilla.png'
        ]);
        Product::create([
            'name' => 'MAQUINA PEN TATTOO',
            'cost' => 250,
            'price' => 330,
            'barcode' => '64567654781',
            'stock' => 10,
            'alerts' => 1,
            'category_id' => 4,
            'image' => 'maquina.png'
        ]);
    }
}
