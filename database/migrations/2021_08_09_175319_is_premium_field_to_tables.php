<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IsPremiumFieldToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widgets', function (Blueprint $table) {
            $table->boolean("is_premium")->default(false);
        });
        Schema::table('wallpaper_categories', function (Blueprint $table) {
            $table->boolean("is_premium")->default(false);
        });
        Schema::table('theme_categories', function (Blueprint $table) {
            $table->boolean("is_premium")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
