<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Enums\ModelEventEnum;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormDestroyController extends RedirectController
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
        $this->authorize(PermissionEnum::DELETE, $form);

        $form->delete();

        return $this
            ->redirect(route('forms.index'))
            ->with('success', ModelService::getSuccessMessage(Form::class, ModelEventEnum::DELETED));
    }

    #endregion
}
