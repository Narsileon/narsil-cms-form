<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Http\Requests\DestroyManyRequest;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputDestroyManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param DestroyManyRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(DestroyManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::DELETE_ANY, Input::class);

        $ids = $request->validated(DestroyManyRequest::IDS);

        Input::query()
            ->whereIn(Input::ID, $ids)
            ->delete();

        return $this
            ->redirect(route('inputs.index'))
            ->with('success', ModelService::getSuccessMessage(Input::class, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}
