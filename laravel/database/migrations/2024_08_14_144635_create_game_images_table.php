<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_images', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('game_id')->references('id')
                ->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_images');
    }
};
