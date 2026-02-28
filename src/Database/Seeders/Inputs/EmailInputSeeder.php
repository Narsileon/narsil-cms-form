<?php

namespace Narsil\Cms\Form\Database\Seeders\Inputs;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class EmailInputSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return Input
     */
    public function run(): Input
    {
        if ($input = Input::firstWhere(Input::HANDLE, 'email'))
        {
            return $input;
        }

        return Input::factory()
            ->create([
                Input::HANDLE => 'email',
                Input::LABEL => 'Email',
                Input::TYPE => EmailInputData::TYPE,
            ]);
    }

    #endregion
}
