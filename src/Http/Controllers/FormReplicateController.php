<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Forms\ReplicateForm;
use Narsil\Cms\Form\Models\Form;

#endregion

/**
 * @author Jonathan Rigaux
 */
class FormReplicateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Form $form
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Form $form): RedirectResponse
    {
        $this->authorize(AbilityEnum::CREATE, Form::class);

        app(ReplicateForm::class)
            ->run($form);

        return back()
            ->with('success', ModelService::getSuccessMessage(Form::TABLE, ModelEventEnum::REPLICATED));
    }

    #endregion
}
