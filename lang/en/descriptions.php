<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE => [
        Fieldset::HANDLE => 'The default handle. The value can be overridden by forms and fieldsets that implement this fieldset.',
        Fieldset::LABEL => 'The default label. The value can be overridden by forms and fieldsets that implement this fieldset.',
    ],
    Input::TABLE => [
        Input::DESCRIPTION => 'The default description. The value can be overridden by forms and fieldsets that implement this input.',
        Input::HANDLE => 'The default handle. The value can be overridden by forms and fieldsets that implement this input.',
        Input::LABEL => 'The default label. The value can be overridden by forms and fieldsets that implement this input.',
    ],
];
