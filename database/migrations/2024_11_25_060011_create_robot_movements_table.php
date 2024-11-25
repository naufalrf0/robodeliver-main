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
        Schema::create('robot_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('robot_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('current_location');
            $table->string('next_location');
            $table->timestamp('arrival_time')->nullable();
            $table->timestamp('actual_arrival_time')->nullable();
            $table->enum('movement_status', ['moving', 'arrived'])->default('moving');
            $table->json('path_history')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_movements');
    }
};
