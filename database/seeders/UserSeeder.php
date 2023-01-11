<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Luis Fax',
            'phone' => '77776453',
            'email' => 'luisfax@gmail.com',
            'profile' => 'ADMIN',
            'status' => 'ACTIVE',
            'password' => bcrypt('123')
        ]);
        User::create([
            'name' => 'Alvaro Muruchi',
            'phone' => '77759157',
            'email' => 'alvaro@gmail.com',
            'profile' => 'ADMIN',
            'status' => 'ACTIVE',
            'password' => 'alvaro123'
        ]);
    }
}
