<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Fieldsets\SyncFieldsetElements;
use Narsil\Cms\Form\Contracts\Requests\FieldsetFormRequest;
use Narsil\Cms\Form\Models\Fieldset;

#endregion

/**
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

        app(SyncFieldsetElements::class)
            ->run($fieldset, Arr::get($attributes, Fieldset::RELATION_ELEMENTS, []));

        return $this
            ->redirect(route('fieldsets.index'), $fieldset)
            ->with('success', ModelService::getSuccessMessage(Fieldset::TABLE, ModelEventEnum::CREATED));
    }

    #endregion
}
