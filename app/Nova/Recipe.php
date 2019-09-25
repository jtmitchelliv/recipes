<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Recipe extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Recipe';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'description'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            ID::make()
                    ->sortable()
                    ->hideFromIndex(),

            Text::make('Title')
                    ->sortable(),

            Image::make('Image')
                    ->disk('public')
                    ->prunable()
                    ->deletable()
                    ->storeOriginalName('attachment_name')
                    ->storeSize('attachment_size'),

            Textarea::make('Description'),

            Text::make('Yield')
                    ->hideFromIndex(),

            Flexible::make('Ingredients')
                    ->button('Add ingredient')
                    ->addLayout('Ingredient', 'ingredient', [
                        Text::make('Amount'),
                        Text::make('Ingredient')
                    ])
                    ->confirmRemove(),

            Flexible::make('Instructions')
                    ->button('Add instruction')
                    ->addLayout('Instruction', 'instruction', [
                        Text::make('Instruction')
                        // todo: add optional image field here
                    ])
                    ->confirmRemove(),
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
