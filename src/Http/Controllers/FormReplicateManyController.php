<?php

namespace Narsil\Cms\Form\Http\Controllers\Forms;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Http\Requests\ReplicateManyRequest;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Services\Models\FormService;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormReplicateManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ReplicateManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::CREATE, Form::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $forms = Form::query()
            ->findMany($ids);

        foreach ($forms as $form)
        {
            FormService::replicate($form);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Form::class, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
