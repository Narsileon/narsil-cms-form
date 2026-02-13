<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest as Contract;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
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
                FormRule::ARRAY,
                FormRule::REQUIRED,
            ],
            Input::DESCRIPTION => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
            ],
            Input::PLACEHOLDER => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
            ],
            Input::SETTINGS => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
            Input::TYPE => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],

            Input::RELATION_OPTIONS => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
            Input::RELATION_VALIDATION_RULES => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
        ];
    }

    #endregion
}
