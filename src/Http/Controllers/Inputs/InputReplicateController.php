<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Cms\Form\Enums\ModelEventEnum;
use Narsil\Cms\Form\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Http\Controllers\RedirectController;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\Models\InputService;
use Narsil\Cms\Form\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputReplicateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Input $input
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Input $input): RedirectResponse
    {
        $this->authorize(PermissionEnum::CREATE, Input::class);

        InputService::replicate($input);

        return back()
            ->with('success', ModelService::getSuccessMessage(Input::class, ModelEventEnum::REPLICATED));
    }

    #endregion
}
