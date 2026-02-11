<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Cms\Enums\Policies\PermissionEnum;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputDestroyController extends RedirectController
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
        $this->authorize(PermissionEnum::DELETE, $input);

        $input->delete();

        return $this
            ->redirect(route('inputs.index'))
            ->with('success', ModelService::getSuccessMessage(Input::class, ModelEventEnum::DELETED));
    }

    #endregion
}
