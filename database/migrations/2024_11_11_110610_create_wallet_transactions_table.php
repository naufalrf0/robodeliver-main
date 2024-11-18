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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_wallet_id')->constrained('user_wallets')->onDelete('cascade');
            $table->enum('transaction_type', ['top-up', 'payment', 'refund']);
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_status', ['success', 'pending', 'failed']);
            $table->string('reference')->index();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
