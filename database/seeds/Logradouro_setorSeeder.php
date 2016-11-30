<?php

use Illuminate\Database\Seeder;
use sisestar\Logradouro_setor;

class Logradouro_setorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('logradouro_setors')->truncate();
        $setor = 1;
        $cont = 0;
        foreach (range(1, 250) as $i) {
            Logradouro_setor::create([
                'id_logradouro' => $i,
                'id_setor' => $setor
            ]);
            $cont++;
            if($cont == 5){
                $setor++;
                $cont = 0;
            }
        }
    }

}
