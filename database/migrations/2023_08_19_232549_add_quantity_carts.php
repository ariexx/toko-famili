<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(0)->after('product_uuid');
        });
    }

    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
