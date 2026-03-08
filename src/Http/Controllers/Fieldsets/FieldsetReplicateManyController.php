<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Http\Requests\ReplicateManyRequest;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\ReplicateFieldset;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
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
        $this->authorize(AbilityEnum::CREATE, Fieldset::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $fieldsets = Fieldset::query()
            ->findMany($ids);

        foreach ($fieldsets as $fieldset)
        {
            app(ReplicateFieldset::class)
                ->run($fieldset);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
