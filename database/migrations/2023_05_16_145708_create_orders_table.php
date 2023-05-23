<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 60);
            $table->unsignedBigInteger('customer_id');
            $table->string('code')->unique()->comment('code-order');
            $table->string('email', 50);
            $table->string('phone', 20);
            $table->string('address', 200);
            $table->tinyInteger('payment-method')->default(1)->comment('1: Tại nhà, 2:Online');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: chờ xử lý, 2: Đang xử lý	, 3: Thành công');
            $table->string('totalCart', 20)->default(0)->comment('total money');
            $table->json('order_detail')->comment('detail buy');
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
