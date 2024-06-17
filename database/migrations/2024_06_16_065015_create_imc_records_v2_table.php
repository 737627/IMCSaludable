<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImcRecordsV2Table extends Migration
{
    public function up()
    {
        Schema::create('imc_records_v2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->float('weight');
            $table->float('height');
            $table->float('bmi');
            $table->float('body_fat_percentage');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imc_records_v2');
    }
}
