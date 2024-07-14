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
        Schema::create('game_publisher', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('game_id');
            $table->unsignedBiginteger('publisher_id');


            $table->foreign('game_id')->references('id')
                 ->on('games')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')
                ->on('publishers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_publisher');
    }
};
