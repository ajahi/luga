<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title')->unique();
            $table->text('description');
            $table->char('slug');
            $table->decimal('purchase_price', 10, 2);
            $table->integer('user_id')->unsigned();
            $table->integer('quantity');
            $table->integer('position')->unsigned();
            $table->boolean('status');//draft/pubished
            $table->unsignedInteger('discount')->nullable();
            $table->decimal('sell_price',10,2);
            $table->boolean('featured')->nullable()->default(null);
            $table->boolean('offer')->nullable();
            $table->integer('counts')->unsigned()->default(0);
            $table->boolean('InStock')->default(1);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
