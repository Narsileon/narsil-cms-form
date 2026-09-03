<?php

declare(strict_types=1);

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormWebhook;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => 'Feldgruppe|Feldgruppen',
    Form::TABLE => 'Formular|Formulare',
    FormStep::TABLE => 'Step|Steps',
    FormWebhook::TABLE => 'Webhook|Webhooks',
    Input::TABLE => 'Eingabe|Eingaben',
];
