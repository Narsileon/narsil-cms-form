<?php

namespace Narsil\Cms\Form\Database\Seeders\Inputs;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class NameInputSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return Input
     */
    public function run(): Input
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
