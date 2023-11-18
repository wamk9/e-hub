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
        Schema::create('point_rounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('point_event_id')->unsigned();

            $table->foreign('point_event_id')->references('id')->on('point_events')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_rounds');
    }
};
