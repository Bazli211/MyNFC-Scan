<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_status', function (Blueprint $table) {
            $table->id('status_id');
            $table->string('fine_id');
            $table->string('student_matricNumber');
            $table->string('fine_details');
            $table->date('fine_date');
            $table->string('fine_status');
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
        Schema::dropIfExists('fine_status');
    }
}
