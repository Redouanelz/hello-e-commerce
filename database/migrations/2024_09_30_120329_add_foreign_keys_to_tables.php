<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        // Adding foreign key to the products table
        Schema::table('products', function (Blueprint $table) {
            // Add category_id column
            //$table->unsignedBigInteger('category_id')->after('image_url');
            // Add foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Adding foreign key to the orders table
        Schema::table('orders', function (Blueprint $table) {
            // Add user_id column
            //$table->unsignedBigInteger('user_id')->after('total_amount');
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Adding foreign key to the order_items table
        Schema::table('order_items', function (Blueprint $table) {
            // Add product_id column
            // $table->unsignedBigInteger('product_id')->after('order_id');
            // Add foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop foreign key and column for products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop foreign key constraint
            $table->dropColumn('category_id'); // Drop the column
        });

        // Drop foreign key and column for orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key constraint
            $table->dropColumn('user_id'); // Drop the column
        });

        // Drop foreign key and column for order_items table
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']); // Drop foreign key constraint
            $table->dropColumn('product_id'); // Drop the column
        });
    }
};
