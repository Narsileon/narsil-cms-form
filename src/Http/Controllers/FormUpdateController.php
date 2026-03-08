<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormSteps;
use Narsil\Cms\Form\Contracts\Actions\Forms\SyncFormWebhooks;
use Narsil\Cms\Form\Contracts\Requests\FormFormRequest;
use Narsil\Cms\Form\Models\Form;

#endregion

/**
 * @author Jonathan Rigaux
 */
class FormUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param FormFormRequest $request
     * @param Form $form
     *
     * @return RedirectResponse
     */
    public function __invoke(FormFormRequest $request, Form $form): RedirectResponse
    {
        $attributes = $request->validated();

        $form->update($attributes);

        app(SyncFormSteps::class)
            ->run($form, Arr::get($attributes, Form::RELATION_STEPS, []));

        app(SyncFormWebhooks::class)
            ->run($form, Arr::get($attributes, Form::RELATION_WEBHOOKS, []));

        return $this
            ->redirect(route('forms.index'))
            ->with('success', ModelService::getSuccessMessage(Form::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
