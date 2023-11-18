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
        Schema::create('teams_members', function (Blueprint $table) {
            $table->BigInteger('team_id')->unsigned();
            $table->BigInteger('member_id')->unsigned();
            $table->boolean('is_admin', false);

            $table->primary(['team_id','member_id']);
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('member_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_members');
    }
};
