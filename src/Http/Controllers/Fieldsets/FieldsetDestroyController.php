<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Http\Controllers\RedirectController;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetDestroyController extends RedirectController
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
        $this->authorize(AbilityEnum::DELETE, $fieldset);

        $fieldset->delete();

        return $this
            ->redirect(route('fieldsets.index'))
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::DELETED));
    }

    #endregion
}
