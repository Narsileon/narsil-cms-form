<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Narsil - Form Request Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between form request contracts and their concrete implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\FormRequests\FieldsetFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FieldsetFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormSubmissionDataFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionDataFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormSubmissionFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\InputFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\InputFormRequest::class,
];
