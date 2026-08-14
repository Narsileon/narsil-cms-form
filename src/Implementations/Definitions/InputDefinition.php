<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Definitions;

#region USE

use Narsil\Base\Resources\AbstractModelDefinition;
use Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput;
use Narsil\Cms\Form\Contracts\Forms\InputForm;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest;
use Narsil\Cms\Form\Models\Input;

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

    public function indexWith(): array
    {
        return [Input::RELATION_OPTIONS, Input::RELATION_VALIDATION_RULES];
    }

    public function model(): string
    {
        return Input::class;
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

    #endregion
}
