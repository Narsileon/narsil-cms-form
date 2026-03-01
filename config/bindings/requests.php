<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Request Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between request contracts and their implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FieldsetFormRequest::class,
    \Narsil\Cms\Form\Contracts\Requests\FormFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormFormRequest::class,
    \Narsil\Cms\Form\Contracts\Requests\FormSubmissionDataFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionDataFormRequest::class,
    \Narsil\Cms\Form\Contracts\Requests\FormSubmissionFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionFormRequest::class,
    \Narsil\Cms\Form\Contracts\Requests\InputFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\InputFormRequest::class,
];
