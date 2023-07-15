<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->string('uuid')->primary()->index();
            $table->string('user_uuid');
            $table->text('street_detail');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_uuid')->references('uuid')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
