<?php

use Illuminate\Database\Seeder;
use sisestar\Login;
use sisestar\Funcionario;

class MasterSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('funcionarios')->truncate();
        $a = rand(1, 20);
        $foto = "$a.jpg";
        Funcionario::create([
            'id_cargo' => 3,
            'visible' => true,
            'nome' => 'master',
            'sobrenome' => 'master',
            'cpf' => 'master',
            'foto' => $foto,
            'matricula' => 'master',
            'data_nasc' => rand(1, 31) . "/" . rand(1, 12) . "/" . rand(1975, 2000)
        ]);

        $senha = sha1(1 . 'master');


        DB::table('logins')->truncate();
        Login::create([
            'func' => 1,
            'login' => 'master',
            'senha' => $senha
        ]);
    }

}
