<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->namespace("App\Http\Controllers")->name('api::')->group(function () {
    Route::prefix('/v1')->group(function() {
        Route::get('/widgets', 'Api\WidgetController@index')
            ->name("widgets");
        Route::get('/translation_messages/{locale}', 'Api\TranslationMessagesApiController@locale')
            ->name("translation_messages");
        Route::get('/subscriptions/{region}', 'Api\SubscriptionApiController@byRegion')
            ->name("subscriptions.region");
        Route::get('/settings', 'Api\SettingsApiController@index')
            ->name("settings");
        Route::get('/featured_collections', 'Api\FeaturedCategoriesApiController@index')
            ->name("featured_collections");
        Route::get('/widgets/categories/{id}/images', 'Api\WidgetController@categoryImages')
            ->name("widget_categories.images");
        Route::get('/widget_categories/{category}/widgets', 'Api\WidgetCategoryApiController@widgets')
            ->name("widget_categories.widgets");
        Route::get('/widget_categories', 'Api\WidgetCategoryApiController@index')
            ->name("widget_categories");
        Route::get('theme_categories/', 'Api\ThemeCategoryController@index')
            ->name("theme_categories");
        Route::get('theme_categories/{category}/themes', 'Api\ThemeCategoryController@themes')
            ->name("theme_categories.themes");
        Route::get('themes', 'Api\ThemeController@index')
            ->name("themes");
        Route::get('themes/{theme}', 'Api\ThemeController@show')
            ->name("themes.show");
        Route::get('themes/{theme}/images', 'Api\ThemeController@images')
            ->name("themes.theme.images");
        Route::get('themes/{theme}/icons', 'Api\ThemeController@icons')
            ->name("themes.theme.icons");
        Route::get('wallpaper_categories/', 'Api\WallpaperCategoryController@index')
            ->name("wallpaper_categories");
        Route::get('wallpaper_categories/{category}/images', 'Api\WallpaperCategoryController@images')
            ->name("wallpaper_categories.category.images");

        Route::get('quotes', 'Api\QuoteApiController@index')
            ->name("quotes");
        Route::get('quote_categories', 'Api\QuoteCategoryApiController@index')
            ->name("quotes_categories");
    });

    Route::prefix("/admin")->name("admin.")->group(function() {
        Route::put("icons/{icon}", "Api\\IconsApiController@update")
            ->name("icons.update");
    });

    Route::prefix('/v1.1')->group(function() {
        Route::get('themes/{theme}/icons', 'Api\ThemeController@iconsv2')
            ->name("v1-1.themes.theme.icons");
        Route::get('wallpapers', 'Api\WallpapersApiController@index')
            ->name("v1-1.wallpapers");
        Route::get('wallpaper_categories/{category}/wallpapers', 'Api\WallpaperCategoryWallpapersApiController@index')
            ->name("v1-1.wallpaper_categories.category.wallpapers");
    });

});
