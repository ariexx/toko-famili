<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('order_uuid');
            $table->uuid('product_uuid');
            $table->integer('quantity');
            $table->integer('total');
            $table->enum('status', ['pending', 'in progress', 'delivered', 'failed']);
            $table->foreign('order_uuid')->references('uuid')->on('orders')->cascadeOnDelete();
            $table->foreign('product_uuid')->references('uuid')->on('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
