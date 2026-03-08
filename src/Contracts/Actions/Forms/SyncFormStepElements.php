<?php

namespace Narsil\Cms\Form\Contracts\Actions\Forms;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\FormStep;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface SyncFormStepElements extends Action
{
    #region PUBLIC METHODS

    /**
     * @param FormStep $formStep
     * @param array $elements
     *
     * @return FormStep
     */
    public function run(FormStep $formStep, array $elements): FormStep;

    #endregion
}
