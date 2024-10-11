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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // 'id' column
            $table->string('name'); // 'name' column
            $table->text('description')->nullable(); // 'description' column
            $table->decimal('price', 10, 2); // 'price' column, with 2 decimal places
            $table->integer('stock'); // 'stock' column for available quantity
            $table->string('image_url')->nullable(); // 'image_url' column
            $table->unsignedBigInteger('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key to categories
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
