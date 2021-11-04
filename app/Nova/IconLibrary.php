<?php

namespace App\Nova;

use App\Nova\Filters\IconTHEME;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class IconLibrary extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static $group = 'Theme';
    public static $originals = null;

    public static function label() {
        return 'Icon Library';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Icon::class;

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
        'name', 'theme_id'
    ];

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where("type", "!=", "normal");
    }

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
                Text::make('Name', 'name')->required(),
                Hidden::make("Type", "type")->default("general_library"),
                Hidden::make("Theme Id", "theme_id")->default(0),
                Hidden::make("Original Id", "original_id")->default(0),
                Images::make('Icon', 'custom_icon')->showStatistics()
                    ->setFileName(function($originalFilename, $extension){
                        return md5($originalFilename) . '.' . $extension;
                    })->conversionOnDetailView("small-image")
                    ->conversionOnForm("small-image")
                    ->conversionOnIndexView("small-image")
                ->rules('required', 'size:1'),
            ],
        ];
        return [
            new Tabs("Library Icon Edit/Create", $tabs),
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
            new IconTHEME()
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
