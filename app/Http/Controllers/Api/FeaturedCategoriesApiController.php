<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WidgetCategory;
use Illuminate\Http\Request;
use OptimistDigital\NovaSettings\Models\Settings;

class FeaturedCategoriesApiController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        $themeCategoryID = Settings::query()->find(['key' => 'featured_theme_category'])->first();
        $wallpaperCategoryID = Settings::query()->find(['key' => 'featured_wallpaper_category'])->first();
        $widgetCategoryID = Settings::query()->find(['key' => 'featured_widget_category'])->first();
        return [
          'widget' => WidgetCategory::query()
            ->find(['id' => $widgetCategoryID->value ?? 0])->first(),
            'wallpaper' => WidgetCategory::query()
                ->find(['id' => $wallpaperCategoryID->value ?? 0])->first(),
            'theme' => WidgetCategory::query()
                ->find(['id' => $themeCategoryID->value ?? 0])->first(),
        ];
    }
}
