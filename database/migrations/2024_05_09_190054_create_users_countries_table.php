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
        Schema::create('cat_users_countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('user_id')->unsigned()->index();
            $table->smallInteger('estado_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estado_id')->references('id')->on('cat_estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_users_countries');
    }
};
