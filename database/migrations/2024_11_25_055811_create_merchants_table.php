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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('address')->nullable();
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'active', 'inactive', 'rejected'])->default('pending');
            $table->text('approval_reason')->nullable();
            $table->float('rating')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
