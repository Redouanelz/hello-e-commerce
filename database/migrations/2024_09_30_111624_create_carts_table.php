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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // 'id' column
            $table->unsignedBigInteger('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
            $table->unsignedBigInteger('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products
            $table->integer('quantity'); // 'quantity' column
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
