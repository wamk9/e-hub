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
        Schema::create('point_protests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_from')->unsigned();
            $table->bigInteger('subscription_to')->unsigned();
            $table->text('description')->nullable();
            $table->text('judgment')->nullable();
            $table->bigInteger('point_event_id')->unsigned();
            $table->timestamps();

            $table->foreign('subscription_from')->references('id')->on('tournaments_subscriptions')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->foreign('subscription_to')->references('id')->on('tournaments_subscriptions')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->foreign('point_event_id')->references('id')->on('point_events')->cascadeOnUpdate()->cascadeOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_protests');
    }
};
