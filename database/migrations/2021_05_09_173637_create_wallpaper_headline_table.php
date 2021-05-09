<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallpaperHeadlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_category_headline', function (Blueprint $table) {
            $table->primary(['theme_category_id','headline_id']);
            $table->unsignedBigInteger('theme_category_id');
            $table->unsignedBigInteger('headline_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallpaper_headline');
    }
}
