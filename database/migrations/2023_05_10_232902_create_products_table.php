<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name', 50);
            $table->string('code')->unique();
            $table->string('slug', 200)->unique();
            $table->unsignedBigInteger('category_product_id');
            $table->bigInteger('price');
            $table->float('sale_price', 9, 2)->nullable()->default(0);
            $table->text('desc');
            $table->text('images');
            $table->text('detail');
            $table->tinyInteger('featured_products')->comment('1: sp nổi bật, 2: là không')->default(2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');
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
