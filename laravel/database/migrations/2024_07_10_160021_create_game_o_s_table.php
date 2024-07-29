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
        Schema::create('game_o_s', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('game_id');
            $table->unsignedBiginteger('o_s_id');


            $table->foreign('game_id')->references('id')
                 ->on('games')->onDelete('cascade');
            $table->foreign('o_s_id')->references('id')
                ->on('o_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_os');
    }
};
