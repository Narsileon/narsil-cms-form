<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Field Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between field contracts and their concrete implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\Fields\ArrayField::class => \Narsil\Cms\Form\Implementations\Fields\ArrayField::class,
    \Narsil\Cms\Form\Contracts\Fields\BuilderField::class => \Narsil\Cms\Form\Implementations\Fields\BuilderField::class,
    \Narsil\Cms\Form\Contracts\Fields\CheckboxField::class => \Narsil\Cms\Form\Implementations\Fields\CheckboxField::class,
    \Narsil\Cms\Form\Contracts\Fields\DateField::class => \Narsil\Cms\Form\Implementations\Fields\DateField::class,
    \Narsil\Cms\Form\Contracts\Fields\DatetimeField::class => \Narsil\Cms\Form\Implementations\Fields\DatetimeField::class,
    \Narsil\Cms\Form\Contracts\Fields\EmailField::class => \Narsil\Cms\Form\Implementations\Fields\EmailField::class,
    \Narsil\Cms\Form\Contracts\Fields\EntityField::class => \Narsil\Cms\Form\Implementations\Fields\EntityField::class,
    \Narsil\Cms\Form\Contracts\Fields\FileField::class => \Narsil\Cms\Form\Implementations\Fields\FileField::class,
    \Narsil\Cms\Form\Contracts\Fields\FormField::class => \Narsil\Cms\Form\Implementations\Fields\FormField::class,
    \Narsil\Cms\Form\Contracts\Fields\LinkField::class => \Narsil\Cms\Form\Implementations\Fields\LinkField::class,
    \Narsil\Cms\Form\Contracts\Fields\NumberField::class => \Narsil\Cms\Form\Implementations\Fields\NumberField::class,
    \Narsil\Cms\Form\Contracts\Fields\PasswordField::class => \Narsil\Cms\Form\Implementations\Fields\PasswordField::class,
    \Narsil\Cms\Form\Contracts\Fields\RangeField::class => \Narsil\Cms\Form\Implementations\Fields\RangeField::class,
    \Narsil\Cms\Form\Contracts\Fields\RelationsField::class => \Narsil\Cms\Form\Implementations\Fields\RelationsField::class,
    \Narsil\Cms\Form\Contracts\Fields\RichTextField::class => \Narsil\Cms\Form\Implementations\Fields\RichTextField::class,
    \Narsil\Cms\Form\Contracts\Fields\SelectField::class => \Narsil\Cms\Form\Implementations\Fields\SelectField::class,
    \Narsil\Cms\Form\Contracts\Fields\SwitchField::class => \Narsil\Cms\Form\Implementations\Fields\SwitchField::class,
    \Narsil\Cms\Form\Contracts\Fields\TableField::class => \Narsil\Cms\Form\Implementations\Fields\TableField::class,
    \Narsil\Cms\Form\Contracts\Fields\TextField::class => \Narsil\Cms\Form\Implementations\Fields\TextField::class,
    \Narsil\Cms\Form\Contracts\Fields\TextareaField::class => \Narsil\Cms\Form\Implementations\Fields\TextareaField::class,
    \Narsil\Cms\Form\Contracts\Fields\TimeField::class => \Narsil\Cms\Form\Implementations\Fields\TimeField::class,
    \Narsil\Cms\Form\Contracts\Fields\TreeField::class => \Narsil\Cms\Form\Implementations\Fields\TreeField::class,
];
