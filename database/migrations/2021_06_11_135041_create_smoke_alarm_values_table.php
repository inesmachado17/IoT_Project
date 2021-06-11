<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmokeAlarmValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smoke_alarm_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('setting');
            $table->boolean('state');
            $table->timestamps();

            $table->foreignId('smoke_alarm_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smoke_alarm_values');
    }
}
