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
        Schema::create('point_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('point_event_id')->unsigned();
            $table->bigInteger('tournament_subscription_id')->unsigned();
            $table->bigInteger('point_reference_id')->unsigned()->nullable();
            $table->bigInteger('point_result_category_id')->unsigned();

            $table->foreign('tournament_subscription_id')->references('id')->on('tournaments_subscriptions')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('point_reference_id')->references('id')->on('point_references')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('point_result_category_id')->references('id')->on('point_result_categories')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_results');
    }
};
