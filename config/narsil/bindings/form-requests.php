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

    \Narsil\Cms\Form\Contracts\FormRequests\BlockFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\BlockFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\ConfigurationFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\ConfigurationFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\EntityFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\EntityFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FieldFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FieldFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FieldsetFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FieldsetFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FooterFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FooterFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormSubmissionDataFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionDataFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\FormSubmissionFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\FormSubmissionFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\HeaderFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\HeaderFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\HostFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\HostFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\InputFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\InputFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\MediaFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\MediaFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\PermissionFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\PermissionFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\RoleFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\RoleFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\SitePageFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\SitePageFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\TemplateFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\TemplateFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\UserConfigurationFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\UserConfigurationFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\UserFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\UserFormRequest::class,

    /*
    |--------------------------------------------------------------------------
    | Fortify - Form Request Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between form request contracts and their concrete implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\FormRequests\Fortify\CreateNewUserFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\Fortify\CreateNewUserFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\Fortify\ResetUserPasswordFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\Fortify\ResetUserPasswordFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\Fortify\UpdateUserPasswordFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\Fortify\UpdateUserPasswordFormRequest::class,
    \Narsil\Cms\Form\Contracts\FormRequests\Fortify\UpdateUserProfileInformationFormRequest::class => \Narsil\Cms\Form\Implementations\Requests\Fortify\UpdateUserProfileInformationFormRequest::class,
];
