<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortOrderToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_categories', function (Blueprint $table) {
            $table->integer('sort_order')
                ->default(0);
        });
        Schema::table('theme_categories', function (Blueprint $table) {
            $table->integer('sort_order')
                ->default(0);
        });
        Schema::table('wallpaper_categories', function (Blueprint $table) {
            $table->integer('sort_order')
                ->default(0);
        });

        DB::statement('UPDATE widget_categories SET sort_order = id');
        DB::statement('UPDATE theme_categories SET sort_order = id');
        DB::statement('UPDATE wallpaper_categories SET sort_order = id');
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
