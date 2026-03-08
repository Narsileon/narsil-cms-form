<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Http\Requests\ReplicateManyRequest;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Actions\Inputs\ReplicateInput;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
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
            app(ReplicateInput::class)
                ->run($input);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Input::TABLE, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
