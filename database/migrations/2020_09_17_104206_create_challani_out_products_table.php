<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallaniOutProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challani_out_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('challani_out_id');
            $table->integer('product_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('product_batch_id');
            $table->string('quantity')->nullable();
            $table->string('alt_quantity')->nullable();
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
        Schema::dropIfExists('challani_out_products');
    }
}
