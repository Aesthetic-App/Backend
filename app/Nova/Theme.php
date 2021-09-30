<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use NovaAttachMany\AttachMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Theme extends Resource
{
    use TabsOnEdit;
    use HasSortableRows;

    public static function label() {
        return 'Theme';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Theme::class;

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
                Text::make('Theme Name', 'title')->required(),
                AttachMany::make('Categories', 'categories', ThemeCategory::class)
                ->help("Yeni bir keategoriye bağlamak istiyorsanız aşağıdaki alana yeni headline'ın adını giriniz."),
                Text::make('New Category', 'new_category_title')
                    ->onlyOnForms()
                    ->hideWhenUpdating()
                    ->help("Bu alanı yeni kategori oluşturmak için kullanın"),
                Text::make('Category Name', 'category_name', function() {
                    $category =  $this->categories()->first();
                    return $category->title ?? '-';
                })->onlyOnIndex(),
                Boolean::make("Premium", "is_premium"),
            ],
            'Cover Image' => [
                Images::make('Cover Image', 'cover_image')
                ->singleImageRules("mimes:png"),
            ],
            'Wallpapers' => [
                Images::make('Wallpapers', 'images')->showStatistics()
                    ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                })->conversionOnDetailView("small-image")
                ->conversionOnForm("small-image")
                ->hideFromIndex()
                ->singleImageRules("mimes:png"),
            ],
            'Icons' => [
                Images::make('Icons', 'icons')->showStatistics()
                     ->setFileName(function($originalFilename, $extension, $model){
                           return md5($originalFilename) . '.' . $extension;
                    })->conversionOnDetailView("small-image")
                ->conversionOnForm("small-image")
                    ->hideFromIndex()
            ]
        ];
        return [
            new Tabs("Theme Create/Edit", $tabs),
            BelongsToMany::make('Theme Categories', 'categories', ThemeCategory::class),
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
