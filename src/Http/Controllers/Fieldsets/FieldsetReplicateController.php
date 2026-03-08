<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
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

        app(ReplicateFieldset::class)
            ->run($fieldset);

        return back()
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::REPLICATED));
    }

    #endregion
}
