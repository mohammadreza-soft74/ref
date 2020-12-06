<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_contract_id');
            $table->foreign('service_contract_id')
                ->references('id')
                ->on('service_contracts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->integer('unitPrice')->default(0);
            $table->integer('amount')->default(0);

            $table->string('driver');

            $table->boolean('returned')->default(0);


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
        Schema::dropIfExists('services');
    }
}
