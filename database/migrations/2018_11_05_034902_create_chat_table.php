<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_chat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_feasibility')->unsigned();
            $table->string('pengirim');
            $table->enum('user',['inputor','produksi','kemas']);
            $table->string('subject',225);
            $table->text('message')->nullable();;
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
        Schema::dropIfExists('fs_chat');
    }
}
