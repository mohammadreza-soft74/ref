<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSabadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sabads', function (Blueprint $table) {
            $table->id();
            $table->integer('basketcount');
            $table->integer('obasketcount');
            $table->boolean('returned')->default(0);

            $table->string('driver')->nullable();

            $table->unsignedBigInteger('basket_contract_id');
            $table->foreign('basket_contract_id')
                ->references('id')
                ->on('basketcontracts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('sabads');
    }
}
