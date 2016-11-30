<?php

use Illuminate\Database\Seeder;
use sisestar\Logradouro;
use Faker\Factory as Faker;

class LogradourosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logradouros')->truncate();
        $faker = Faker::create();
        $tipos = ['Rua', 'Praça', 'Avenida', 'Alameda', 'Travessa'];
        foreach (range(1, 250) as $i){
            Logradouro::create([
               'tipo' => $tipos[rand(0, 4)] ,
                'nome' => $faker->streetName
            ]);
        }
        
    }
}
