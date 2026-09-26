<?php

declare(strict_types=1);

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\Input;

#endregion

return [
    Fieldset::TABLE . '.' . Fieldset::HANDLE => 'Le handle par défaut. La valeur peut être remplacée par des formulaires et des groupes de champs qui implémentent ce groupe de champs.',
    Fieldset::TABLE . '.' . Fieldset::LABEL => 'Le libellé par défaut. La valeur peut être remplacée par des formulaires et des groupes de champs qui implémentent ce groupe de champs.',
    Input::TABLE . '.' . Input::DESCRIPTION => 'La description par défaut. La valeur peut être remplacée par des formulaires et des groupes de champs qui implémentent ce champ de saisie.',
    Input::TABLE . '.' . Input::HANDLE => 'Le handle par défaut. La valeur peut être remplacée par des formulaires et des groupes de champs qui implémentent ce champ de saisie.',
    Input::TABLE . '.' . Input::LABEL => 'Le libellé par défaut. La valeur peut être remplacée par des formulaires et des groupes de champs qui implémentent ce champ de saisie.',
];
