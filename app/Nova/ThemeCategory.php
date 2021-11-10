<?php

namespace App\Nova;

use App\Nova\Actions\DownloadAsJsonAction;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;
use NovaAttachMany\AttachMany;
use Laravel\Nova\Fields\BelongsToMany;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\Boolean;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class ThemeCategory extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static function label() {
        return 'Theme Category';
    }

    public static $group = 'Theme';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ThemeCategory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title'
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
                Text::make('Category Name', 'title')->required(),
                Boolean::make("Is Featured", "is_featured")->default(false),
                Images::make('Cover Image', 'cover_image')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                    })->hideFromIndex(),
                Images::make('Featured Cover Image', 'featured_cover_image')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                    })->hideFromIndex()
            ],
            'Themes' => [
                AttachMany::make('Themes', 'themes', Theme::class),
            ]
        ];
        return [
            new Tabs("Category Edit/Create", $tabs),
            BelongsToMany::make('Theme', 'themes', Theme::class),
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
