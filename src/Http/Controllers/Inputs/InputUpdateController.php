<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Contracts\Actions\Fields\SyncFieldValidationRules;
use Narsil\Cms\Form\Contracts\Actions\Inputs\SyncInputOptions;
use Narsil\Cms\Form\Contracts\Requests\InputFormRequest;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @author Jonathan Rigaux
 */
class InputUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param InputFormRequest $request
     * @param Input $input
     *
     * @return RedirectResponse
     */
    public function __invoke(InputFormRequest $request, Input $input): RedirectResponse
    {
        $attributes = $request->validated();

        $input->update($attributes);

        app(SyncInputOptions::class)
            ->run($input, Arr::get($attributes, Input::RELATION_OPTIONS, []));

        app(SyncFieldValidationRules::class)
            ->run($input, Arr::get($attributes, Input::RELATION_VALIDATION_RULES, []));

        return $this
            ->redirect(route('inputs.index'), $input)
            ->with('success', ModelService::getSuccessMessage(Input::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
