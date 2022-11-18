<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 255);
            $table->string('codigo')->unique();
            $table->string('password', 255);
            $table->string('correo', 255)->nullable();
            $table->string('tipo');
            $table->string('foto', 255)->nullable();
            $table->unsignedBigInteger('sucursal_id');
            $table->date('fecha_registro');
            $table->timestamps();
            
            $table->foreign("sucursal_id")->on("sucursals")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
