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
        Schema::create('point_references', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('num_order')->unsigned();
            $table->tinyInteger('point')->default(0);
            $table->bigInteger('point_round_id')->unsigned();

            $table->foreign('point_round_id')->references('id')->on('point_rounds')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_references');
    }
};
