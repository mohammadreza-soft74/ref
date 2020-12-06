<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basketcontracts', function (Blueprint $table) {
            $table->id();
            $table->integer('basketcount');
            $table->integer('obasketcount');
            $table->string('driver')->nullable();
            $table->integer('currencyPerBasket');

            $table->unsignedBigInteger('basket_id')->nullable();
            $table->foreign('basket_id')
                ->references('id')
                ->on('baskets')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('credit')->default(0);
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
        Schema::dropIfExists('basketcontracts');
    }
}
