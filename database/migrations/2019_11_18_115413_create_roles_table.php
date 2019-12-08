<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->default('User');//Admin, Mod раздела, GlobalMod, User, Anon
            $table->string('sign',100)->nullable()->default(null);//плашка мода или админа.
            $table->string('board_prefix',10)->nullable()->default(null);//Если null, то это Админ или Глобал
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
        Schema::dropIfExists('roles');
    }
}
