<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'phone' => '12341234',
            ],[
            'f_name' => 'ESMH',
            'l_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' =>   Hash::make('12345678')
        ]);
    }
}
