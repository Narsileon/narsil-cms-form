<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Contracts\Requests;

#region USE

use Narsil\Base\Contracts\FormRequest;

#endregion

/**
 * @author Jonathan Rigaux
 *
 * @see vendor/narsil/cms-form/src/ServiceProvider.php
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
