<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('name');
            $table->integer('age');
            $table->decimal('weight', 8, 2);
            $table->decimal('height', 8, 2);
            $table->integer('gender');
            $table->decimal('bmi', 8, 2)->nullable();
            $table->decimal('body_fat_percentage', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}

