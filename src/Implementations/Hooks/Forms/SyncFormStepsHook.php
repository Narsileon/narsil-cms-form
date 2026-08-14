<?php

declare(strict_types=1);

namespace Narsil\Cms\Form\Implementations\Hooks\Forms;

#region USE

use Illuminate\Support\Arr;
use Narsil\Base\Contracts\ModelHook;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps;
use Narsil\Cms\Form\Models\Form;

#endregion

final class SyncFormStepsHook implements ModelHook
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function handle(ModelHookContext $context): void
    {
        if ($context->model instanceof Form)
        {
            app(SyncFormSteps::class)
                ->run($context->model, Arr::get($context->attributes, Form::RELATION_STEPS, []));
        }
    }

    #endregion
}
