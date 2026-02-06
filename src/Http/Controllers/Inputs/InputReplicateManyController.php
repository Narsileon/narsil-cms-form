<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Enums\ModelEventEnum;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\Models\InputService;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Http\Requests\ReplicateManyRequest;
use Narsil\Cms\Services\ModelService;

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
