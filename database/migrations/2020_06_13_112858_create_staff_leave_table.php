<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_leave', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->decimal('AL', 3, 1)->default(0);
            $table->decimal('MC', 3, 1)->default(0);
            $table->decimal('EL', 3, 1)->default(0);
            $table->decimal('UP', 3, 1)->default(0);
            $table->decimal('CL', 3, 1)->default(0);
            $table->decimal('MP', 3, 1)->default(0);
            $table->decimal('X', 3, 1)->default(0);
            $table->decimal('leave', 3, 1)->default(0);
            $table->string('year', 4)->nullable();
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
        Schema::dropIfExists('staff_leave');
    }
}
