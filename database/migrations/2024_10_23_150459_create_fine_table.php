<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine', function (Blueprint $table) {
            $table->id('fine_id');
            $table->string('student_matricNum');
            $table->string('sticker_id');
            $table->date('fine_date');
            $table->string('location');
            $table->time('fine_time');
            $table->string('comment');
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
        Schema::dropIfExists('fine');
    }
}
