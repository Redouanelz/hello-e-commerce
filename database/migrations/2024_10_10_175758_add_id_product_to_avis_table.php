<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('avis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_product');  // Add the id_product column
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            // Adjust 'products' to your actual products table name
        });
    }
    
    public function down()
    {
        Schema::table('avis', function (Blueprint $table) {
            $table->dropForeign(['id_product']);  // Drop the foreign key
            $table->dropColumn('id_product');  // Drop the id_product column
        });
    }
};
