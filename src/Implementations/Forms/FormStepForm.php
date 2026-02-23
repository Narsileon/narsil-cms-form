<?php

namespace Narsil\Cms\Form\Implementations\Forms;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Cms\Form\Contracts\Forms\FormStepForm as Contract;
use Narsil\Cms\Form\Models\FormStep;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStepForm extends Form implements Contract
{
    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        id: FormStep::HANDLE,
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: FormStep::LABEL,
                        required: true,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: FormStep::DESCRIPTION,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                ],
            ),
        ];
    }

    #endregion
}
