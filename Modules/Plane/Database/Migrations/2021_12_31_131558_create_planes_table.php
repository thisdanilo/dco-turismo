<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Plane\Entities\Plane;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id();
            $table->integer('total_passengers');
            $table->unsignedBigInteger('bland_id');
            $table->enum('class', [Plane::ECONOMIC, Plane::LUXURY]);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bland_id')->references('id')->on('blands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
}
