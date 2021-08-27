<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Agua','Eléctrico','Tierra','Roca','Fuego','Sinistro','Bicho',
            'Dragón','Fantasma','Veneno','Volador','Hielo','Normal','Hierva',
            'Lucha','Psiquico'
        ];

        for ($i=0; $i < count($types); $i++) { 
            Type::create([
                'name' => $types[$i],
            ]);
        }
    }
}
