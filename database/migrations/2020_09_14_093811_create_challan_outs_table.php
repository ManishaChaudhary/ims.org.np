<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallanOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challan_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('party')->nullable();
            $table->integer('user_id');
            $table->date('out_date')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->unsignedInteger('company_id');
            $table->longText('product_details')->nullable();
            $table->integer('godown_id');
            $table->string('weight')->nullable();
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
        Schema::dropIfExists('challan_outs');
    }
}
