<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Http\Requests\DestroyManyRequest;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Form;

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
        $this->authorize(AbilityEnum::DELETE_ANY, Form::class);

        $ids = $request->validated(DestroyManyRequest::IDS);

        Form::query()
            ->whereIn(Form::ID, $ids)
            ->delete();

        return $this
            ->redirect(route('forms.index'))
            ->with('success', ModelService::getSuccessMessage(Form::TABLE, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}
