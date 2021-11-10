<?php

namespace App\Nova;

use App\Nova\Actions\DownloadAsJsonAction;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class WidgetCategory extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static function label() {
        return 'Widget Category';
    }

    public static $group = 'Widget';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\WidgetCategory::class;

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
        'id', 'name'
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
                Text::make('Category Name', 'name')->required(),
                Boolean::make("Is Featured", "is_featured")->default(false),
                Boolean::make('Theme Color Enable', 'theme_color_is_enabled')->default(false),
                Boolean::make('Background Color Enable', 'background_color_is_enabled')->default(false),
                Boolean::make('Text Enable', 'text_is_enabled')->default(false),
                Boolean::make('Font Enable', 'font_is_enabled')->default(false),
                Boolean::make("Textview Enable", 'textview_enable')->default(false),
                Boolean::make("Date Enable", 'is_date_enabled')->default(false),
                Boolean::make("Colorpicker Enable", 'colorpicker_enable'),
                Images::make('Cover Image', 'cover_image')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                    })->hideFromIndex(),
                Images::make('Featured Cover Image', 'featured_cover_image')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                    })->hideFromIndex()
            ],
        ];

        return [
            new Tabs("Category Edit/Create", $tabs),
            BelongsTo::make("Widget Type", "widget_type", WidgetType::class)
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
        return [];
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
        return [
            new DownloadAsJsonAction()
        ];
    }
}
