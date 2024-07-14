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
        Schema::create('user_game', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('user_id');
            $table->unsignedBiginteger('game_id');


            $table->foreign('user_id')->references('id')
                 ->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')
                ->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game');
    }
};
