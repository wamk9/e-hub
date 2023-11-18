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
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('team_id')->unsigned()->nullable();
            $table->bigInteger('tournament_id')->unsigned();
            $table->bigInteger('payment_status_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
            $table->foreign('team_id')->references('id')->on('teams')->cascadeOnUpdate();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->cascadeOnUpdate();
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
