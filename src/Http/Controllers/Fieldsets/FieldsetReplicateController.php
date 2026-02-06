<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Services\Models\FieldsetService;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetReplicateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Fieldset $fieldset
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Fieldset $fieldset): RedirectResponse
    {
        $this->authorize(PermissionEnum::CREATE, Fieldset::class);

        FieldsetService::replicate($fieldset);

        return back()
            ->with('success', ModelService::getSuccessMessage(Fieldset::class, ModelEventEnum::REPLICATED));
    }

    #endregion
}
