<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Action Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between form contracts and their implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\Actions\Elements\SyncElementConditions::class => \Narsil\Cms\Form\Implementations\Actions\Elements\SyncElementConditions::class,
    \Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset::class => \Narsil\Cms\Form\Implementations\Actions\Fieldsets\ReplicateFieldset::class,
    \Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements::class => \Narsil\Cms\Form\Implementations\Actions\Fieldsets\SyncFieldsetElements::class,
    \Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm::class => \Narsil\Cms\Form\Implementations\Actions\Forms\ReplicateForm::class,
    \Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormStepElements::class => \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormStepElements::class,
    \Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps::class => \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormSteps::class,
    \Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormWebhooks::class => \Narsil\Cms\Form\Implementations\Actions\Forms\SyncFormWebhooks::class,
    \Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput::class => \Narsil\Cms\Form\Implementations\Actions\Inputs\ReplicateInput::class,
    \Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions::class => \Narsil\Cms\Form\Implementations\Actions\Inputs\SyncInputOptions::class,
    \Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputValidationRules::class => \Narsil\Cms\Form\Implementations\Actions\Inputs\SyncInputValidationRules::class,
];
