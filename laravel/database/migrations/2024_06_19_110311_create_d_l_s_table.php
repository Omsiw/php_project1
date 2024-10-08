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
        Schema::create('d_l_s', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->string('name');
            $table->string('info');
            $table->string('image_path')->nullable(true);
            $table->integer('cost');
            $table->dateTime('date_add');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_l_s');
    }
};
