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
        Schema::create('author_game', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('author_id');
            $table->unsignedBiginteger('game_id');


            $table->foreign('author_id')->references('id')
                ->on('authors')->onDelete('cascade');
            $table->foreign('game_id')->references('id')
                 ->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_game');
    }
};
