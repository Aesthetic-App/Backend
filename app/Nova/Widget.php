<?php

namespace App\Nova;

use Eminiarts\Tabs\Tabs;
use App\Models\WidgetType;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\Boolean;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class Widget extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static function label() {
        return 'Widget';
    }

    public static $group = 'Widget';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Widget::class;

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
                Text::make('Widget Name', 'name')->required(),
                Images::make('Background Image', 'background_images')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                })->hideFromIndex(),
                Text::make("Theme Hex Color"),
                Text::make("Background Hex Color"),
                Text::make("Font Name"),
                Text::make("Text"),
                Boolean::make("Premium", "is_premium"),
                NovaBelongsToDepend::make('Widget Type', "widget_type")
                    ->options(WidgetType::all()),
                NovaBelongsToDepend::make('Widget Category')
                    ->optionsResolve(function($type) {
                        return $type->widget_categories;
                    })->dependsOn("widget_type")
            ],
        ];
        return [
            new Tabs("Widget Edit/Create", $tabs),
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
