<?php

namespace Narsil\Cms\Form\Contracts\Actions\Inputs;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface ReplicateInput extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Input $input
     *
     * @return Input
     */
    public function run(Input $input): Input;

    #endregion
}
