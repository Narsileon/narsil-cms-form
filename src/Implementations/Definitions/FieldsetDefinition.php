<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Definitions;

#region USE

use Narsil\Base\Resources\AbstractModelDefinition;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Illuminate\Support\Arr;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Implementations\Tables\FieldsetTable;

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
                ['hook' => $hook, 'priority' => 0],
            ],
            ModelHookEventEnum::AFTER_UPDATE->value => [
                ['hook' => $hook, 'priority' => 0],
            ],
        ];
    }

    public function indexWith(): array
    {
        return [Fieldset::RELATION_ELEMENTS];
    }

    public function model(): string
    {
        return Fieldset::class;
    }

    public function morph(): ?string
    {
        return Fieldset::TABLE;
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

    public function table(): ?string
    {
        return FieldsetTable::class;
    }

    #endregion
}
