<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('prefix',5);
            $table->text('description');
            $table->boolean('is_visible')->default(true);
            $table->boolean('for_regs')->default(false);
            $table->integer('bumplimit')->default(500);
            $table->boolean('only_tor')->default(false);
            $table->integer('thread_limit_per_hour')->default(0); //If 0 - no limits
            $table->integer('picture_limit')->default(4);
            $table->string('default_user_name',255)->default('Anonymous');
            $table->string('slogan',255)->nullable();
            $table->timestamps(); //Сделать сообщение о дне рождении борды
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
