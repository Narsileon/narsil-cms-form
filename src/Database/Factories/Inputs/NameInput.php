<?php

namespace Narsil\Cms\Form\Database\Factories\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class NameInput
{
    #region PUBLIC METHODS

    /**
     * @return Input
     */
    public static function run(): Input
    {
        if ($input = Input::firstWhere(Input::HANDLE, 'name'))
        {
            return $input;
        }

        return Input::factory()
            ->create([
                Input::HANDLE => 'name',
                Input::LABEL => 'Name',
                Input::TYPE => TextInputData::TYPE,
            ]);
    }

    #endregion
}
