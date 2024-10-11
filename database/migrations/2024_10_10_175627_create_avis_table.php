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
  
        Schema::create('avis', function (Blueprint $table) {
            $table->id();  // Creates the 'id' column
            $table->text('description');  // Creates the 'description' column
            $table->integer('note');  // Creates the 'note' column
            $table->timestamps();  // Adds 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
