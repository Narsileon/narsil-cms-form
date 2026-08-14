<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Definitions;

#region USE

use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Enums\ModelOperationEnum as Operation;
use Narsil\Cms\Form\Contracts\Forms\FormForm;
use Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest;
use Narsil\Cms\Form\Models\Form;

#endregion

final class FormDefinition implements ModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Form::class;
    }

    /**
     * {@inheritDoc}
     */
    public function editWith(): array
    {
        return [
            Form::RELATION_WEBHOOKS,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return FormForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function indexWith(): array
    {
        return [
            Form::RELATION_STEPS,
            Form::RELATION_WEBHOOKS,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function indexWithCount(): array
    {
        return [
            Form::RELATION_STEPS,
            Form::RELATION_WEBHOOKS,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [
            Operation::CREATE,
            Operation::DESTROY,
            Operation::DESTROY_MANY,
            Operation::EDIT,
            Operation::INDEX,
            Operation::REPLICATE,
            Operation::REPLICATE_MANY,
            Operation::STORE,
            Operation::UPDATE,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return FormFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function replicateAction(): ?string
    {
        return ReplicateForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return 'forms';
    }

    #endregion
}
