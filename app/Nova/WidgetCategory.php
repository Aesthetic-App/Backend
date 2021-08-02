<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\BelongsTo;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\Boolean;

class WidgetCategory extends Resource
{
    use TabsOnEdit;
    public static $displayInNavigation = false;



    public static function label() {
        return 'Widget Category';
    }

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
                Boolean::make('Theme Color Enable', 'theme_color_is_enabled')->default(false),
                Boolean::make('Background Color Enable', 'background_color_is_enabled')->default(false),
                Boolean::make('Text Enable', 'text_is_enabled')->default(false),
                Boolean::make('Font Enable', 'font_is_enabled')->default(false),
                Boolean::make("Textview Enable", 'textview_enable')->default(false),
                Boolean::make("Date Enable", 'is_date_enabled')->default(false),
                Boolean::make("Colorpicker Enable", 'colorpicker_enable')
                //BelongsToMany::make("Widget Types", "widget_types", WidgetType::class),
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
        return [];
    }
}
