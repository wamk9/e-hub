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

            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('league_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned();

            $table->foreign('subcategory_id')->references('id')->on('subcategories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('league_id')->references('id')->on('leagues')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('currency_id')->references('id')->on('currencies')->cascadeOnDelete()->cascadeOnUpdate();

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
