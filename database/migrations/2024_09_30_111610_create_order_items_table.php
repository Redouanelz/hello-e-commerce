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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // 'id' column
            $table->unsignedBigInteger('order_id')->constrained('orders')->onDelete('cascade'); // Foreign key to orders
            $table->unsignedBigInteger('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->integer('quantity'); // 'quantity' column
            $table->decimal('price', 10, 2); // 'price' column (product price at the time of the order)
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
