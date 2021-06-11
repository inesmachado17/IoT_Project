<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmokeAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smoke_alarms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('value');
            $table->unsignedInteger('setting');
            $table->boolean('automatic')->default(false);
            $table->boolean('state')->default(false);
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
        Schema::dropIfExists('smoke_alarms');
    }
}
