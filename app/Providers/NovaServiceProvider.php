<?php

namespace App\Providers;

use App\Models\ThemeCategory;
use App\Models\WallpaperCategory;
use App\Models\WidgetCategory;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Support\Facades\Gate;
use App\Nova\Dashboards\EmptyDashboard;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::serving(function() {
            Nova::style('admin', public_path('css/app.css'));
        });

        $themeCategories = ThemeCategory::query()
            ->pluck("title", "id")->toArray();

        $wallpaperCategories = WallpaperCategory::query()
            ->pluck("title", "id")->toArray();

        $widgetCategories = WidgetCategory::query()
            ->pluck("name", "id")->toArray();

        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
                Boolean::make('Test page is active', 'test_page_is_active'),
                Select::make('Featured Theme Category')
                    ->options($themeCategories),
                Select::make('Featured Widget Category')
                ->options($widgetCategories),
                Select::make('Featured Wallpaper Category')
                ->options($wallpaperCategories),
        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'serkanerip@gmail.com',
                'admin@app.com',
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
        public function tools()
    {
        return [
            new \OptimistDigital\NovaSettings\NovaSettings,
            new \Bernhardh\NovaTranslationEditor\NovaTranslationEditor()
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function resources()
    {
        Nova::resourcesIn(app_path('Nova'));
    }

}
