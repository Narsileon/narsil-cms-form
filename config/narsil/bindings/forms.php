<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Narsil - Form Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between form contracts and their concrete implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm::class => \Narsil\Cms\Form\Implementations\Forms\FieldsetElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FieldsetForm::class => \Narsil\Cms\Form\Implementations\Forms\FieldsetForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormForm::class => \Narsil\Cms\Form\Implementations\Forms\FormForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormStepElementForm::class => \Narsil\Cms\Form\Implementations\Forms\FormStepElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormStepForm::class => \Narsil\Cms\Form\Implementations\Forms\FormStepForm::class,
    \Narsil\Cms\Form\Contracts\Forms\InputForm::class => \Narsil\Cms\Form\Implementations\Forms\InputForm::class,
];
