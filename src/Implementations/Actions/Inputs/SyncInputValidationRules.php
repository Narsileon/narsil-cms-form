<?php

namespace Narsil\Cms\Form\Implementations\Actions\Inputs;

#region USE

use Narsil\Base\Implementations\Action;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputValidationRules as Contract;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @author Jonathan Rigaux
 */
class SyncInputValidationRules extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Input $input, array $validationRules): Input
    {
        $input
            ->validation_rules()
            ->sync($validationRules);

        return $input;
    }

    #endregion
}
