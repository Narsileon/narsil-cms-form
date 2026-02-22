<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Services\FieldsetService;

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
        $this->authorize(AbilityEnum::CREATE, Fieldset::class);

        FieldsetService::replicate($fieldset);

        return back()
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::REPLICATED));
    }

    #endregion
}
