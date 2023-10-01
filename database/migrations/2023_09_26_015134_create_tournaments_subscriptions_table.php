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
        Schema::create('tournaments_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('tournament_id')->unsigned();
            $table->bigInteger('league_id')->unsigned();
            $table->bigInteger('payment_status_id')->unsigned();

            $table->foreign('member_id')->references('member_id')->on('teams_members')->cascadeOnUpdate();
            $table->foreign('team_id')->references('team_id')->on('teams_members')->cascadeOnUpdate();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->cascadeOnUpdate();
            $table->foreign('league_id')->references('id')->on('leagues')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('payment_status_id')->references('id')->on('payments_status')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments_subscriptions');
    }
};
