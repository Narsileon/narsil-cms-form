<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest as Contract;
use Narsil\Cms\Form\Models\Form;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->form)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->form);
        }

        return Gate::allows(AbilityEnum::CREATE, Form::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Form::SLUG => [
                FormRule::ALPHA_DASH,
                FormRule::LOWERCASE,
                FormRule::doesntStartWith('-'),
                FormRule::doesntEndWith('-'),
                FormRule::REQUIRED,
                FormRule::unique(
                    Form::class,
                    Form::SLUG,
                )->ignore($this->form?->{Form::ID}),
            ],

            Form::RELATION_STEPS => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            Form::RELATION_WEBHOOKS => [
                FormRule::ARRAY,
                FormRule::NULLABLE,
            ],
        ];
    }

    #endregion
}
