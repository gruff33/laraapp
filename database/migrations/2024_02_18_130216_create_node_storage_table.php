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
        Schema::create('node_storage', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('node_id');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('mount_id');
            $table->dateTime('last_seen_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_storage');
    }
};
