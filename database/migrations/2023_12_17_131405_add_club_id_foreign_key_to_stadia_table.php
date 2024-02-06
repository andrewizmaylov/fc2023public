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
        Schema::table('stadia', function (Blueprint $table) {
	        $table->dropColumn('club');
	        $table->char('club_id', 36)->nullable()->after('banner');
	        $table->foreign('club_id')->references('id')->on('clubs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stadia', function (Blueprint $table) {
	        $table->unsignedTinyInteger('club')->nullable()->default(0)->after('banner');
	        $table->dropForeign(['club_id']);
	        $table->dropColumn('club_id');
        });
    }
};
