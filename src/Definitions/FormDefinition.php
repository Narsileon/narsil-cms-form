<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Definitions;

#region USE

use Narsil\Base\Definitions\AbstractModelDefinition;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm;
use Narsil\Cms\Form\Contracts\Forms\FormForm;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest;
use Narsil\Cms\Form\Implementations\Hooks\Forms\SyncFormStepsHook;
use Narsil\Cms\Form\Implementations\Hooks\Forms\SyncFormWebhooksHook;
use Narsil\Cms\Form\Implementations\Tables\FormTable;
use Narsil\Cms\Form\Models\Form;

#endregion

final class FormDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

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

    public function hooks(): array
    {
        return [
            ModelHookEventEnum::AFTER_STORE->value => [
                ['hook' => SyncFormWebhooksHook::class, 'priority' => 0],
                ['hook' => SyncFormStepsHook::class, 'priority' => 10],
            ],
            ModelHookEventEnum::AFTER_UPDATE->value => [
                ['hook' => SyncFormWebhooksHook::class, 'priority' => 0],
                ['hook' => SyncFormStepsHook::class, 'priority' => 10],
            ],
        ];
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
    public function model(): string
    {
        return Form::class;
    }

    public function morph(): ?string
    {
        return Form::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [
            ModelOperationEnum::CREATE,
            ModelOperationEnum::DESTROY,
            ModelOperationEnum::DESTROY_MANY,
            ModelOperationEnum::EDIT,
            ModelOperationEnum::INDEX,
            ModelOperationEnum::REPLICATE,
            ModelOperationEnum::REPLICATE_MANY,
            ModelOperationEnum::STORE,
            ModelOperationEnum::UPDATE,
        ];
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
    public function request(): ?string
    {
        return FormFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return 'forms';
    }

    public function table(): ?string
    {
        return FormTable::class;
    }

    #endregion
}
