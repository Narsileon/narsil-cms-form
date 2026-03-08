<?php

namespace Narsil\Cms\Form\Implementations\Actions\Forms;

#region USE

use Narsil\Base\Implementations\Action;
use Narsil\Base\Services\DatabaseService;
use Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm as Contract;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps;
use Narsil\Cms\Form\Models\Form;

#endregion

/**
 * @author Jonathan Rigaux
 */
class ReplicateForm extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Form $form): Form
    {
        $replicated = $form->replicate();

        $replicated
            ->fill([
                Form::SLUG => DatabaseService::generateUniqueValue($replicated, Form::SLUG, $form->{Form::SLUG}),
            ])
            ->save();

        $formSteps = $form->tabs()->get()->toArray();

        app(SyncFormSteps::class)
            ->run($replicated, $formSteps);

        return $replicated;
    }

    #endregion
}
