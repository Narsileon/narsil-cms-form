<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => 'fieldsets',
    Form::TABLE => 'forms',
    FormStep::TABLE => 'tabs',
    FormWebhook::TABLE => 'webhooks',
    Input::TABLE => 'inputs',
];
