<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->foreignUuid('user_uuid')->references('uuid')->on('users')->cascadeOnDelete();
            $table->foreignUuid('product_uuid')->references('uuid')->on('products')->cascadeOnDelete();
            $table->integer('quantity');
            $table->integer('total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
