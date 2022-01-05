<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plane_id');
            $table->unsignedBigInteger('airport_origin_id');
            $table->unsignedBigInteger('airport_destination_id');
            $table->date('date');
            $table->time('time_duration');
            $table->time('hour_output');
            $table->time('arrival_time');
            $table->decimal('old_price', 19, 2);
            $table->decimal('price', 19, 2);
            $table->integer('total_prots');
            $table->boolean('is_promotion');
            $table->integer('qty_stops')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plane_id')->references('id')->on('planes');
            $table->foreign('airport_origin_id')->references('id')->on('airports');
            $table->foreign('airport_destination_id')->references('id')->on('airports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
