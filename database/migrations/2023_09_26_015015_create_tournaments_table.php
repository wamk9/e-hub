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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('route');
            $table->float('price')->default(0);
            $table->integer('subscription_limit')->default(0);
            $table->binary('banner_image')->nullable();
            $table->binary('logo_image')->nullable();

            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('league_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('league_id')->references('id')->on('leagues')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
