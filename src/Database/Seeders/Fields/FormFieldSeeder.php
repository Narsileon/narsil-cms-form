<?php

namespace Narsil\Cms\Form\Database\Seeders\Fields;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Form\Http\Data\Forms\Inputs\FormInputData;
use Narsil\Cms\Models\Collections\Field;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class FormFieldSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return Field
     */
    public function run(): Field
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
