<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => 'ensemble de champs|ensembles de champs',
    Form::TABLE => 'formulaire|formulaires',
    FormStep::TABLE => 'étape|étapes',
    FormWebhook::TABLE => 'webhook|webhooks',
    Input::TABLE => 'entrée|entrées',
];
