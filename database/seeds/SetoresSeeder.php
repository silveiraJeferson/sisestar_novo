<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use sisestar\Setor;
use sisestar\Logradouro;
use Faker\Factory as Faker;

class SetoresSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('setors')->truncate();
        $logradouros = DB::table('logradouros')->get();
        $faker = Faker::create();
        $cont = 0;
        $setor = 1;
        $j = 0;
        foreach (range(1, 50) as $i) {
           
            Setor::create([
                'numero' => $i,
                'regiao' => rand(1, 5),
                'referencia' => $faker->streetName,
                'ativo' => rand(0, 1)
            ]);
            $cont++;
            if ($cont == 5) {
                $setor++;
                $cont = 0;
                $j++;
                if($j == 5){
                    $j = 0;
                }
                
            }
        }
    }

}
