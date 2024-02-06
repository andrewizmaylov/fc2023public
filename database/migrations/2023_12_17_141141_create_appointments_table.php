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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
	        $table->char('user_id', 36);
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->char('team_id', 36);
	        $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
	        $table->unsignedTinyInteger('status')->default(0);
	        $table->jsonb('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
