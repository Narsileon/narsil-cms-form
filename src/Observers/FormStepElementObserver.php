<?php

namespace Narsil\Cms\Form\Observers;

#region USE

use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepElementObserver
{
    #region PUBLIC METHODS

    /**
     * @param FormStepElement $model
     *
     * @return void
     */
    public function saving(FormStepElement $model): void
    {
        match ($model->{FormStepElement::BASE_TYPE})
        {
            Fieldset::TABLE => $model->{FormStepElement::FIELDSET_ID} = $model->{FormStepElement::BASE_ID},
            Input::TABLE => $model->{FormStepElement::INPUT_ID} = $model->{FormStepElement::BASE_ID},
            default => null,
        };
    }

    #endregion
}
