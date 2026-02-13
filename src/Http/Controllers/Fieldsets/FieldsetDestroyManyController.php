<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Http\Requests\DestroyManyRequest;
use Narsil\Cms\Services\ModelService;

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
        $this->authorize(AbilityEnum::DELETE_ANY, Fieldset::class);

        $ids = $request->validated(DestroyManyRequest::IDS);

        Fieldset::query()
            ->whereIn(Fieldset::ID, $ids)
            ->delete();

        return $this
            ->redirect(route('fieldsets.index'))
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}
