<?php

namespace Narsil\Cms\Form\Http\Data\Forms;

#region USE

use Narsil\Base\Http\Data\Forms\FormStepData as BaseFormStepData;
use Narsil\Cms\Form\Models\FormStep;
use Narsil\Cms\Form\Models\FormStepElement;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepData extends BaseFormStepData
{
    #region PUBLIC METHODS

    /**
     * Get the form step data of a template tab.
     *
     * @param FormStep $formStep
     *
     * @return FormStepData
     */
    public static function fromElement(FormStep $formStep): FormStepData
    {
        return new FormStepData(
            id: $formStep->{FormStep::HANDLE},
            label: $formStep->{FormStep::LABEL},
            elements: $formStep->{FormStep::RELATION_ELEMENTS}->map(function ($element)
            {
                if ($element->{FormStepElement::BASE_TYPE} === Input::TABLE)
                {
                    return FieldData::fromElement($element);
                }
                else
                {
                    return FieldsetData::fromElement($element);
                }
            })->toArray(),
        );
    }

    #endregion
}
