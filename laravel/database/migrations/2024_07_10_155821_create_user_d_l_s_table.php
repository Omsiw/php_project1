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
        Schema::create('user_d_l_s', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBiginteger('user_id');
            $table->unsignedBiginteger('d_l_s_id');


            $table->foreign('user_id')->references('id')
                 ->on('users')->onDelete('cascade');
            $table->foreign('d_l_s_id')->references('id')
                ->on('d_l_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dls');
    }
};
