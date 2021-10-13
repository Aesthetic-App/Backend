<?php

namespace App\Nova;

use Aesthetic\RelationSelect\RelationSelect;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Eminiarts\Tabs\TabsOnEdit;

class Subscription extends Resource
{
    use TabsOnEdit;

    public static $group = 'Subscription';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Subscription::class;

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
        'id', 'name', 'permission', 'type'
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
                Text::make('Name', 'name')->required(),
                Text::make('Identifier', 'identifier')->required(),
                Text::make('Permission', 'permission')->required(),
                Select::make("Trial Duration", "trial_duration")
                    ->options([
                        '3 days' => "3 Days",
                        "1 week" => "A Week",
                        "2 weeks" => "Two Weeks",
                        "1 month" => "A Month",
                        "2 months" => "Two Months",
                        "3 months" => "Three Months",
                        "6 months" => "Six Months",
                        "Annual" => "A Year",
                    ]),
                Select::make("Type", "type")
                ->options([
                    'direct' => "Direct",
                    "trial" => "Trial"
                ]),
                Boolean::make("Default", "is_default")->default(false),
            ],
            'Regions' => [
                RelationSelect::make("Regions", "regions", Region::class)
                    ->relationLabel('code')
                    ->relationModel(\App\Models\Region::class)
                    ->hideFromIndex()
                    ->options(\App\Models\Region::all()),
            ]
        ];
        return [
            new Tabs("Subscription Edit/Create", $tabs),
            MorphToMany::make("Regions", "regions", Region::class),
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
