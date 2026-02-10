<?php

namespace Narsil\Cms\Form\Implementations\Requests;

#region USE

use Narsil\Base\Validation\FormRule;
use Narsil\Cms\Form\Contracts\Requests\FormSubmissionFormRequest as Contract;
use Narsil\Cms\Implementations\AbstractFormRequest;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormSubmissionFormRequest extends AbstractFormRequest implements Contract
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
