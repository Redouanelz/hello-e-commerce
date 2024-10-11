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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // 'id' column
            $table->unsignedBigInteger('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
            $table->decimal('total_amount', 10, 2); // 'total_amount' column
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending'); // 'status' column
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
