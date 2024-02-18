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
        Schema::create('change_mains', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('change_id');
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('sponsor');
            $table->unsignedBigInteger('chargecode');
            $table->string('external_ref')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_mains');
    }
};
