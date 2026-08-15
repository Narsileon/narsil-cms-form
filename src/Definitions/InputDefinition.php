<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Definitions;

#region USE

use Narsil\Base\Definitions\AbstractModelDefinition;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Illuminate\Support\Arr;
use Narsil\Cms\Contracts\Actions\Fields\SyncFieldValidationRules;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions;
use Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput;
use Narsil\Cms\Form\Contracts\Forms\InputForm;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Implementations\Tables\InputTable;

#endregion

final class InputDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    public function editWith(): array
    {
        return [Input::RELATION_OPTIONS, Input::RELATION_VALIDATION_RULES];
    }

    public function form(): ?string
    {
        return InputForm::class;
    }

    public function hooks(): array
    {
        $hook = function (ModelHookContext $context): void
        {
            if ($context->model instanceof Input)
            {
                app(SyncInputOptions::class)->run($context->model, Arr::get($context->attributes, Input::RELATION_OPTIONS, []));
                app(SyncFieldValidationRules::class)->run($context->model, Arr::get($context->attributes, Input::RELATION_VALIDATION_RULES, []));
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
        return [Input::RELATION_OPTIONS, Input::RELATION_VALIDATION_RULES];
    }

    public function model(): string
    {
        return Input::class;
    }

    public function morph(): ?string
    {
        return Input::TABLE;
    }

    public function replicateAction(): ?string
    {
        return ReplicateInput::class;
    }

    public function request(): ?string
    {
        return InputFormRequest::class;
    }

    public function route(): string
    {
        return 'inputs';
    }

    public function table(): ?string
    {
        return InputTable::class;
    }

    #endregion
}
