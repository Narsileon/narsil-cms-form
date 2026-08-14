<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Definitions;

#region USE

use Narsil\Base\Resources\AbstractModelDefinition;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

final class FieldsetDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    public function editWith(): array
    {
        return [Fieldset::RELATION_ELEMENTS];
    }

    public function form(): ?string
    {
        return FieldsetForm::class;
    }

    public function indexWith(): array
    {
        return [Fieldset::RELATION_ELEMENTS];
    }

    public function model(): string
    {
        return Fieldset::class;
    }

    public function replicateAction(): ?string
    {
        return ReplicateFieldset::class;
    }

    public function request(): ?string
    {
        return FieldsetFormRequest::class;
    }

    public function route(): string
    {
        return 'fieldsets';
    }

    #endregion
}
