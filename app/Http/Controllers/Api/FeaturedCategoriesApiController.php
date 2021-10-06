<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemeCategory;
use App\Models\WallpaperCategory;
use App\Models\WidgetCategory;
use Illuminate\Http\Request;
use OptimistDigital\NovaSettings\Models\Settings;

class FeaturedCategoriesApiController extends Controller
{
    private  function withoutPagination()
    {
        $settings = Settings::all();
        $themeCategoryID = Settings::query()->find(['key' => 'featured_theme_category'])->first();
        $wallpaperCategoryID = Settings::query()->find(['key' => 'featured_wallpaper_category'])->first();
        $widgetCategoryID = Settings::query()->find(['key' => 'featured_widget_category'])->first();

        return [
            'widget' => WidgetCategory::query()
                ->with("widgets")
                ->find(['id' => $widgetCategoryID->value ?? 0])->first()->setAppends(['cover_image', 'featured_cover_image']),
            'wallpaper' => WallpaperCategory::query()
                ->find(['id' => $wallpaperCategoryID->value ?? 0])->first()->setAppends(['cover_image', 'featured_cover_image', 'images']),
            'theme' => ThemeCategory::query()
                ->with('themes')
                ->find(['id' => $themeCategoryID->value ?? 0])->first()->setAppends(['cover_image', 'featured_cover_image']),
        ];
    }
    public function index(Request $request)
    {
        if ((bool)$request->get('without_pagination', false) === true) {
            return $this->withoutPagination();
        }
        $settings = Settings::all();
        $themeCategoryID = Settings::query()->find(['key' => 'featured_theme_category'])->first();
        $wallpaperCategoryID = Settings::query()->find(['key' => 'featured_wallpaper_category'])->first();
        $widgetCategoryID = Settings::query()->find(['key' => 'featured_widget_category'])->first();
        return [
            'widget' => WidgetCategory::query()
            ->find(['id' => $widgetCategoryID->value ?? 0])->first(),
            'wallpaper' => WallpaperCategory::query()
                ->find(['id' => $wallpaperCategoryID->value ?? 0])->first(),
            'theme' => ThemeCategory::query()
                ->find(['id' => $themeCategoryID->value ?? 0])->first(),
        ];
    }
}
