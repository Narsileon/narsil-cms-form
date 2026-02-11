<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Services\FieldsetService;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Http\Requests\ReplicateManyRequest;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetReplicateManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ReplicateManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::CREATE, Fieldset::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $fieldsets = Fieldset::query()
            ->findMany($ids);

        foreach ($fieldsets as $fieldset)
        {
            FieldsetService::replicate($fieldset);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Fieldset::class, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
