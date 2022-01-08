<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Reserve\Entities\Reserve;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flight_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('flight_id')->references('id')->on('flights');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date_reserved');
            $table->enum('status', [
                Reserve::RESERVED,
                Reserve::CANCELED,
                Reserve::PAID ,
                Reserve::CONCLUDED
            ]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
