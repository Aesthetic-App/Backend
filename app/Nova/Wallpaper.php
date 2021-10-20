<?php

namespace App\Nova;

use App\Nova\Filters\WallpaperCategoryFilter;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Wallpaper extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static $group = 'Wallpapers';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Wallpaper::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'wallpaper_category_id'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $tabs = [
            'General' => [
                ID::make(__('ID'), 'id')->sortable()->hideFromIndex(),
                Text::make('Name', 'name'),
                BelongsTo::make("Wallpaper Category", "wallpaper_category", WallpaperCategory::class),
                Images::make('Image', 'wallpapers')->showStatistics()
                    ->setFileName(function($originalFilename, $extension){
                        return md5($originalFilename) . '.' . $extension;
                    })->conversionOnDetailView("small-image")
                    ->conversionOnForm("small-image")
                    ->conversionOnIndexView("small-image")
                    ->singleImageRules("mimes:png")
                    ->rules('required', 'size:1'),
            ],
        ];
        return [
            new Tabs("Wallpaper Edit/Create", $tabs),
        ];
}

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new WallpaperCategoryFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
