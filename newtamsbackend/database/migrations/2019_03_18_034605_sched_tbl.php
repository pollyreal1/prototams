<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchedTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('schedule_tbl', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('sched_id');
            $table->integer('sched_type');
            $table->string('shift_start');
            $table->string  ('shift_end');
            $table->integer('min_hrs');
            $table->integer('break_time');
            $table->integer('grace_period')->nullable();
            $table->boolean('late_monitor')->default(1);
            $table->string('status')->nullable();
            $table->string('days');
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
        //
        Schema::dropIfExists('schedule_tbl');

    }
}
