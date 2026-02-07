<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest as Contract;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Implementations\AbstractFormRequest;
use Narsil\Cms\Validation\FormRule;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormFormRequest extends AbstractFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->form)
        {
            return Gate::allows(PermissionEnum::UPDATE, $this->form);
        }

        return Gate::allows(PermissionEnum::CREATE, Form::class);
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
