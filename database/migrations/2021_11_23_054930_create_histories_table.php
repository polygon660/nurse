<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_id')->nullable()->comment('รหัสผู้เข้าใช้');
            $table->string('symptom')->nullable()->comment('อาการป่วย');
            $table->integer('medical_id')->nullable()->comment('รหัสการปฐมพยาบาล');
            $table->integer('medicine_id')->nullable()->comment('รหัสยา');
            $table->string('note')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('histories');
    }
}
