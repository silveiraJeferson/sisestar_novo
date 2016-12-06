<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
        //-----------------------------dispensavel---------
        $this->call('FuncionariosSeeder');
        $this->call('NotificacaoSeeder');
        //--------------------------------------
        $this->call('IrregularidadesSeeder');
        $this->call('CargosSeeder');
        $this->call('Status_notificacaosSeeder');
        $this->call('MasterSeeder');
        $this->call('LogradourosSeeder');
        $this->call('SetoresSeeder');
        $this->call('Logradouro_setorSeeder');
        $this->call('RegiaoSeeder');
        //---------------------------dispensavel
        //$this->call('LogonSeeder');
    }

}
