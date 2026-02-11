<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Form\Services\FieldsetService;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetStoreController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param FieldsetFormRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(FieldsetFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $fieldset = Fieldset::create($attributes);

        FieldsetService::syncFieldsetElements($fieldset, Arr::get($attributes, Fieldset::RELATION_ELEMENTS, []));

        return $this
            ->redirect(route('fieldsets.index'), $fieldset)
            ->with('success', ModelService::getSuccessMessage(Fieldset::class, ModelEventEnum::CREATED));
    }

    #endregion
}
