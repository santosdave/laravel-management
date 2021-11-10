<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('c_id');
            $table->string('c_s', 30);
            $table->string('c_name', 110);
            $table->string('c_sex', 15);
            $table->integer('c_age');
            $table->string('c_phone', 30);
            $table->string('c_address', 110);
            $table->string('c_reference', 60);
            $table->unsignedBigInteger('c_ther_id');
            $table->unsignedBigInteger('c_room_category_id');
            $table->unsignedBigInteger('c_room_id');
            $table->string('c_note', 220);
            $table->foreign('c_ther_id')
                ->references('ther_id')->on('therapists')
                ->onDelete('cascade');
            $table->foreign('c_room_category_id')
                ->references('room_category_id')->on('room_categories')
                ->onDelete('cascade');
            $table->foreign('c_room_id')
                ->references('room_id')->on('rooms')
                ->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
