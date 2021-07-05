<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToWidgetCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_categories', function (Blueprint $table) {
           $table->boolean("theme_color_is_enabled"); 
           $table->boolean("background_color_is_enabled"); 
           $table->boolean("text_is_enabled"); 
           $table->boolean("font_is_enabled"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widget_categories', function (Blueprint $table) {
            //
        });
    }
}
