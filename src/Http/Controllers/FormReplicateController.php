<?php

namespace Narsil\Cms\Form\Http\Controllers\Forms;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Services\Models\FormService;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
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
        $this->authorize(PermissionEnum::CREATE, Form::class);

        FormService::replicate($form);

        return back()
            ->with('success', ModelService::getSuccessMessage(Form::class, ModelEventEnum::REPLICATED));
    }

    #endregion
}
