<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Contracts\Actions\Fieldsets;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

interface ReplicateFieldset extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Fieldset $fieldset
     *
     * @return Fieldset
     */
    public function run(Fieldset $fieldset): Fieldset;

    #endregion
}
