<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFeaturedFieldToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_categories', function (Blueprint $table) {
            $table->boolean('is_featured')
                ->default(false);
        });
        Schema::table('theme_categories', function (Blueprint $table) {
            $table->boolean('is_featured')
                ->default(false);
        });
        Schema::table('wallpaper_categories', function (Blueprint $table) {
            $table->boolean('is_featured')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
}
