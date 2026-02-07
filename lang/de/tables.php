<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => 'Feldgruppen',
    Form::TABLE => 'Formulare',
    FormStep::TABLE => 'Tabs',
    FormWebhook::TABLE => 'Webhooks',
    Input::TABLE => 'Eingaben',
];
