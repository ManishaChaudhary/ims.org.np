<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('party')->nullable();
            $table->integer('user_id');
            $table->date('in_date')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('weight')->nullable();
            $table->integer('company_id');
            $table->integer('godown_id');
            $table->longText('in_details')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('product_returns');
    }
}
