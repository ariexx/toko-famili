<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('user_uuid');
            $table->text('message');
            $table->foreign('user_uuid')->references('uuid')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
