<?php

namespace Narsil\Cms\Form\Contracts\Actions\Inputs;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface SyncInputOptions extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Input $input
     * @param array $options
     *
     * @return Input
     */
    public function run(Input $input, array $options): Input;

    #endregion
}
