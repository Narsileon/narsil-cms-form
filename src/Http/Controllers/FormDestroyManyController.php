<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Cms\Enums\ModelEventEnum;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Http\Requests\DestroyManyRequest;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormDestroyManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param DestroyManyRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(DestroyManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::DELETE_ANY, Form::class);

        $ids = $request->validated(DestroyManyRequest::IDS);

        Form::query()
            ->whereIn(Form::ID, $ids)
            ->delete();

        return $this
            ->redirect(route('forms.index'))
            ->with('success', ModelService::getSuccessMessage(Form::class, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}
