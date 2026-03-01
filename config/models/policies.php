<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Policies
    |--------------------------------------------------------------------------
    |
    | Mapping between model classes and their policies.
    |
    */

    \Narsil\Cms\Form\Models\Fieldset::class => \Narsil\Cms\Form\Policies\FieldsetPolicy::class,
    \Narsil\Cms\Form\Models\Form::class => \Narsil\Cms\Form\Policies\FormPolicy::class,
    \Narsil\Cms\Form\Models\Input::class => \Narsil\Cms\Form\Policies\InputPolicy::class,
];
