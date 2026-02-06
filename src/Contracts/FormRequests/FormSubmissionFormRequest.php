<?php

namespace Narsil\Cms\Form\Contracts\FormRequests;

#region USE

use Narsil\Cms\Contracts\FormRequest;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 *
 * @see vendor/narsil/cms-form/config/narsil/bindings/form-requests.php
 */
interface FormSubmissionFormRequest extends FormRequest
{
    #region CONSTANTS

    /**
     * @var string
     */
    public const STEP = '_step';

    /**
     * @var string
     */
    public const UUID = '_uuid';

    #endregion
}
