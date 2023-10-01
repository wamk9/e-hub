<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateCategoriesValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kart',
                'subcategory_id' => 1,
            ],
            [
                'name' => 'Assetto Corsa: Competizione',
                'subcategory_id' => 2,
            ],
            [
                'name' => 'F1 2023',
                'subcategory_id' => 3,
            ],
            [
                'name' => 'Forza Motorsport',
                'subcategory_id' => 4,
            ]
        ];

        DB::table('categories')->insert($data);

    }
}
