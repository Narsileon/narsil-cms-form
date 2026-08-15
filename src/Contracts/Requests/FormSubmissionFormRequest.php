<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Contracts\Requests;

#region USE

use Narsil\Base\Contracts\FormRequest;

#endregion

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
