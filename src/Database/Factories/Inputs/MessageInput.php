<?php

namespace Narsil\Cms\Form\Database\Factories\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\TextareaInputData;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
abstract class MessageInput
{
    #region PUBLIC METHODS

    /**
     * @return Input
     */
    public static function run(): Input
    {
        if ($input = Input::firstWhere(Input::HANDLE, 'message'))
        {
            return $input;
        }

        return Input::factory()
            ->create([
                Input::HANDLE => 'message',
                Input::LABEL => 'Message',
                Input::TYPE => TextareaInputData::TYPE,
            ]);
    }

    #endregion
}
