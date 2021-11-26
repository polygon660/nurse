<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_type_id')->nullable()->comment('รหัสประเภทผู้เข้าใช้งาน');
            $table->string('code')->nullable()->comment('รหัสประจำตัว');
            $table->integer('prefix_id')->nullable()->comment('รหัสคำนำหน้าชื่อ');
            $table->string('name')->nullable()->comment('ชื่อจริง');
            $table->string('surname')->nullable()->comment('นามสกุล');
            $table->integer('gender_id')->nullable()->comment('รหัสเพศ');
            $table->integer('room_id')->nullable()->comment('รหัสห้อง');
            $table->integer('level_id')->nullable()->comment('รหัสระดับชั้น');
            $table->integer('program_id')->nullable()->comment('รหัสสาขา');
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
        Schema::dropIfExists('guests');
    }
}
