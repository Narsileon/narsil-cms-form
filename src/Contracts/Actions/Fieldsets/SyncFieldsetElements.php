<?php

namespace Narsil\Cms\Form\Contracts\Actions\Fieldsets;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
 * @author Jonathan Rigaux
 */
interface SyncFieldsetElements extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Fieldset $fieldset
     * @param array $elements
     *
     * @return Fieldset
     */
    public function run(Fieldset $fieldset, array $elements): Fieldset;

    #endregion
}
