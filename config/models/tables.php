<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Tables
    |--------------------------------------------------------------------------
    |
    | Mapping between model tables and their tables.
    |
    */

    \Narsil\Cms\Form\Models\Fieldset::TABLE => \Narsil\Cms\Form\Implementations\Tables\FieldsetTable::class,
    \Narsil\Cms\Form\Models\Form::TABLE => \Narsil\Cms\Form\Implementations\Tables\FormTable::class,
    \Narsil\Cms\Form\Models\Input::TABLE => \Narsil\Cms\Form\Implementations\Tables\InputTable::class,
];
