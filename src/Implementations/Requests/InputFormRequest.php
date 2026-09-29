<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest as Contract;
use Narsil\Cms\Form\Models\Input;

#endregion

class InputFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->input)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->input);
        }

        return Gate::allows(AbilityEnum::CREATE, Input::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Input::HANDLE => [
                FormRule::ALPHA_DASH,
                FormRule::LOWERCASE,
                FormRule::doesntStartWith('-'),
                FormRule::doesntEndWith('-'),
                FormRule::REQUIRED,
                FormRule::unique(
                    Input::class,
                    Input::HANDLE,
                )->ignore($this->input?->{Input::ID}),
            ],
            Input::LABEL => [
                FormRule::LIST,
                FormRule::REQUIRED,
            ],
            Input::DESCRIPTION => [
                FormRule::LIST,
                FormRule::NULLABLE,
            ],
            Input::PLACEHOLDER => [
                FormRule::LIST,
                FormRule::NULLABLE,
            ],
            Input::SETTINGS => [
                FormRule::LIST,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
            Input::TYPE => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],

            Input::RELATION_OPTIONS => [
                FormRule::LIST,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
            Input::RELATION_VALIDATION_RULES => [
                FormRule::LIST,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
        ];
    }

    #endregion
}
