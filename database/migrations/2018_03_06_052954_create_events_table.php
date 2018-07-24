<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid')->unsigned()->index();
            $table->timestamps();
            $table->string('eventname');
            $table->text('eventdetail');
            $table->date('eventdate');
            $table->string('eventstate');
            $table->string('eventcity');
            $table->string('eventdistrict');
            $table->string('eventaddress');
            $table->string('eventstatus');
            $table->float('ratings')->nullable();
            $table->mediumInteger('registrationlimit')->nullable();
            $table->string('interest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
