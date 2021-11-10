<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_expenses', function (Blueprint $table) {
            $table->bigIncrements('c_exp_id');
            $table->unsignedBigInteger('c_service_id');
            $table->timestamps();
            $table->foreign('c_service_id')
                ->references('service_id')->on('services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_expenses');
    }
}
