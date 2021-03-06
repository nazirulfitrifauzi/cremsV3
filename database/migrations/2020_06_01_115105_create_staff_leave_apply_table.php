<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLeaveApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_leave_apply', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('reason');
            $table->string('type');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('days', 3, 1);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('staff_leave_apply');
    }
}
