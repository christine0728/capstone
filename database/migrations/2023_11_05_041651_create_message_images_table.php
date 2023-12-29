<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->string('image_path')->nullable()->default('default.png');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_images');
    }
};
