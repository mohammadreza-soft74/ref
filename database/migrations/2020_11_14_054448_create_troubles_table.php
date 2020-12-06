<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTroublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troubles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('troubleables', function (Blueprint $table) {

            $table->id();

            $table->integer('trouble_id');
//            $table->foreign('trouble_id')
//                ->references('id')
//                ->on('troubles')
//                ->onDelete('cascade')
//                ->onDelete('cascade');

            $table->integer('troubleable_id');
//            $table->foreign('troubleable_id')
//                ->references('id')
//                ->on('bcontracts')
//                ->onDelete('cascade')
//                ->onDelete('cascade');

            $table->string('troubleable_type');


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
        Schema::dropIfExists('troubles');
    }
}
