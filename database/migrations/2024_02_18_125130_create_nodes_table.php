<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('domain')->nullable();
            $table->string('serialnumber')->nullable();
            $table->string('uuid')->nullable();
            $table->string('machineid')->nullable();
            $table->date('aquire_date')->nullable();
            $table->date('eol_date')->nullable();
            $table->unsignedBigInteger('supportcontract')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('last_checkin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
