<?php

namespace Narsil\Cms\Form\Database\Factories\Fields;

#region USE

use Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData;
use Narsil\Cms\Models\Collections\Field;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class FormField
{
    #region PUBLIC METHODS

    /**
     * @return Field
     */
    public static function run(): Field
    {
        if ($field = Field::firstWhere(Field::HANDLE, 'form'))
        {
            return $field;
        }

        return Field::factory()
            ->create([
                Field::HANDLE => 'form',
                Field::LABEL => 'Form',
                Field::TYPE => FormInputData::TYPE,
            ]);
    }

    #endregion
}
