<?php

namespace Narsil\Cms\Form\Implementations\Actions\Fieldsets;

#region USE

use Narsil\Base\Implementations\Action;
use Narsil\Base\Services\DatabaseService;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset as Contract;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
 * @author Jonathan Rigaux
 */
class ReplicateFieldset extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Fieldset $fieldset): Fieldset
    {
        $replicated = $fieldset->replicate();

        $replicated
            ->fill([
                Fieldset::HANDLE => DatabaseService::generateUniqueValue($replicated, Fieldset::HANDLE, $fieldset->{Fieldset::HANDLE}),
            ])
            ->save();

        $elements = $fieldset->elements()->get()->toArray();

        app(SyncFieldsetElements::class)
            ->run($replicated, $elements);

        return $replicated;
    }

    #endregion
}
