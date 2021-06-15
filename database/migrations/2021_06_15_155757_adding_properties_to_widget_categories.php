<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingPropertiesToWidgetCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget_categories', function (Blueprint $table) {
            $table->boolean("textview_enable")->default(false);
            $table->boolean("colorpicker_enable")->default(false);
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
