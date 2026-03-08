<?php

namespace Narsil\Cms\Form\Implementations\Actions\Inputs;

#region USE

use Illuminate\Support\Arr;
use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions as Contract;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Models\InputOption;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncInputOptions extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Input $input, array $options): Input
    {
        $uuids = [];

        foreach ($options as $key => $option)
        {
            $inputOption = InputOption::updateOrCreate([
                InputOption::INPUT_ID => $input->{Input::ID},
                InputOption::VALUE => Arr::get($option, InputOption::VALUE),
            ], [
                InputOption::POSITION => $key,
                InputOption::LABEL => Arr::get($option, InputOption::LABEL),
            ]);

            $uuids[] = $inputOption->{InputOption::UUID};
        }

        $input
            ->options()
            ->whereNotIn(InputOption::UUID, $uuids)
            ->delete();

        return $input;
    }

    #endregion
}
