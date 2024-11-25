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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('label', 100);
            $table->string('street');
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('postal_code', 20)->nullable();
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
