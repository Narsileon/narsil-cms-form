<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\Models\InputService;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Http\Requests\ReplicateManyRequest;

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
        $this->authorize(AbilityEnum::CREATE, Input::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $inputs = Input::query()
            ->findMany($ids);

        foreach ($inputs as $input)
        {
            InputService::replicate($input);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Input::TABLE, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
