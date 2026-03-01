<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Observers
    |--------------------------------------------------------------------------
    |
    | Mapping between model classes and their obervers.
    |
    */

    \Narsil\Cms\Form\Models\FieldsetElement::class => \Narsil\Cms\Form\Observers\FieldsetElementObserver::class,
    \Narsil\Cms\Form\Models\FormStepElement::class => \Narsil\Cms\Form\Observers\FormStepElementObserver::class,
];
