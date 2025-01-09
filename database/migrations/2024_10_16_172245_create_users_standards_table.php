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
        Schema::create('cat_users_standards', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->mediumInteger('user_id')->unsigned()->index();
            $table->mediumInteger('standard_id')->unsigned()->index();
            $table->date('validity');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('standard_id')->references('id')->on('cat_standards');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_users_standards');
    }
};
