<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => 'fieldset|fieldsets',
    Form::TABLE => 'form|forms',
    FormStep::TABLE => 'step|steps',
    FormWebhook::TABLE => 'webhook|webhooks',
    Input::TABLE => 'input|inputs',
];
