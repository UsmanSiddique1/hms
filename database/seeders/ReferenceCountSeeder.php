<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferenceCount;

class ReferenceCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferenceCount::firstOrCreate([
            'type' => 'mr',

        ],[
            'count' => 0
        ]);
    }
}
