<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid()->primary()->index();
            $table->string('category_uuid', '36');
            $table->string('name');
            $table->integer('price')->default(0);
            $table->text('description');
            $table->integer('quantity')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_uuid')->references('uuid')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
