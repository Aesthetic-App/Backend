<?php

use App\Models\Media;
use App\Models\Theme;
use App\Models\ThemeCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameThemeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('theme_categories', 'themes');
        Media::query()
        ->where("model_type", ThemeCategory::class)
        ->update([
            'model_type' => Theme::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
