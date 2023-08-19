<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('user_uuid')->references('uuid')->on('users')->cascadeOnDelete();
            $table->foreignUuid('product_uuid')->references('uuid')->on('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
