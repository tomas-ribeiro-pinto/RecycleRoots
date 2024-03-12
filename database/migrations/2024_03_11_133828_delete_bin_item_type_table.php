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
        Schema::dropIfExists('bin_item_type');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('bin_item_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bin_id')->constrained();
            $table->foreignId('item_type_id')->constrained();
            $table->timestamps();
        });
    }
};
