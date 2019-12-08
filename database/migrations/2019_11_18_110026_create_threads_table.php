<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); //Если нет регистрации, сюда записывается дефолтный анонимный юзер.
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->text('message');
            $table->string('theme',255)->nullable();
            $table->text('img')->nullable(); //array of imgs links
            $table->boolean('is_visible')->default(true);
            $table->text('Ip_hash');
            $table->boolean('is_pinned_up')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_cycled')->default(false);
            $table->boolean('is_edited')->default(false);
            $table->timestamps();
            $table->timestamp('bumped_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
