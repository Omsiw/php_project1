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
        Schema::create('game_author', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('game_id');
            $table->unsignedBiginteger('author_id');


            $table->foreign('game_id')->references('id')
                 ->on('games')->onDelete('cascade');
            $table->foreign('author_id')->references('id')
                ->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_author');
    }
};
