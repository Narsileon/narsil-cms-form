<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\FormSubmissionFormRequest as Contract;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormSubmissionFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            self::STEP => [
                FormRule::INTEGER,
                FormRule::REQUIRED,
            ],
            self::UUID => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],
        ];
    }

    #endregion
}
