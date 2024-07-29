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
        Schema::table('games', function (Blueprint $table) {            
            $table->foreign('id')->references('game_id')
                ->on('game_os')->onDelete('cascade');

            $table->foreign('id')->references('game_id')
                ->on('game_tag')->onDelete('cascade');

            $table->foreign('id')->references('game_id')
                ->on('game_author')->onDelete('cascade');
                
            $table->foreign('id')->references('game_id')
                ->on('game_publisher')->onDelete('cascade');
                
            $table->foreign('id')->references('game_id')
                ->on('user_game')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id')->references('user_id')
                ->on('user_game')->onDelete('cascade');

            $table->foreign('id')->references('user_id')
                ->on('user_dls')->onDelete('cascade');

            $table->foreign('id')->references('user_id')
                ->on('user_mod')->onDelete('cascade');
        });

        Schema::table('d_l_s', function (Blueprint $table) {
            $table->foreign('id')->references('dls_id')
                ->on('user_dls')->onDelete('cascade');
        });

        Schema::table('mods', function (Blueprint $table) {
            $table->foreign('id')->references('mod_id')
                ->on('user_mod')->onDelete('cascade');
        });

        Schema::table('o_s', function (Blueprint $table) {
            $table->foreign('id')->references('os_id')
                ->on('game_os')->onDelete('cascade');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('id')->references('tag_id')
                ->on('game_tag')->onDelete('cascade');
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->foreign('id')->references('author_id')
                ->on('game_author')->onDelete('cascade');
        });

        Schema::table('publishers', function (Blueprint $table) {
            $table->foreign('id')->references('publisher_id')
                ->on('game_publisher')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
