<?php

use Illuminate\Database\Seeder;
use sisestar\Regiao;

class RegiaoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $regiao = ['Centro', 'Nova Russia', 'Uvaranas', 'Oficinas', 'Jardim Carvalho'];
        DB::table('regiaos')->truncate();

        for ($i = 0; $i < 5; $i++) {
            Regiao::create([
            'regiao' => $regiao[$i],
            'ativo' => true
            ]);
        }


    }

}
