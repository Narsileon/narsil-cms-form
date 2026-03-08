<?php

namespace Narsil\Cms\Form\Contracts\Actions\Inputs;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface SyncInputValidationRules extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Input $input
     * @param integer[] $validationRules
     *
     * @return Input
     */
    public function run(Input $field, array $validationRules): Input;

    #endregion
}
