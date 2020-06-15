<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_claim', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->decimal('CLM', 18, 2)->default(0.00);
            $table->decimal('CLO', 18, 2)->default(0.00);
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
        Schema::dropIfExists('staff_claim');
    }
}
