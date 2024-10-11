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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // 'id' column
            $table->unsignedBigInteger('order_id')->constrained('orders')->onDelete('cascade'); // Foreign key to orders
            $table->enum('payment_method', ['credit_card', 'paypal', 'stripe']); // 'payment_method' column
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending'); // 'payment_status' column
            $table->string('transaction_id')->nullable(); // 'transaction_id' column (for payment reference)
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
