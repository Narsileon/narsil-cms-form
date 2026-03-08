<?php

namespace Narsil\Cms\Form\Contracts\Actions\Forms;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Form;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface ReplicateForm extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Form $form
     *
     * @return Form
     */
    public function run(Form $form): Form;

    #endregion
}
