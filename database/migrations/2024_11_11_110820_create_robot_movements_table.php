<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('robot_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('robot_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained('user_orders')->onDelete('cascade');
            $table->string('current_location');
            $table->string('next_location');
            $table->enum('movement_status', ['moving', 'arrived'])->default('moving')->index();
            $table->timestampTz('estimated_arrival')->index();
            $table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_movements');
    }
};
