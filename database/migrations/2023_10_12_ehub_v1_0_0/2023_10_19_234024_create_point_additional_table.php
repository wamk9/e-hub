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
        Schema::create('point_additional', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('quantity')->unsigned();
            $table->bigInteger('point_category_id')->unsigned();
            $table->bigInteger('point_result_id')->unsigned();
            $table->bigInteger('point_protest_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('point_protest_id')->references('id')->on('point_protests')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('point_result_id')->references('id')->on('point_results')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_additional');
    }
};
