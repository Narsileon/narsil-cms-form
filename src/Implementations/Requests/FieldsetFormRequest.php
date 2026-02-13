<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest as Contract;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->fieldset)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->fieldset);
        }

        return Gate::allows(AbilityEnum::CREATE, Fieldset::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Fieldset::HANDLE => [
                FormRule::ALPHA_DASH,
                FormRule::LOWERCASE,
                FormRule::doesntStartWith('-'),
                FormRule::doesntEndWith('-'),
                FormRule::REQUIRED,
                FormRule::unique(
                    Fieldset::class,
                    Fieldset::HANDLE,
                )->ignore($this->fieldset?->{Fieldset::ID}),

            ],
            Fieldset::LABEL => [
                FormRule::REQUIRED,
            ],

            Fieldset::RELATION_ELEMENTS => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
                FormRule::SOMETIMES,
            ],
        ];
    }

    #endregion
}
