<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Http\Requests\DestroyManyRequest;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetDestroyManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param DestroyManyRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(DestroyManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::DELETE_ANY, Fieldset::class);

        $ids = $request->validated(DestroyManyRequest::IDS);

        Fieldset::query()
            ->whereIn(Fieldset::ID, $ids)
            ->delete();

        return $this
            ->redirect(route('fieldsets.index'))
            ->with('success', ModelService::getSuccessMessage(Fieldset::class, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}
