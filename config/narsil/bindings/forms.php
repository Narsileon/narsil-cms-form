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

    \Narsil\Cms\Form\Contracts\Forms\BlockElementForm::class => \Narsil\Cms\Form\Implementations\Forms\BlockElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\BlockForm::class => \Narsil\Cms\Form\Implementations\Forms\BlockForm::class,
    \Narsil\Cms\Form\Contracts\Forms\ConditionForm::class => \Narsil\Cms\Form\Implementations\Forms\ConditionForm::class,
    \Narsil\Cms\Form\Contracts\Forms\ConfigurationForm::class => \Narsil\Cms\Form\Implementations\Forms\ConfigurationForm::class,
    \Narsil\Cms\Form\Contracts\Forms\EntityForm::class => \Narsil\Cms\Form\Implementations\Forms\EntityForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FieldForm::class => \Narsil\Cms\Form\Implementations\Forms\FieldForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FieldsetElementForm::class => \Narsil\Cms\Form\Implementations\Forms\FieldsetElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FieldsetForm::class => \Narsil\Cms\Form\Implementations\Forms\FieldsetForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FooterForm::class => \Narsil\Cms\Form\Implementations\Forms\FooterForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormForm::class => \Narsil\Cms\Form\Implementations\Forms\FormForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormStepElementForm::class => \Narsil\Cms\Form\Implementations\Forms\FormStepElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\FormStepForm::class => \Narsil\Cms\Form\Implementations\Forms\FormStepForm::class,
    \Narsil\Cms\Form\Contracts\Forms\HeaderForm::class => \Narsil\Cms\Form\Implementations\Forms\HeaderForm::class,
    \Narsil\Cms\Form\Contracts\Forms\HostForm::class => \Narsil\Cms\Form\Implementations\Forms\HostForm::class,
    \Narsil\Cms\Form\Contracts\Forms\InputForm::class => \Narsil\Cms\Form\Implementations\Forms\InputForm::class,
    \Narsil\Cms\Form\Contracts\Forms\MediaForm::class => \Narsil\Cms\Form\Implementations\Forms\MediaForm::class,
    \Narsil\Cms\Form\Contracts\Forms\PermissionForm::class => \Narsil\Cms\Form\Implementations\Forms\PermissionForm::class,
    \Narsil\Cms\Form\Contracts\Forms\PublishForm::class => \Narsil\Cms\Form\Implementations\Forms\PublishForm::class,
    \Narsil\Cms\Form\Contracts\Forms\RoleForm::class => \Narsil\Cms\Form\Implementations\Forms\RoleForm::class,
    \Narsil\Cms\Form\Contracts\Forms\SiteForm::class => \Narsil\Cms\Form\Implementations\Forms\SiteForm::class,
    \Narsil\Cms\Form\Contracts\Forms\SitePageForm::class => \Narsil\Cms\Form\Implementations\Forms\SitePageForm::class,
    \Narsil\Cms\Form\Contracts\Forms\TemplateForm::class => \Narsil\Cms\Form\Implementations\Forms\TemplateForm::class,
    \Narsil\Cms\Form\Contracts\Forms\TemplateTabElementForm::class => \Narsil\Cms\Form\Implementations\Forms\TemplateTabElementForm::class,
    \Narsil\Cms\Form\Contracts\Forms\TemplateTabForm::class => \Narsil\Cms\Form\Implementations\Forms\TemplateTabForm::class,
    \Narsil\Cms\Form\Contracts\Forms\UserConfigurationForm::class => \Narsil\Cms\Form\Implementations\Forms\UserConfigurationForm::class,
    \Narsil\Cms\Form\Contracts\Forms\UserForm::class => \Narsil\Cms\Form\Implementations\Forms\UserForm::class,

    /*
    |--------------------------------------------------------------------------
    | Fortify - Form Bindings
    |--------------------------------------------------------------------------
    |
    | Mapping between form contracts and their concrete implementations.
    |
    */

    \Narsil\Cms\Form\Contracts\Forms\Fortify\ConfirmPasswordForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\ConfirmPasswordForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\ForgotPasswordForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\ForgotPasswordForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\LoginForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\LoginForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\ProfileForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\ProfileForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\RegisterForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\RegisterForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\ResetPasswordForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\ResetPasswordForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\TwoFactorChallengeForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\TwoFactorChallengeForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\TwoFactorForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\TwoFactorForm::class,
    \Narsil\Cms\Form\Contracts\Forms\Fortify\UpdatePasswordForm::class => \Narsil\Cms\Form\Implementations\Forms\Fortify\UpdatePasswordForm::class,
];
