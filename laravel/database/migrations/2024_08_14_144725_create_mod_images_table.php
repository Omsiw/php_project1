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
        Schema::create('mod_images', function (Blueprint $table) {
            $table->id();
            $table->integer('mod_id');
            $table->string('image_path');
            $table->timestamps();
            
            $table->foreign('mod_id')->references('id')
                ->on('mods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_images');
    }
};
