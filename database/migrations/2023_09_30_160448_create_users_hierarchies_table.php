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
        Schema::create('users_hierarchies', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('hierarchy_id')->unsigned();
            $table->bigInteger('league_id')->unsigned();

            $table->primary(['user_id', 'hierarchy_id', 'league_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('hierarchy_id')->references('id')->on('hierarchies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('league_id')->references('id')->on('leagues')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_hierarchies');
    }
};
