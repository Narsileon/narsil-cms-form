<?php

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    'descriptions' => [
        Fieldset::TABLE => [
            Fieldset::HANDLE => 'Der Standard-Handle. Der Wert kann von Formularen und Feldgruppen überschrieben werden, die diese Feldgruppe implementieren.',
            Fieldset::LABEL => 'Die Standardbezeichnung. Der Wert kann von Formularen und Feldgruppen überschrieben werden, die diese Feldgruppe implementieren.',
        ],
        Input::TABLE => [
            Input::DESCRIPTION => 'Die Standardbeschreibung. Der Wert kann von Formularen und Feldgruppen überschrieben werden, die dieses Eingabefeld implementieren.',
            Input::HANDLE => 'Der Standard-Handle. Der Wert kann von Formularen und Feldgruppen überschrieben werden, die dieses Eingabefeld implementieren.',
            Input::LABEL => 'Die Standardbezeichnung. Der Wert kann von Formularen und Feldgruppen überschrieben werden, die dieses Eingabefeld implementieren.',
        ],
    ],
];
