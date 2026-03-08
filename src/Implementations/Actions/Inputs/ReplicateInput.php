<?php

namespace Narsil\Cms\Form\Implementations\Actions\Inputs;

#region USE

use Narsil\Base\Implementations\Action;
use Narsil\Base\Services\DatabaseService;
use Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput as Contract;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputValidationRules;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Models\ValidationRule;

#endregion

/**
 * @author Jonathan Rigaux
 */
class ReplicateInput extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Input $input): Input
    {
        $replicated = $input->replicate();

        $replicated
            ->fill([
                Input::HANDLE => DatabaseService::generateUniqueValue($replicated, Input::HANDLE, $input->{Input::HANDLE}),
            ])
            ->save();

        $options = $input->options()->get()->toArray();

        app(SyncInputOptions::class)
            ->run($replicated, $options);

        $validationRules = $input->{Input::RELATION_VALIDATION_RULES}->pluck(ValidationRule::ID)->toArray();

        app(SyncInputValidationRules::class)
            ->run($replicated, $validationRules);

        return $replicated;
    }

    #endregion
}
