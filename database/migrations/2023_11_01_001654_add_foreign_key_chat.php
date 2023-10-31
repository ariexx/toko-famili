<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            //create from user_uuid and to user_uuid foreign key
            $table->uuid('from_user_uuid')->nullable()->after('uuid');
            $table->uuid('to_user_uuid')->nullable()->after('from_user_uuid');
            $table->foreign('from_user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            $table->foreign('to_user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            //remove user_uuid foreign key
            $table->dropForeign('chats_user_uuid_foreign');
            $table->dropColumn('user_uuid');
        });
    }

    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            //create user_uuid foreign key
            $table->uuid('user_uuid')->nullable()->change();
            $table->foreign('user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            //remove from user_uuid and to user_uuid foreign key
            $table->dropForeign('chats_from_user_uuid_foreign');
            $table->dropForeign('chats_to_user_uuid_foreign');
            $table->dropColumn('from_user_uuid');
            $table->dropColumn('to_user_uuid');
        });
    }
};
