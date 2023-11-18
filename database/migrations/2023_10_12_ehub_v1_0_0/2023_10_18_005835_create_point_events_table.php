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
        Schema::create('point_events', function (Blueprint $table) {
            $table->id();
            $table->timestamp('init_at');
            $table->string('duration');
            $table->string('name');
            $table->string('route');
            $table->text('description')->nullable();
            $table->boolean('can_discard')->nullable()->default(false);
            $table->bigInteger('tournament_id')->unsigned();
            $table->timestamps();


            $table->foreign('tournament_id')->references('id')->on('tournaments')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_events');
    }
};
