<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateSubCategoriesValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'IRL',
                'description' => 'Buscando eventos no mundo real? O lugar é aqui!',
            ],
            [
                'name' => 'PC',
                'description' => 'Competições para aqueles que são do time \'PC Master Race!\'',
            ],
            [
                'name' => 'PlayStation',
                'description' => 'Aqui você encontrará competições específicas para jogos de PlayStation!',
            ],
            [
                'name' => 'Xbox',
                'description' => 'Aqui você encontrará competições específicas para jogos de Xbox!',
            ],
        ];

        DB::table('subcategories')->insert($data);
    }
}
