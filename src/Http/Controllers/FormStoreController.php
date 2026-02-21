<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Services\Models\FormService;
use Narsil\Cms\Http\Controllers\RedirectController;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormStoreController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param FormFormRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(FormFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $form = Form::create($attributes);

        FormService::syncFormSteps($form, Arr::get($attributes, Form::RELATION_STEPS, []));
        FormService::syncFormWebhooks($form, Arr::get($attributes, Form::RELATION_WEBHOOKS, []));

        return $this
            ->redirect(route('forms.index'))
            ->with('success', ModelService::getSuccessMessage(Form::TABLE, ModelEventEnum::CREATED));
    }

    #endregion
}
