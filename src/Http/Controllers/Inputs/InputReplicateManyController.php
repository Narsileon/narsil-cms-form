<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Http\Requests\ReplicateManyRequest;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\Models\InputService;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputReplicateManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ReplicateManyRequest $request): RedirectResponse
    {
        $this->authorize(PermissionEnum::CREATE, Input::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $inputs = Input::query()
            ->findMany($ids);

        foreach ($inputs as $input)
        {
            InputService::replicate($input);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Input::class, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
