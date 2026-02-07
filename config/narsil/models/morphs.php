<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Model Morphs
    |--------------------------------------------------------------------------
    |
    | Mapping between model classes and their morphs.
    |
    */

    \Narsil\Cms\Form\Models\Fieldset::class => \Narsil\Cms\Form\Models\Fieldset::TABLE,
    \Narsil\Cms\Form\Models\FieldsetElement::class => \Narsil\Cms\Form\Models\FieldsetElement::TABLE,
    \Narsil\Cms\Form\Models\Form::class => \Narsil\Cms\Form\Models\Form::TABLE,
    \Narsil\Cms\Form\Models\FormStep::class => \Narsil\Cms\Form\Models\FormStep::TABLE,
    \Narsil\Cms\Form\Models\FormStepElement::class => \Narsil\Cms\Form\Models\FormStepElement::TABLE,
    \Narsil\Cms\Form\Models\Input::class => \Narsil\Cms\Form\Models\Input::TABLE,
];
