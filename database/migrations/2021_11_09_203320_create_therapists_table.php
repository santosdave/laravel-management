<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapists', function (Blueprint $table) {
            $table->bigIncrements('ther_id');
            $table->string('ther_name', 110);
            $table->string('ther_phone', 45);
            $table->string('ther_address', 110);
            $table->string('ther_email', 110);
            $table->string('ther_password', 110);
            $table->string('ther_profile', 110);
            $table->string('ther_img', 110);
            $table->unsignedBigInteger('ther_dept_id');
            $table->foreign('ther_dept_id')->references('dept_id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('therapists');
    }
}
