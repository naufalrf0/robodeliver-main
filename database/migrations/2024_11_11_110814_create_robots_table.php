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
        Schema::create('robots', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['available', 'busy', 'charging'])->default('available')->index();
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots');
    }
};
