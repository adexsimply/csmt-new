<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeatnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('neatnesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aagc_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->date('date');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('neatnesses');
    }
}
