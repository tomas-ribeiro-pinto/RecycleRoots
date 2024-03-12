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
        Schema::table('bin_locations', function (Blueprint $table) {
            $table->dropColumn('postcode');
            $table->foreignId('team_postcode_id')
                ->after('bin_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bin_locations', function (Blueprint $table) {
            $table->dropForeign(['team_postcode_id']);
            $table->dropColumn('team_postcode_id');
            $table->string('postcode');
        });
    }
};
