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
        Schema::table('charity_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('charity_id');
            $table->rename('charity_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charity_item', function (Blueprint $table) {
            $table->foreignId('charity_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->rename('charity_items');
        });
    }
};
