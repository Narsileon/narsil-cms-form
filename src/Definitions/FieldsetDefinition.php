<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Definitions;

#region USE

use Illuminate\Support\Arr;
use Narsil\Base\Definitions\AbstractModelDefinition;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Implementations\Tables\FieldsetTable;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

final class FieldsetDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function editWith(): array
    {
        return [
            Fieldset::RELATION_ELEMENTS,
            Fieldset::RELATION_FIELDSETS,
            Fieldset::RELATION_INPUTS
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return FieldsetForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function hooks(): array
    {
        $hook = function (ModelHookContext $context): void
        {
            if ($context->model instanceof Fieldset)
            {
                app(SyncFieldsetElements::class)->run($context->model, Arr::get($context->attributes, Fieldset::RELATION_ELEMENTS, []));
            }
        };

        return [
            ModelHookEventEnum::AFTER_STORE->value => [
                [
                    'hook' => $hook,
                    'priority' => 0
                ],
            ],
            ModelHookEventEnum::AFTER_UPDATE->value => [
                [
                    'hook' => $hook,
                    'priority' => 0
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function indexWith(): array
    {
        return [Fieldset::RELATION_ELEMENTS, Fieldset::RELATION_FIELDSETS, Fieldset::RELATION_INPUTS];
    }

    /**
     * {@inheritDoc}
     */
    public function indexWithCount(): array
    {
        return [Fieldset::RELATION_FIELDSETS, Fieldset::RELATION_INPUTS];
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Fieldset::class;
    }

    /**
     * {@inheritDoc}
     */
    public function morph(): ?string
    {
        return Fieldset::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function replicateAction(): ?string
    {
        return ReplicateFieldset::class;
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return FieldsetFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return 'fieldsets';
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return FieldsetTable::class;
    }

    #endregion
}
