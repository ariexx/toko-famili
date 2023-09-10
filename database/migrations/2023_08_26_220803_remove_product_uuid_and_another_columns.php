<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //drop foreign key
            $table->dropForeign(['product_uuid']);
            $table->dropColumn('product_uuid');
            $table->dropColumn('total');
            $table->dropColumn('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->uuid('product_uuid');
            $table->integer('total');
            $table->integer('quantity');
        });
    }
};
