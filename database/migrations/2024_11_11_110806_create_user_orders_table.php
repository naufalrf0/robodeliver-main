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
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->foreignId('delivery_address_id')->constrained('delivery_addresses')->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('order_status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending')->index();
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid')->index();
            $table->boolean('is_unlocked')->default(false);
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();
            $table->softDeletes();
            $table->index(['user_id', 'order_status']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_orders');
    }
};
