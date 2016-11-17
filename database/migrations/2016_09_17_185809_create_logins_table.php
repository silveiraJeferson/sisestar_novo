<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function($table){
            $table->increments('id');
            $table->string('func');
            $table->string('login', 20);
            $table->string('senha', 100);
            
            
            //$table->unsignedInteger('id_funcionario');
            //$table->foreign('id_funcionario')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('logins');
    }
}
