<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); //Если нет регистрации, сюда записывается дефолтный анонимный юзер.
            $table->unsignedBigInteger('thread_id');
            $table->foreign('thread_id')->references('id')->on('threads');
            $table->text('message');
            $table->text('img')->nullable(); //array of imgs links
            $table->boolean('is_visible')->default(true);
            $table->string('theme',255)->nullable();
            $table->text('mod_notice')->nullable()->default(null); //Сообщение мода после модерации сообщения.
            $table->boolean('is_edited')->default(false);
            $table->boolean('is_sage')->default(false);
            $table->text('Ip_hash');
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
        Schema::dropIfExists('posts');
    }
}
